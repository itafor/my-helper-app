<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LockdownRequest;
use App\Category;
use App\Country;
use App\State;
use App\City;
use Session;

class MakeRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allRequests = LockdownRequest::orderBy('created_at')->get();
        return view('requests.make.index', compact('allRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();
        return view('requests.make.create', compact('categories', 'countries', 'states', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lockdownRequest = new LockdownRequest;
        $userId = auth()->user()->id;

        $lockdownRequest->user_id = $userId;
        $lockdownRequest->request_type = $request->request_type;
        $lockdownRequest->category_id = $request->category_id;
        $lockdownRequest->description = $request->description;
        $lockdownRequest->country_id = $request->country_id;
        $lockdownRequest->state_id = $request->state_id;
        $lockdownRequest->city_id = $request->city_id;
        $lockdownRequest->street = $request->street;
        $lockdownRequest->type = $request->type;
        $lockdownRequest->mode_of_contact = $request->mode_of_contact;
        
        $lockdownRequest->save();
        Session::flash('status', 'Requests has been successfully registered');
        return redirect()->route('requests');

    }

    public function checkEmail(Request $request){
        $email = $request->input('email');
        $isExists = \App\User::where('email',$email)->first();
        if($isExists){
            return response()->json(array("exists" => true));
        }else{
            return response()->json(array("exists" => false));
        }
    }

    public function checkUserName(Request $request){
        $username = $request->input('username');
        $isExists = \App\User::where('username',$username)->first();
        if($isExists){
            return response()->json(array("exists" => true));
        }else{
            return response()->json(array("exists" => false));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getRequest = LockdownRequest::find($id);
        // dd($getRequest);
        return view('requests.make.show', compact('getRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
