<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function how_it_works()
    {
        return view('how_it_works');
    }
    public function all_requests()
    {
        return view('all-requests');
    }
   
}
