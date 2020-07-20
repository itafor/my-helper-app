<?php

namespace App\Http\Controllers;

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
 
}

}
}
