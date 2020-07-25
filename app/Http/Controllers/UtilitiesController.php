<?php

namespace App\Http\Controllers;

use App\Category;
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

public function rejectRequest($request_id){
        
          $reject_request  =  RequestBidders::where([
            ['id', $request_id],
        ])->update([
            'status' => 'Rejected',
        ]);

        if($reject_request){
            $rejected_request = RequestBidders::find($request_id);
            return response()->json($rejected_request);
        }

}

}