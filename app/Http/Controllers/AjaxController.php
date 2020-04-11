<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\State;
use App\City;

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
}
