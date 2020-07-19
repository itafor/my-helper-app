<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function profile(Request $request) {
    	
    return view('admin.admin_profile');
}
	
}
