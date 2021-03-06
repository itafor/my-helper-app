<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Country;
use App\Jobs\RequestSaveSuccessfully;
use App\LockdownRequest;
use App\Notifications\ProvideRequestDetails;
use App\RequestItem;
use App\State;
use Illuminate\Http\Request;
use Session;
use Stevebauman\Location\Facades\Location;
use Validator;

class ProvideRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::all();
        $countries = Country::all();
        $ip = $request->ip();
        if($ip == '127.0.0.1'){
            $ip = '105.112.24.184';
        }

        // get location of user
        $loc = Location::get($ip);
        $location = $loc->countryCode;

        // default the country, states and city to these values
        $getCountry = Country::where('sortname', $location)->first();
        $states = State::where('country_id', $getCountry->id)->get();
        // $cities = City::where('state_id', $states[0]->id)->get();

        return view('requests.provide.create', compact('categories', 'countries', 'states', 'location'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth_create(Request $request)
    {
        $categories = Category::all();
        $countries = Country::all();
        $ip = $request->ip();
        if($ip == '127.0.0.1'){
            $ip = '105.112.24.184';
        }

        // get location of user
        $loc = Location::get($ip);
        $location = $loc->countryCode;

        // default the country, states and city to these values
        $getCountry = Country::where('sortname', $location)->first();
        $states = State::where('country_id', $getCountry->id)->get();
        // $cities = City::where('state_id', $states[0]->id)->get();

        return view('requests.provide.auth_create', compact('categories', 'countries', 'states', 'location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
         $data = $request->all();

        $validator =validator::make($data,[
            'description'=>'required',
            'category_id'=>'required',
            'items' => 'required',
        ]);

         if($validator->fails()){
         return  back()->withErrors($validator)
                        ->withInput()->with('error', 'Please fill in a required fields');
    }

          $data= $request->all();

        $onforwardingTown= isset($data['api_onforwarding_town_id']) ? explode('-', $data['api_onforwarding_town_id']) : '-testing';

       $trimmedonforwardingTown=trim($onforwardingTown[1]);

        $lockdownRequest = new LockdownRequest;
        $userId = auth()->user()->id;

        $lockdownRequest->user_id = $userId;
        $lockdownRequest->request_type = $request->request_type;
        $lockdownRequest->category_id = $request->category_id;
        $lockdownRequest->description = $request->description;
        $lockdownRequest->api_state = $request->api_state;
        $lockdownRequest->api_city = getCityName_by_citycode($request->api_city);
        $lockdownRequest->api_delivery_town =  $trimmedonforwardingTown =='t' ? null : $trimmedonforwardingTown;
        $lockdownRequest->api_delivery_town_id = isset($data['api_delivery_town_id']) ? $data['api_delivery_town_id'] : null;
        $lockdownRequest->street = $request->street;
        $lockdownRequest->delivery_cost_payer = $request->delivery_cost_payer;
        $lockdownRequest->weight = $request->weight;
        
        $lockdownRequest->save();
        if($lockdownRequest){
            $lockdown_request = LockdownRequest::find($lockdownRequest->id);
            $user = $lockdown_request->user;

      $request_saved_successfully = (new RequestSaveSuccessfully($lockdown_request, $user))->delay(2);

        $this->dispatch($request_saved_successfully);

            RequestItem::addNew($data, $lockdownRequest);
            LockdownRequest::addRequestPhoto($request->all(),$lockdown_request);
        }
        
        return redirect()->route('requests')->with('success', 'Thank you for providing help');

    }

    /**
     * show details about provide request to guest users
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getRequest = LockdownRequest::find($id);
        $checkIfContacted = $getRequest->users()->allRelatedIds()->toArray();
        $getRequest = LockdownRequest::find($id);

         $help_request_bidders = $getRequest->request_bidders;
         $request_photos = $getRequest->requestPhotos;
        // Suggest leads to requests
        $suggestions = LockdownRequest::orWhere([
                                                    ['category_id', $getRequest->category_id],
                                                    ['api_state', $getRequest->api_state],
                                                    // ['street', 'LIKE', '%'.$getRequest->street. '%'],
                                                    ])
                                        ->where([
                                                    ['request_type', '!=', $getRequest->request_type ]
                                            ])
                                        ->orderBy('created_at', 'DESC')
                                        ->get();
                                        // dd($suggestions);
        return view('requests.show', compact('getRequest', 'checkIfContacted', 'suggestions','help_request_bidders','request_photos'));
    }


    /**
     * Show details about a request to an authenticated users
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function auth_show($id)
    {
        $getRequest = LockdownRequest::find($id);
        $userId = auth()->user()->id;
        $checkIfContacted = $getRequest->users()->allRelatedIds()->toArray();
        $getRequest = LockdownRequest::find($id);

        $help_request_bidders = $getRequest->request_bidders;
        $request_photos = $getRequest->requestPhotos;
        // Suggest leads to requests
        $suggestions = LockdownRequest::orWhere([
                                                    ['category_id', $getRequest->category_id],
                                                    ['api_state', $getRequest->api_state],
                                                    ])
                                        ->where([
                                                    ['user_id', '!=', $userId],
                                                    ['request_type', '!=', $getRequest->request_type ]
                                            ])
                                        ->orderBy('created_at', 'DESC')
                                        ->get();
                                        // dd($suggestions);
        return view('requests.show', compact('getRequest', 'checkIfContacted', 'suggestions','help_request_bidders','request_photos'));
    }

    public function sendMail($req)
    {
        $reqDetail = LockdownRequest::find($req);
        $user = auth()->user();

        $checkIfContacted = $reqDetail->users()->allRelatedIds()->toArray();

        if(in_array($user->id, $checkIfContacted)) {
            Session::flash('status', 'You have previously shown interest in this request');
            return redirect()->route('requests');
        } else {

            $user->lockdownRequests()->sync($reqDetail->id, false);
            $receiver = $reqDetail->user;
            // dd($receiver);
            $receiver->notify(new ProvideRequestDetails($user, $reqDetail));
            Session::flash("status", "Email has been sent successfully.");
            return redirect()->route('requests');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
