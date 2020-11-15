<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class PickupRequestController extends Controller
{

	public function showShipmentTrackingForm(){

       return view('PickupRequest.trackshipment');
    }

    public function trackShipment(Request $request){

    	$waybillno = $request->WayBillNumber;

    	  $client = new Client(['verify' => false]);

     $result = $client->get('http://api.clicknship.com.ng/clicknship/Operations/TrackShipment?waybillno= '.$waybillno.'', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                            'Content-Type' => 'application/json'
                        ],
                    ]);

     $response = $result->getBody()->getContents();
     $data['tracking_responses'] = json_decode($response, true);

     if($data['tracking_responses'] == []){
     	return  back()->withInput()->with('error', 'No tracking response found!!');
     }

       return view('PickupRequest.trackshipment',$data);
    }

public function calculateDeliveryFeeForm(Request  $request){

       return view('PickupRequest.calculate_delivery_fee');
}

public function calculateDeliveryFeeOperation(Request  $request){

        $data = $request->all();
        $data['Destination'] = getCityName_by_citycode($data['Destination']);
// dd($data);
           $client = new Client(['verify' => false]);

     $fee = $client->post('http://api.clicknship.com.ng/clicknship/Operations/DeliveryFee', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                        ],
                'form_params' => [
                'Origin' => $data['Origin'],
                'Destination' => $data['Destination'],
                'Weight' => $data['Weight'],
                'OnforwardingTownID'=> isset($data['OnforwardingTownID']) ? $data['OnforwardingTownID'] : '',
            ]
                    ]);

       $response = $fee->getBody()->getContents();
      $data['deliveryFee'] = json_decode($response, true);

     // dd($data['deliveryFee']);

       return view('PickupRequest.calculate_delivery_fee',$data);

}

}
