<?php

namespace App\Http\Controllers;

use App\LockdownRequest;
use App\RequestBidders;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class AdminController extends Controller
{

	public function dashboard(Request $request) {
    	 $data['all_requests'] = LockdownRequest::orderBy('created_at','desc')->get();
    return view('admin.dashboard',$data);
    
}
	

    public function profile(Request $request) {
    	 $data['admin_profile'] = User::where([
      ['id',authUser()->id],
      ['userType','Admin']
    ])->first();
    return view('admin.admin_profile',$data);
}

   public function allRequest(Request $request) {
    $data['all_requests'] = LockdownRequest::orderBy('created_at','desc')->get();
        
    return view('admin.requests.index',$data);
}

   public function requestDetails($id) {
    $data['request_details'] = LockdownRequest::where([
        ['id',$id],
    ])->with(['user'])->first();

  $data['request_photos'] = $data['request_details']->requestPhotos;


    $data['help_request_bidders']= $data['request_details']->request_bidders;
        
    return view('admin.requests.show',$data);
}


    public function request_summary($id){
       $data['request_bid'] = RequestBidders::find($id);
       $data['request_bidder'] =  $data['request_bid']->bidder;
       $data['request'] =  $data['request_bid']->request;
       $data['help_provider'] =  $data['request_bid']->requester;
       $data['logistic_partner'] =  $data['request_bid']->logistic_partner;
       $data['request_photos'] = $data['request']->requestPhotos;

       return view('admin.requests.request_summary',$data);

    }

   public function logisticEgents(Request $request) {
   	$data['logistics'] = User::where([
   		['userType','Logistic']
   	])->orderBy('created_at','desc')->get();
    	
    return view('admin.logistic.index',$data);
}

 public function add_new_logistic_agent(Request $request) {
    	
    return view('admin.logistic.create');
}

public function edit_logistic($id) {
            $data['logistic'] = User::where([
        ['userType','Logistic'],
        ['id',$id]
    ])->first();
    return view('admin.logistic.edit',$data);
}

public function show_logistic($id) {
            $data['logistic'] = User::where([
        ['userType','Logistic'],
        ['id',$id]
    ])->first();
    return view('admin.logistic.show',$data);
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

        return redirect()->route('admin.logistic.agent')->with('success', 'Logistic agent added successfully');
    }

    public function update_logistic(Request $request) {

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

    ]);

    if($validator->fails()){
         return  back()->withErrors($validator)
                        ->withInput()->with('error', 'Please fill in a required fields');
    }

         DB::beginTransaction();
        try{
         $user = User::updateLogistic($data);
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            return back()->withInput()->with('error', 'An error occured. Please try again');
        }

        return back()->with('success', 'Logistic agent details updated successfully');
    }
    
    }


