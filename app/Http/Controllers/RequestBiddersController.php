<?php

namespace App\Http\Controllers;

use App\Jobs\GrantUserRequest;
use App\Jobs\NotifyLogisticToDeliverGoods;
use App\Jobs\NotifyUserOfRequestApprovalOrRejection;
use App\Jobs\SendRequestToGetHelp;
use App\Jobs\SendhelpSeekerInfoToLogisticPartner;
use App\Jobs\sendConfirmationCodeToReceiver;
use App\LockdownRequest;
use App\PickupRequest;
use App\RequestBidders;
use App\RequestPhoto;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class RequestBiddersController extends Controller
{
	//apply to be a benefiary of someone request to provide help
    public function applyTOGetHelp(Request $request) {

	  $data = $request->all();
	 //dd($data);
       $validator = validator::make($data,[
            'request_id'=>'required',
            'requester_id'=>'required',
            'request_type'=>'required',
    ]);

    if($validator->fails()){
         return  back()->withErrors($validator)
                        ->withInput()->with('error', 'Please fill in a required fields');
    }

    if($data['receiver_state'] != $data['api_state']){
      return back()->withInput()->with('error', 'Help Provider and Receiver must be from the same state');
    }

    	 DB::beginTransaction();
        try{
    	 $request_bidders = RequestBidders::createNew($data);

        $request_bidder = authUser(); //the user bidding to get help
        $user_request = LockdownRequest::find($data['request_id']);// the help (request)
        $help_provider = User::find($data['requester_id']); //The user that want to provide help

       $job = (new SendRequestToGetHelp($request_bidder,$user_request,$help_provider,$request_bidders))->delay(5);

        $this->dispatch($job);

            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            return back()->withInput()->with('error', 'An attempt to apply for the request below failed. Please try again');
        }

        return back()->with('success', 'An attempt to apply for the request below was successful');
    }

        public function initialRequestApprovalByHelpReceiver($id){
       $data['request_bid'] = RequestBidders::find($id);
       $data['request_bidder'] =  $data['request_bid']->bidder;
       $data['request'] =  $data['request_bid']->request;
       $data['help_provider'] =  $data['request_bid']->requester;
       $data['logistic_partner'] =  $data['request_bid']->logistic_partner;
       $data['request_photos'] = RequestPhoto::where([
          ['request_id', $data['request']->id],
          ['provider_id',$data['help_provider']->id],
       ])->get();

       return view('requests.make.approve_or_reject_request',$data);

    }

      public function finalRequestApprovalByHelpReceiver(Request $request){
      
     $data = $request->all();
   // dd($data);
       $validator = validator::make($data,[
            'request_id'=>'required',
            'request_bid_id'=>'required',
            'bidder_id'=>'required',
            'requester_id'=>'required',
    ]);

    if($validator->fails()){
         return  back()->withErrors($validator)
                        ->withInput()->with('error', 'Please fill in a required fields');
    }

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
                'SenderCity'=> $data['senderCity'],
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

      // dd($values);

     if($values['TransStatus'] == 'Successful'){

      $data['OrderNo'] = $values['OrderNo'];
      $data['TransStatus'] = $values['TransStatus'];
      $data['WaybillNumber'] = $values['WaybillNumber'];
      $data['DeliveryFee'] = $values['DeliveryFee'];
      $data['TransStatusDetails'] = $values['TransStatusDetails'];
      $data['VatAmount'] = $values['VatAmount'];
      $data['TotalAmount'] = $values['TotalAmount'];

       // $request_bidding_record = RequestBidders::approveHelpSeekersRequest($data);
        
        $request_bidding_record = RequestBidders::approveRequestToReceiveHelp($data);


       $savePickupRequest = PickupRequest::createNewPickupRequest($data);

       if($request_bidding_record){

        $main_request = LockdownRequest::find($data['request_id']);// the help (request)
        $request_bidder = User::find($data['bidder_id']); // help receiver
        $help_provider= User::find($data['requester_id']);

         $receiver_job = (new sendConfirmationCodeToReceiver($help_provider,$main_request,$request_bidder,$request_bidding_record))->delay(5);
        $this->dispatch($receiver_job);


        $approve_or_reject_noty_senderjob = (new NotifyUserOfRequestApprovalOrRejection($help_provider,$main_request,$request_bidder,$request_bidding_record))->delay(5);
        $this->dispatch($approve_or_reject_noty_senderjob);

          }

        return back()->with('success', $values['TransStatusDetails']);
          
          }

        return back()->withInput()->with('error', $values['TransStatusDetails']);
    
        }
        

    public function initialRequestApprovalForhelpSeekers($id){
       $data['request_bid'] = RequestBidders::find($id);
       $data['request_bidder'] =  $data['request_bid']->bidder;
       $data['request'] =  $data['request_bid']->request;
       $data['help_provider'] =  $data['request_bid']->requester;
       $data['logistic_partner'] =  $data['request_bid']->logistic_partner;
       $data['request_photos'] = $data['request']->requestPhotos;

       return view('requests.provide.approve_bidder',$data);

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
                'SenderCity'=> $data['senderCity'],
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

         $receiver_job = (new sendConfirmationCodeToReceiver($help_provider,$main_request,$request_bidder,$request_bidding_record))->delay(5);
        $this->dispatch($receiver_job);

          }

        return back()->with('success', $values['TransStatusDetails']);
          
          }
         

        return back()->withInput()->with('error', $values['TransStatusDetails']);

    }


     public function grantSomeoneRequest(Request $request){
      
     $data = $request->all();
   // dd($data);
       $validator = validator::make($data,[
            'weight'=>'required',
    ]);

    if($validator->fails()){
         return  back()->withErrors($validator)
                        ->withInput()->with('error', 'Please fill in a required fields');
    }

    if($data['receiver_state'] != $data['api_state']){
      return back()->withInput()->with('error', 'Help Provider and Receiver must be from the same state');
    }

       DB::beginTransaction();
        try{
       $request_bidding_record = RequestBidders::grant_request($data);

       if($request_bidding_record){

        $help_provider= authUser(); //The user that want to provide help
        $main_request = LockdownRequest::find($data['request_id']);// the help (request)
        $request_owner = User::find($data['bidder_id']); // the user bidding to get help 
        // $logistic_partner = User::find($data['logistic_partner_id']); 

         $receiver_job = (new GrantUserRequest($help_provider,$main_request,$request_owner,$request_bidding_record))->delay(5);
        $this->dispatch($receiver_job);

            LockdownRequest::addRequestPhoto($request->all(),$main_request);

            DB::commit();
          }
        }
        catch(Exception $e){
            DB::rollback();
            return back()->withInput()->with('error', 'An attempt to grant user request failed. Please try again');
        }

        return back()->with('success', 'User successfully contacted via email');

    }

    public function rejectRequestByReceiver(Request $request){

                $reject_request  =  RequestBidders::where([
            ['id', $request->request_bid_id],
        ])->update([
            'status' => 'Rejected',
        ]);

        if($reject_request){
            $request_bidding_record = RequestBidders::find($request->request_bid_id);
           // dd($request_bidding_record);
            if($request_bidding_record->request_type  == 'Get Help'){
                $main_request = LockdownRequest::find($request_bidding_record->request_id);// the help (request)
                $help_receiver = User::find($request_bidding_record->bidder_id); // the user bidding to get help 
                $help_provider= User::find($request_bidding_record->requester_id);

         $approve_or_reject_noty = (new NotifyUserOfRequestApprovalOrRejection($help_provider,$main_request,$help_receiver,$request_bidding_record))->delay(5);
           $this->dispatch($approve_or_reject_noty);

            }

        return back()->with('success', 'Request rejected');
        }else{
            return back()->withInput()->with('error', 'An attempt to reject request failed. Please try again');

        }
    }
}
