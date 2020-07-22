<?php

namespace App\Http\Controllers;

use App\Jobs\SendRequestToGetHelp;
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

       $job = (new SendRequestToGetHelp($request_bidder,$user_request,$help_provider))->delay(5);

        $this->dispatch($job);

            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            return back()->withInput()->with('error', 'An attempt to apply for the request below failed. Please try again');
        }

        return back()->with('success', 'An attempt to apply for the request below was successful');
    }
}
