<?php

use App\City;
use App\Country;
use App\RequestBidders;
use App\State;
use App\User;


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