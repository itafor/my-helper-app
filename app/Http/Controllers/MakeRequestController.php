<?php

namespace App\Http\Controllers;

use App\Category;
use App\City;
use App\Country;
use App\Jobs\RequestSaveSuccessfully;
use App\Jobs\sendConfirmationCodeToReceiver;
use App\LockdownRequest;
use App\Notifications\SendRequestDetails;
use App\PickupRequest;
use App\RequestBidders;
use App\RequestItem;
use App\RequestPhoto;
use App\State;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Session;
use Stevebauman\Location\Facades\Location;
use Validator;

class MakeRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ip = $request->ip();
        $allRequests = LockdownRequest::orderBy('created_at', 'DESC')->get();
        return view('requests.make.index', compact('allRequests'));
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
        return view('requests.make.create', compact('categories', 'countries', 'states', 'location'));
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
        return view('requests.make.auth_create', compact('categories', 'countries', 'states','location'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $validator =validator::make($data,[
            'description'=>'required',
            'category_id' =>'required',
            'items' => 'required',
        ]);

         if($validator->fails()){
         return  back()->withErrors($validator)
                        ->withInput()->with('error', 'Please fill in a required fields');
    }
        $lockdownRequest = new LockdownRequest;
        $userId = auth()->user()->id;
        
        $data= $request->all();

        $onforwardingTown= isset($data['api_onforwarding_town_id']) ? explode('-', $data['api_onforwarding_town_id']) : '-testing';

       $trimmedonforwardingTown=trim($onforwardingTown[1]);

        $lockdownRequest->user_id = $userId;
        $lockdownRequest->request_type = $request->request_type;
        $lockdownRequest->category_id = $request->category_id;
        $lockdownRequest->description = $request->description;
        $lockdownRequest->api_state = $request->api_state;
        $lockdownRequest->api_city = getCityName_by_citycode($request->api_city);
        $lockdownRequest->api_delivery_town =  $trimmedonforwardingTown =='t' ? null : $trimmedonforwardingTown;
        $lockdownRequest->api_delivery_town_id = isset($data['api_delivery_town_id']) ? $data['api_delivery_town_id'] : null;
        $lockdownRequest->street = $request->street;
        
        $lockdownRequest->save();
         if($lockdownRequest){
         RequestItem::addNew($data, $lockdownRequest);
            
      $lockdown_request = LockdownRequest::find($lockdownRequest->id);
      $user = $lockdown_request->user;
      $request_saved_successfully = (new RequestSaveSuccessfully($lockdown_request, $user))->delay(2);
      $this->dispatch($request_saved_successfully);

       }
        return redirect()->route('requests')->with('success', 'Your request to get help was received');

    }

    public function checkEmail(Request $request){
        $email = $request->input('email');
        $isExists = \App\User::where('email',$email)->first();
        if($isExists){
            return response()->json(array("exists" => true));
        }else{
            return response()->json(array("exists" => false));
        }
    }

    public function checkUserName(Request $request){
        $username = $request->input('username');
        $isExists = \App\User::where('username',$username)->first();
        if($isExists){
            return response()->json(array("exists" => true));
        }else{
            return response()->json(array("exists" => false));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function auth_show($id)
    {
        $userId = auth()->user()->id;
        $getRequest = LockdownRequest::find($id);
        //dd($getRequest);
        $request_photos= RequestPhoto::where([
          ['request_id', $getRequest->id],
          ['provider_id',authUser() ? authUser()->id : ''],
       ])->get();

        $requestBid = RequestBidders::where([
            ['request_id', $getRequest->id],
            ['bidder_id', $getRequest->user->id],
            ['requester_id', authUser()->id],
        ])->first();

         $help_request_bidders = $getRequest->request_bidders;
        // Check many to many table if the id of the request has mapped with this user id, to avoid multiple 
        // times of contacts by the same person
        $checkIfContacted = $getRequest->users()->allRelatedIds()->toArray();
        // dd($getRequest->request_type);
        
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
        
        return view('requests.make.show', compact('getRequest', 'checkIfContacted', 'suggestions','help_request_bidders','request_photos','requestBid'));
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
        // dd($getRequest);

        $help_request_bidders = $getRequest->request_bidders;

        // Check many to many table if the id of the request has mapped with this user id, to avoid multiple 
        // times of contacts by the same person
        $checkIfContacted = $getRequest->users()->allRelatedIds()->toArray();
        // dd($getRequest->request_type);
        
        // Suggest leads to requests
        $suggestions = LockdownRequest::orWhere([
                                                    ['category_id', $getRequest->category_id],
                                                    ['state_id', $getRequest->state_id],
                                                    // ['street', 'LIKE', '%'.$getRequest->street. '%'],
                                                    ])
                                        ->where([
                                                    ['request_type', '!=', $getRequest->request_type ]
                                            ])
                                        ->orderBy('created_at', 'DESC')
                                        ->get();
        
        // dd($suggestions);
        return view('requests.make.guest', compact('getRequest'));
    }

    public function sendMail($req)
    {
        $reqDetail = LockdownRequest::find($req);
        $user = auth()->user();

        $checkIfContacted = $reqDetail->users()->allRelatedIds()->toArray();

        if(in_array($user->id, $checkIfContacted)) {
            Session::flash('status', 'You have previously shown interest in this request');
            return redirect()->route('requests');
        }
        else {
            $user->lockdownRequests()->sync($reqDetail->id, false);
            $receiver = $reqDetail->user;
        
            $receiver->notify(new SendRequestDetails($user, $reqDetail));
            // dd($receiver);
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


    public function initialRequestApprovalForhelpSeekers($id){
       $data['request_bid'] = RequestBidders::find($id);
       $data['request_bidder'] =  $data['request_bid']->bidder;
       $data['request'] =  $data['request_bid']->request;
       $data['help_provider'] =  $data['request_bid']->requester;
       $data['logistic_partner'] =  $data['request_bid']->logistic_partner;

       $data['request_photos']= RequestPhoto::where([
          ['request_id', $data['request']->id],
          ['provider_id',$data['help_provider']->id],
       ])->get();

       return view('requests.make.submit_pickup_request',$data);

    }

    public function finalRequestApprovalForhelpSeekers(Request $request){
      
     $data = $request->all();
    //dd($data);
      $shipmentItemsContainer = [];
      foreach ($data['ShipmentItems'] as $key => $item) {
         $shipmentItemsContainer[] =  ['ItemName'=>$item['ItemName'],'ItemUnitCost'=>$item['ItemUnitCost'],'ItemQuantity'=>$item['ItemQuantity'],'ItemColour'=>$item['ItemColour'],'ItemSize'=>$item['ItemSize']];
      }


 $client = new Client(['verify' => false]);

     $pickupRequest = $client->post('http://api.clicknship.com.ng/clicknship/Operations/PickupRequest', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                        ],
                'form_params' => [
                'OrderNo' => 'Ord-'. mt_rand(1000000, 9999999),
                'Description' => $data['description'],
                'Weight' => $data['weight'],
                'SenderName'=>$data['senderName'],
                'SenderCity'=> getCityName_by_citycode($data['senderCity']),
                'SenderTownID'=> $data['senderTownID'],
                'SenderAddress'=> $data['senderAddress'],
                'SenderPhone' =>$data['senderPhone'],
                'SenderEmail' =>$data['senderEmail'],
                'RecipientName' =>$data['RecipientName'],
                'RecipientCity' =>$data['RecipientCity'],
                'RecipientTownID' =>$data['RecipientTownID'],
                'RecipientAddress' =>$data['RecipientAddress'],
                'RecipientPhone'=>$data['RecipientPhone'],
                'RecipientEmail'=>$data['RecipientEmail'],
                'PaymentType'=>$data['PaymentType'],
                'DeliveryType'=>$data['DeliveryType'],
                'ShipmentItems'=> $shipmentItemsContainer,
            ]
                    ]);

       $response = $pickupRequest->getBody()->getContents();
      $values = json_decode($response, true);


     if($values['TransStatus'] == 'Successful'){

      $data['OrderNo'] = $values['OrderNo'];
      $data['TransStatus'] = $values['TransStatus'];
      $data['WaybillNumber'] = $values['WaybillNumber'];
      $data['DeliveryFee'] = $values['DeliveryFee'];
      $data['TransStatusDetails'] = $values['TransStatusDetails'];
      $data['VatAmount'] = $values['VatAmount'];
      $data['TotalAmount'] = $values['TotalAmount'];
      
     // dd($data);

       $request_bidding_record = RequestBidders::approveHelpSeekersRequest($data);

       $savePickupRequest = PickupRequest::createNewPickupRequest($data);

       if($request_bidding_record){

        $help_provider= authUser(); //The user that want to provide help
        $main_request = LockdownRequest::find($data['request_id']);// the help (request)
        $request_bidder = User::find($data['bidder_id']); // the user bidding to get help 
        // $logistic_partner = User::find($data['logistic_partner_id']); 

       // $logistic_partner_job = (new NotifyLogisticToDeliverGoods($help_provider,$main_request,$request_bidder,$logistic_partner,$request_bidding_record))->delay(5);
       //  $this->dispatch($logistic_partner_job);

         $receiver_job = (new sendConfirmationCodeToReceiver($help_provider,$main_request,$request_bidder,$request_bidding_record))->delay(5);
        $this->dispatch($receiver_job);

          }

        return back()->with('success', $values['TransStatusDetails']);
          
          }

        return back()->withInput()->with('error', $values['TransStatusDetails']);

    }


}
