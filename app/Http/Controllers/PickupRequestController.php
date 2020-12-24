<?php

namespace App\Http\Controllers;

use App\PickupRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

public function payWithPayStack(Request $request){

    $data = $request->all();

           $client = new Client(['verify' => false]);

     $pay_With_payStack = $client->post('https://api.clicknship.com.ng/ClicknShip/NotifyMe/PayWithPayStack', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                        ],
                'form_params' => [
                'WaybillNumber' => $data['waybillNo'],
                'CallBackURL' => "www.test.com",
            ]
                    ]);

       $response = $pay_With_payStack->getBody()->getContents();
     $payment_response = json_decode($response, true);

        if($payment_response['ResponseCode'] == '00'){
            $data['paymentRef'] = $payment_response['PaymentRef'];
            PickupRequest::updatePickupRequest($data);
            return Redirect::to($payment_response['CheckoutURL']);
        }
     
      return back()->withInput()->with('error', $payment_response['ResponseDescription']);

}

public function getPaymentStatus(){
    return view('PickupRequest.payment_status');
}

public function checkPaymentStatus(Request $request){
    
    $data = $request->all();

    $client = new Client(['verify' => false]);

     $checkPaymentRef = $client->get('https://api.clicknship.com.ng/ClicknShip/NotifyMe/RequeryPayment?PaymentRef='.$data['paymentRef'].'', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                        ],
              
                    ]);

       $response = $checkPaymentRef->getBody()->getContents();
      $values = json_decode($response, true);

      return back()->withInput()->with('error', $values);
}

}
