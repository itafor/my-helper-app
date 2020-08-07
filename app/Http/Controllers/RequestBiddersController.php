<?php

namespace App\Http\Controllers;

use App\Jobs\GrantUserRequest;
use App\Jobs\NotifyLogisticToDeliverGoods;
use App\Jobs\NotifyUserOfRequestApprovalOrRejection;
use App\Jobs\SendRequestToGetHelp;
use App\Jobs\SendhelpSeekerInfoToLogisticPartner;
use App\Jobs\sendConfirmationCodeToReceiver;
use App\LockdownRequest;
use App\RequestBidders;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class RequestBiddersController extends Controller
{
	//apply to be a benefiary of someone request to provide help
    public function applyTOGetHelp(Request $request) {

	  $data = $request->all();
	 // dd($data);
       $validator = validator::make($data,[
            'request_id'=>'required',
            'requester_id'=>'required',
            'request_type'=>'required',
    ]);

    if($validator->fails()){
         return  back()->withErrors($validator)
                        ->withInput()->with('error', 'Please fill in a required fields');
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
       //dd($data['request_bid']);
       $data['request_bidder'] =  $data['request_bid']->bidder;
       $data['request'] =  $data['request_bid']->request;
       $data['help_provider'] =  $data['request_bid']->requester;
       $data['logistic_partner'] =  $data['request_bid']->logistic_partner;
       $data['request_photos'] = $data['request']->requestPhotos;

       return view('requests.make.approve_or_reject_request',$data);

    }

      public function finalRequestApprovalByHelpReceiver(Request $request){
      
     $data = $request->all();
    //dd($data);
       $validator = validator::make($data,[
            'logistic_partner_id'=>'required',
    ]);

    if($validator->fails()){
         return  back()->withErrors($validator)
                        ->withInput()->with('error', 'Please fill in a required fields');
    }

       DB::beginTransaction();
        try{
       $request_bidding_record = RequestBidders::approveRequestToReceiveHelp($data);

       if($request_bidding_record){

        $main_request = LockdownRequest::find($data['request_id']);// the help (request)
        $request_bidder = User::find($data['bidder_id']); // the user bidding to get help 
        $help_provider= User::find($data['requester_id']);
        $logistic_partner = User::find($data['logistic_partner_id']); 

       $logistic_partner_job = (new NotifyLogisticToDeliverGoods($help_provider,$main_request,$request_bidder,$logistic_partner,$request_bidding_record))->delay(5);
        $this->dispatch($logistic_partner_job);

         $receiver_job = (new sendConfirmationCodeToReceiver($help_provider,$main_request,$request_bidder,$logistic_partner,$request_bidding_record))->delay(5);
        $this->dispatch($receiver_job);


        $approve_or_reject_noty = (new NotifyUserOfRequestApprovalOrRejection($help_provider,$main_request,$request_bidder,$logistic_partner,$request_bidding_record))->delay(5);
        $this->dispatch($approve_or_reject_noty);

            DB::commit();
          }
        }
        catch(Exception $e){
            DB::rollback();
            return back()->withInput()->with('error', 'An attempt to approve user request failed. Please try again');
        }

        return back()->with('success', 'User request successfully approved');

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
   // dd($data);
       $validator = validator::make($data,[
            'logistic_partner_id'=>'required',
            'delievery_cost'=>'required',
    ]);

    if($validator->fails()){
         return  back()->withErrors($validator)
                        ->withInput()->with('error', 'Please fill in a required fields');
    }

       DB::beginTransaction();
        try{
       $request_bidding_record = RequestBidders::approveHelpSeekersRequest($data);

       if($request_bidding_record){

        $help_provider= authUser(); //The user that want to provide help
        $main_request = LockdownRequest::find($data['request_id']);// the help (request)
        $request_bidder = User::find($data['bidder_id']); // the user bidding to get help 
        $logistic_partner = User::find($data['logistic_partner_id']); 

       $logistic_partner_job = (new NotifyLogisticToDeliverGoods($help_provider,$main_request,$request_bidder,$logistic_partner,$request_bidding_record))->delay(5);
        $this->dispatch($logistic_partner_job);

         $receiver_job = (new sendConfirmationCodeToReceiver($help_provider,$main_request,$request_bidder,$logistic_partner,$request_bidding_record))->delay(5);
        $this->dispatch($receiver_job);

            DB::commit();
          }
        }
        catch(Exception $e){
            DB::rollback();
            return back()->withInput()->with('error', 'An attempt to approve user request failed. Please try again');
        }

        return back()->with('success', 'User request successfully approved');

    }


     public function grantSomeoneRequest(Request $request){
      
     $data = $request->all();
    //dd($data);
    //    $validator = validator::make($data,[
    //         'logistic_partner_id'=>'required',
    //         'delievery_cost'=>'required',
    // ]);

    // if($validator->fails()){
    //      return  back()->withErrors($validator)
    //                     ->withInput()->with('error', 'Please fill in a required fields');
    // }

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

        return back()->with('success', 'User request successfully approved');

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
                $logistic_partner = User::find($request_bidding_record->logistic_partner_id);

         $approve_or_reject_noty = (new NotifyUserOfRequestApprovalOrRejection($help_provider,$main_request,$help_receiver,$help_provider,$request_bidding_record))->delay(5);
           $this->dispatch($approve_or_reject_noty);

            }

        return back()->with('success', 'Request rejected');
        }else{
            return back()->withInput()->with('error', 'An attempt to reject request failed. Please try again');

        }
    }
}
