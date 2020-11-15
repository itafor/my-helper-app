<?php

namespace App\Http\Controllers;

use App\Category;
use App\Jobs\NotifyUserOfRequestApprovalOrRejection;
use App\LockdownRequest;
use App\PickupRequest;
use App\RequestBidders;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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

 function submittingPickupRequestInformationandGeneratingWaybillNumber(){

        $client = new Client(['verify' => false]);

     $pickupRequest = $client->post('http://api.clicknship.com.ng/clicknship/Operations/PickupRequest', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                        ],
                'form_params' => [
                'OrderNo' => 'Ord-'. mt_rand(1000000, 9999999),
                'Description' => 'PAIR OF SHOES AND BAGS',
                'Weight' => 4.0,
                'SenderName'=>'PETER ADEOGUN',
                'SenderCity'=>'LAGOS ISLAND',
                'SenderTownID'=>'32',
                'SenderAddress'=>'32 AJOSE ADEOGUN STREET,VICTORIA ISLAND, LAGOS',
                'SenderPhone' =>'08077846453',
                'SenderEmail' =>'PETER@YAHOO.COM',
                'RecipientName' =>'BENSON ADEWALE',
                'RecipientCity' =>'IBADAN',
                'RecipientTownID' =>'45',
                'RecipientAddress' =>'23 Ikorodu Road, Maryland,Lagos',
                'RecipientPhone'=>'08076522536',
                'RecipientEmail'=>'testemail@yahoo.com',
                'PaymentType'=>'Pay On Delivery',
                'DeliveryType'=>'Normal Delivery',
                'ShipmentItems'=>[
                    ['ItemName'=>'BLACK SHOE','ItemUnitCost'=>4500.0,'ItemQuantity'=>5,'ItemColour'=>'BLACK','ItemSize'=>'45'],
                     ['ItemName'=>'HAND BAG','ItemUnitCost'=>9000.0,'ItemQuantity'=>5,'ItemColour'=>'BLUE','ItemSize'=>'23'],
                ],
            ]
                    ]);

       $response = $pickupRequest->getBody()->getContents();
      $values = json_decode($response, true);

     dd($values);


 }

    function printWaybill($waybillno = 'SA00574968' ){
    
    $client = new Client(['verify' => false]);

     $way_bill_no = $client->get('http://api.clicknship.com.ng/clicknship/Operations/PrintWaybill?waybillno= '.$waybillno.'', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                        ],
                    ]);

     $response = $way_bill_no->getBody()->getContents();
     $values = json_decode($response, true);

     dd($values);

 }

    function shippmentTracker($waybillno = 'SA00574968' ){
    
    $client = new Client(['verify' => false]);

     $result = $client->get('http://api.clicknship.com.ng/clicknship/Operations/TrackShipment?waybillno= '.$waybillno.'', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                            'Content-Type' => 'application/json'
                        ],
                    ]);

     $response = $result->getBody()->getContents();
     $values = json_decode($response, true);

     dd($values);

 }

 public function pickupRequestDetail($request_id, $provider_id, $receiver_id){
        $data['get_pickup_request'] = PickupRequest::where([
            ['request_id',$request_id],
            ['provider_id',$provider_id],
            ['receiver_id',$receiver_id],
        ])->first();

        return view('PickupRequest.details',$data);
 }

}