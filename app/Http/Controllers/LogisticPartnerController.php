<?php

namespace App\Http\Controllers;

use App\LockdownRequest;
use App\RequestBidders;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class LogisticPartnerController extends Controller
{
    	
   public function dashboard(Request $request) {
    	 $data['all_requests'] = RequestBidders::where([
        ['logistic_partner_id', authUser()->id],
       ])->orderBy('created_at','desc')->get();

       $data['count_all_request'] = count($data['all_requests']);

        $data['confirmed_requests'] = RequestBidders::where([
        ['logistic_partner_id', authUser()->id],
        ['status', 'Delivered'],
       ])->orderBy('created_at','desc')->get();

       $data['count_confirmed_requests'] = count($data['confirmed_requests']);

       $data['unconfirmed_requests'] = RequestBidders::where([
        ['logistic_partner_id', authUser()->id],
        ['status', 'Approved'],
       ])->orderBy('created_at','desc')->get();

       $data['count_unconfirmed_requests'] = count($data['unconfirmed_requests']);


    return view('logisticPartner.dashboard',$data);
    
}
	

  public function requests(Request $request) {
    	 $data['all_requests'] = RequestBidders::where([
    	 	['logistic_partner_id', authUser()->id],
    	 ])->orderBy('created_at','desc')->get();
    	
    return view('logisticPartner.requests.index',$data);
}

   public function initialRequestConfirmationByLogisticPartner($id){
       $data['request_bid'] = RequestBidders::find($id);
       $data['request_bidder'] =  $data['request_bid']->bidder;
       $data['request'] =  $data['request_bid']->request;
       $data['help_provider'] =  $data['request_bid']->requester;
       $data['logistic_partner'] =  $data['request_bid']->logistic_partner;
       $data['request_photos'] = $data['request']->requestPhotos;

       return view('logisticPartner.requests.show',$data);

    }

       public function finalRequestConfirmationByLogisticPartner(Request $request){
      
     $data = $request->all();
   //dd($data);
       $validator = validator::make($data,[
            'bidder_id'=>'required',
            'request_bid_id'=>'required',
            'confirmation_code'=>'required',
    ]);

    if($validator->fails()){
         return  back()->withErrors($validator)
                        ->withInput()->with('error', 'Please fill in a required fields');
    }

       DB::beginTransaction();
        try{
       $product_delivery_confirmation = RequestBidders::confirmProductDelivery($data);
       if(!$product_delivery_confirmation){
         return back()->withInput()->with('error', 'Invalid confirmation code. Please try again');
       }
            DB::commit();
          
        }
        catch(Exception $e){
            DB::rollback();
            return back()->withInput()->with('error', 'An attempt to confirm product delivery failed. Please try again');
        }

        return back()->with('success', 'Product delivery successfully confirmed');

    }

public function profile(Request $request) {
    	   $data['logistics_profile'] = User::where([
      ['id',authUser()->id],
      ['userType','Logistic']
    ])->first();
    return view('logisticPartner.profile',$data);
	}

}
