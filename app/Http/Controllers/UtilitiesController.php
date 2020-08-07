<?php

namespace App\Http\Controllers;

use App\Category;
use App\Jobs\NotifyUserOfRequestApprovalOrRejection;
use App\LockdownRequest;
use App\RequestBidders;
use App\User;
use Illuminate\Http\Request;

class UtilitiesController extends Controller
{
    public function destroyItem($item,$item_id){
    	
     if($item =='LogisticAgent'){
     	$logistic = User::where([
     		['id',$item_id],
     		['userType','logistic']
     	])->first();
     	if($logistic->delete()){
 return response()->json($logistic);
  }
 
}else if($item =='Products'){
     	$product = Category::where([
     		['id',$item_id],
     	])->first();
     	if($product->delete()){
 return response()->json($product);
  }
 
}

}

public function rejectRequest($request_bid_id){
        
          $reject_request  =  RequestBidders::where([
            ['id', $request_bid_id],
        ])->update([
            'status' => 'Rejected',
        ]);

        if($reject_request){
            $request_bidding_record = RequestBidders::find($request_bid_id);

            return response()->json($request_bidding_record);
        }

}

}