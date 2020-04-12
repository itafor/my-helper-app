<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LockdownRequest;

class LandingPageController extends Controller
{
    public function landing_page()
    {
        $allRequests = LockdownRequest::orderBy('created_at', 'DESC')->get();
        return view('welcome', compact('allRequests'));

        
    }
}
