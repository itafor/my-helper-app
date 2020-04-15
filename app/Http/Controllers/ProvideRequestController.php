<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Country;
use App\State;
use App\City;
use App\LockdownRequest;
use Session;

class ProvideRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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

        return view('requests.provide.create', compact('categories', 'countries', 'states', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth_create()
    {
        $categories = Category::all();
        $countries = Country::all();
        $states = State::all();
        $cities = City::all();

        return view('requests.provide.auth_create', compact('categories', 'countries', 'states', 'cities'));
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $getRequest = LockdownRequest::find($id);
        return view('requests.show', compact('getRequest'));
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
