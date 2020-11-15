<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\City;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class AjaxController extends Controller
{
    public function getState($id)
    {
        $states = State::where('country_id', $id)->get();
        return response()->json(['states' => $states]);
    }

    public function getCity($id)
    {
        $cities = City::where('state_id', $id)->get();
        return response()->json(['cities' => $cities]);
    }

    function fetch_cities_by_state($state){
    
    $client = new Client(['verify' => false]);

     $city = $client->get('http://api.clicknship.com.ng/clicknship/Operations/StateCities?StateName='.$state.'', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                            'Content-Type' => 'application/json'
                        ],
                    ]);

     $response = $city->getBody()->getContents();
     $values = json_decode($response, true);

      return response()->json(['cities' => $values]);

}

function fetchOnforwardingOrDeliveryTowns($city_code){
    
    $client = new Client(['verify' => false]);

     $towns = $client->get('http://api.clicknship.com.ng/clicknship/Operations/DeliveryTowns?CityCode='.$city_code.'', [
                        'headers' => [
                            'Authorization' => 'Bearer '.authToken(),
                        ],
              
                    ]);

       $response = $towns->getBody()->getContents();
      $values = json_decode($response, true);


      return response()->json(['towns' => $values]);

}

}
