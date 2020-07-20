<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class AdminController extends Controller
{

	public function dashboard(Request $request) {
    	
    return view('admin.dashboard');
    
}
	

    public function profile(Request $request) {
    	
    return view('admin.admin_profile');
}

   public function logisticEgents(Request $request) {
   	$data['logistics'] = User::where([
   		['userType','Logistic']
   	])->get();
    	
    return view('admin.logistic.index',$data);
}

 public function add_new_logistic_agent(Request $request) {
    	
    return view('admin.logistic.create');
}

public function storeLogisticEgent(Request $request) {

	  $data = $request->all();

       $validator = validator::make($data,[
             'company_name'=>'required',
            'username'=>'required|unique:users',
            'country_id'=>'required',
            'state_id'=>'required',
            'city_id'=>'required',
            'phone'=>'required',
            'street'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|confirmed',

    ]);

    if($validator->fails()){
         return  back()->withErrors($validator)
                        ->withInput()->with('error', 'Please fill in a required fields');
    }

        $data['password'] = bcrypt($data['password']);
        $data['userType'] = 'Logistic';
        $data['name'] = 'Logistic Agent';
        $data['user_type'] = 2;

    	 DB::beginTransaction();
        try{
    	 $user = User::create($data);
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            return back()->withInput()->with('error', 'An error occured. Please try again');
        }

        return back()->with('success', 'Logistic agent added successfully');
    }
    
    }


