<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\LockdownRequest;
use App\Notifications\NewRegisteredUser;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/requests';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'agree_terms_and_conditions' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'last_name' => $data['last_name'],
            'phone' => $data['phone'],
            'username' => $data['username'] ?? null,
            'country_id' => $data['country_id'],
            'state_id' => $data['state_id'],
            'city_id' => $data['city_id'],
            'street' => $data['street'],
            'company_name' => $data['company_name'] ?? null,
            'website' => $data['website'] ?? null,
            'user_type' => $data['user_type'],
            'password' => Hash::make($data['password']),
        ]);
    }
    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $user->notify(new NewRegisteredUser($user));
        

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }
        
        if($request->has('category_id') || $request->has('description') || $request->type) {
            $lockdownRequest = new LockdownRequest;
            $userId = $user->id;
    
        
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
            $lockdownRequest->show_address = $request->show_address;
            $lockdownRequest->show_phone = $request->show_phone;
            
            $lockdownRequest->save();
        }
        return $request->wantsJson()
                    ? new Response('', 201)
                    : redirect($this->redirectPath());
    }
}
