<?php

namespace App\Http\Controllers;

use App\RequestBidders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class RequestBiddersController extends Controller
{
	//apply to be a benefiary of someone request to provide help
    public function applyTOGetHelp(Request $request) {

	  $data = $request->all();
	  // dd($data);
   //     $validator = validator::make($data,[
   //          'request_id'=>'required',
   //          'requester_id'=>'required',
   //          'bidder_id'=>'required',
   //          'request_type'=>'required',
   //  ]);

   //  if($validator->fails()){
   //       return  back()->withErrors($validator)
   //                      ->withInput()->with('error', 'Please fill in a required fields');
   //  }

    	 DB::beginTransaction();
        try{
    	 $user = RequestBidders::createNew($data);
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            return back()->withInput()->with('error', 'An attempt to apply for the request below failed. Please try again');
        }

        return back()->with('success', 'An attempt to apply for the request below was successful');
    }
}
