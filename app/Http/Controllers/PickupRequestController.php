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
}
