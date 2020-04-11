<?php

use App\Country;
use App\State;
use App\City;


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