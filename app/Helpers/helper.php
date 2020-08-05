<?php

use App\City;
use App\Country;
use App\RequestBidders;
use App\State;
use App\User;
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
            //$image->move(public_path("uploads"), $image->getClientOriginalName());
        }
    }
    return $path;
}