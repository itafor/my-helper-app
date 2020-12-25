<?php

use App\City;
use App\Country;
use App\PickupRequest;
use App\ProviderLocation;
use App\RequestBidders;
use App\RequestPhoto;
use App\ShipmentItem;
use App\State;
use App\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JD\Cloudder\Facades\Cloudder;


function getCountries()
{
    $countries = Country::all();
    return $countries;
}

function getStates()
{
    $states = State::all();
    return $states;
}

function getCities()
{
    $cities = City::all();
    return $cities;
}

function getLogisticPartners()
{
    $logistic_partners = User::where([
   		['userType','Logistic']
   	])->orderBy('created_at','desc')->get();

    return $logistic_partners;
}

function authUser()
{
    return auth()->user();
}

function user_already_contacted_help_provider($requester_id,$request_id,$user_id,$request_type){
    $result = RequestBidders::where([
        ['requester_id',$requester_id],
        ['request_id',$request_id],
        ['bidder_id',$user_id],
        ['request_type','Provide Help'],
    ])->first();
    return $result;
}

function user_already_contacted_help_seeker($requester_id,$request_id,$bidder_id,$request_type){
    $result = RequestBidders::where([
        ['requester_id',$requester_id],
        ['request_id',$request_id],
        ['bidder_id',$bidder_id],
        ['request_type','Get Help'],
    ])->first();
    return $result;
}

function helpProviderPickupRequestDetails($providerId, $request_id, $receiver_id){

  $pickup_request = PickupRequest::where([
    ['provider_id', $providerId],
    ['request_id', $request_id],
    ['receiver_id', $receiver_id],
  ])->first();

  return $pickup_request;
}

function helpReceiverPickupRequestDetails($receiver_id, $request_id, $providerId){

  $pickupRequest = PickupRequest::where([
    ['receiver_id', $receiver_id],
    ['request_id', $request_id],
    ['provider_id', $providerId],
  ])->first();

  return $pickupRequest;
}

function uploadImage($image)
{
    if(isset($image))
    {
        if($image->isValid()) 
        {
            $filename = $name = 'myhelperapp_'.$image->getClientOriginalName();
            $filename = str_replace(' ','_', $filename);
            $trans = array(
                ".png" => "", 
                ".PNG" => "",
                ".JPG" => "",
                ".jpg" => "",
                ".jpeg" => "",
                ".JPEG" => "",
                ".bmp" => "",
                ".pdf" => "",
            );
            $filename = strtr($filename,$trans);
            Cloudder::upload($image->getPathname(), $filename);
            $response = Cloudder::getResult();
            $path = $response['secure_url'];
        }
    }
    return $path;
}

function authToken(){
        $client = new Client(['verify' => false]);

                $res = $client->request('POST', 'http://api.clicknship.com.ng/Token', [
                    'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'username' => 'cnsdemoapiacct',
                'password' => 'ClickNShip$12345',
                'grant_type' => 'password'
            ]
        ]);
                
    $res = json_decode($res->getBody()->getContents(), true);

    return $res['access_token'];

}

function clickship_states(){
    
    $client = new Client(['verify' => false]);

     $states = $client->get('http://api.clicknship.com.ng/clicknship/Operations/States', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                            'Content-Type' => 'application/json'
                        ],
                    ]);

     $response = $states->getBody()->getContents();
     $values = json_decode($response, true);

     return $values;
}

function clickship_cities(){
    
    $client = new Client(['verify' => false]);

     $cities = $client->get('http://api.clicknship.com.ng/clicknship/operations/cities', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                            'Content-Type' => 'application/json'
                        ],
                    ]);

      $response = $cities->getBody()->getContents();
     $values = json_decode($response, true);

     return $values;

}



function calculate_delivery_fee(){
    
    $client = new Client(['verify' => false]);

     $fee = $client->post('http://api.clicknship.com.ng/clicknship/Operations/DeliveryFee', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                        ],
                'form_params' => [
                'Origin' => 'IBADAN',
                'Destination' => 'ABUJA',
                'Weight' => 1.5,
                'OnforwardingTownID'=>690
            ]
                    ]);

       $response = $fee->getBody()->getContents();
      $values = json_decode($response, true);

     return $values;
}

function getCityName_by_citycode($city_code){
    
    $client = new Client(['verify' => false]);

     $cities = $client->get('http://api.clicknship.com.ng/clicknship/operations/cities', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                            'Content-Type' => 'application/json'
                        ],
                    ]);

      $response = $cities->getBody()->getContents();
     $values = json_decode($response, true);

     foreach ($values as $key => $city) {
        if($city['CityCode'] == $city_code){
            return $city['CityName'];
        }
     }

}

function payment_types(){
    
    $client = new Client(['verify' => false]);

     $paymentType = $client->get('http://api.clicknship.com.ng/clicknship/operations/PaymentTypes', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                            'Content-Type' => 'application/json'
                        ],
                    ]);

      $response = $paymentType->getBody()->getContents();
     $values = json_decode($response, true);

     return $values;
}

function delivery_types(){
    
    $client = new Client(['verify' => false]);

     $deliverytype = $client->get('http://api.clicknship.com.ng/clicknship/Operations/DeliveryTypes', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                            'Content-Type' => 'application/json'
                        ],
                    ]);

      $response = $deliverytype->getBody()->getContents();
     $values = json_decode($response, true);

     return $values;
}


 
function getCityCode_by_CityName($city_name){
    
    $client = new Client(['verify' => false]);

     $cities = $client->get('http://api.clicknship.com.ng/clicknship/operations/cities', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                            'Content-Type' => 'application/json'
                        ],
                    ]);

      $response = $cities->getBody()->getContents();
     $values = json_decode($response, true);

     foreach ($values as $key => $city) {
        if($city['CityName'] == $city_name){
            return getTownID($city['CityCode']);
        }
     }

}

function getTownID($city_code){
    
    $client = new Client(['verify' => false]);

 $towns = $client->get('http://api.clicknship.com.ng/clicknship/Operations/DeliveryTowns?CityCode='.$city_code.'', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                        ],
              
                    ]);

       $response = $towns->getBody()->getContents();
      $values = json_decode($response, true);


      return $values;
}

function shippmentItems($pickupRequest_id,$request_id,$provider_id,$receiver_id){
      $items = ShipmentItem::where([
        ['pickupRequest_id',$pickupRequest_id],
        ['request_id',$request_id],
        ['provider_id',$provider_id],
        ['receiver_id',$receiver_id],
      ])->get();
  if($items){
    return $items;
  }
}

function providerDetail($request_id,$provider_id){
    $detail = ProviderLocation::where([
        ['request_id',$request_id],
        ['provider_id',$provider_id],
      ])->first();
  if($detail){
    return $detail;
  }
}

 function deliveryFee($origin,$destination,$weight,$OnforwardingTownID=null){


           $client = new Client(['verify' => false]);

     $fee = $client->post('http://api.clicknship.com.ng/clicknship/Operations/DeliveryFee', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                        ],
                'form_params' => [
                'Origin' => $origin,
                'Destination' => $destination,
                'Weight' => $weight,
                'OnforwardingTownID'=> $OnforwardingTownID,
            ]
                    ]);

       $response = $fee->getBody()->getContents();
     $delivery_cost = json_decode($response, true);

       return $delivery_cost;

}

function paymentStatus($paymentRef){
    
    $client = new Client(['verify' => false]);

     $checkPaymentRef = $client->get('https://api.clicknship.com.ng/ClicknShip/NotifyMe/RequeryPayment?PaymentRef='.$paymentRef.'', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                        ],
              
                    ]);

       $response = $checkPaymentRef->getBody()->getContents();
      $values = json_decode($response, true);


      return $values;
}


function requestPhotos($request_id,$provider_id){
   $request_photos= RequestPhoto::where([
          ['request_id', $request_id],
          ['provider_id',$provider_id],
       ])->get();
   return $request_photos;
}

function itemSize($size){
  switch ($size) {
    case 1:
     return 'Small';
      break;
    case 2:
      return 'Medium';
       break;
    case 4:
      return 'Large';
       break;
    default:
     return 'Size Not Specified';
      break;
  }
}