<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Country;
use App\State;
use App\City;
use App\LockdownRequest;
use Stevebauman\Location\Facades\Location;
use Session;
use App\Notifications\ProvideRequestDetails;

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
        $lockdownRequest = new LockdownRequest;
        $userId = auth()->user()->id;



        $lockdownRequest->user_id = $userId;
        $lockdownRequest->request_type = $request->request_type;
        $lockdownRequest->category_id = $request->category_id;
        $lockdownRequest->description = $request->description;
        $lockdownRequest->country_id = $request->country_id;
        $lockdownRequest->state_id = $request->state_id;
        $lockdownRequest->city_id = $request->city_id;
        $lockdownRequest->street = $request->street;
        $lockdownRequest->type = $request->type;
        $lockdownRequest->mode_of_contact = $request->mode_of_contact;
        $lockdownRequest->show_address = $request->show_address;
        $lockdownRequest->show_phone = $request->show_phone;
        
        $lockdownRequest->save();
        Session::flash('status', 'Request has been successfully registered');
        return redirect()->route('requests');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getRequest = LockdownRequest::find($id);
        $checkIfContacted = $getRequest->users()->allRelatedIds()->toArray();
        return view('requests.show', compact('getRequest', 'checkIfContacted'));
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
