<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\LockdownRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function user_requests(Request $request){

              $data['userRequests'] = LockdownRequest::where([
                ['user_id',authUser()->id]
              ])->orderBy('created_at', 'DESC')->get();

        return view('users.requests', $data);
    }
}
