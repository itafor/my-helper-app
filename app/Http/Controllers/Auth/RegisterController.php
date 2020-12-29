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
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:245'],
            'api_state' => ['required', 'string', 'max:255'],
            'api_city' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:300'],
            'phone' => ['required', 'string', 'max:300'],
            'username' => ['required', 'string', 'max:300'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
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
            'api_state' => $data['api_state'],
            'api_city' => getCityName_by_citycode($data['api_city']),
            'api_delivery_town' => isset($data['api_delivery_town']) ? $data['api_delivery_town'] : null,
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

        dd($request->all());

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $user->notify(new NewRegisteredUser($user));
        

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

          $data= $request->all();

        $onforwardingTown= isset($data['api_onforwarding_town_id']) ? explode('-', $data['api_onforwarding_town_id']) : '-testing';

       $trimmedonforwardingTown=trim($onforwardingTown[1]);
        
        if($request->has('category_id') || $request->has('description')) {
            $lockdownRequest = new LockdownRequest;
            $userId = $user->id;
    
        
            $lockdownRequest->user_id = $userId;
            $lockdownRequest->request_type = $request->request_type;
            $lockdownRequest->category_id = $request->category_id;
            $lockdownRequest->description = $request->description;
            $lockdownRequest->api_state = $request->api_state;
            $lockdownRequest->api_city = getCityName_by_citycode($request->api_city);
            $lockdownRequest->api_delivery_town =  $trimmedonforwardingTown =='t' ? null : $trimmedonforwardingTown;
        $lockdownRequest->api_delivery_town_id = isset($data['api_delivery_town_id']) ? $data['api_delivery_town_id'] : null;
            $lockdownRequest->street = $request->street;
            $lockdownRequest->delivery_cost_payer = isset($data['delivery_cost_payer']) ? $data['delivery_cost_payer'] : null;
            $lockdownRequest->weight = isset($data['weight']) ? $data['weight'] : null;
            $lockdownRequest->save();

            if($lockdownRequest){
            $lockdown_request = LockdownRequest::find($lockdownRequest->id);
            LockdownRequest::addRequestPhoto($request->all(),$lockdown_request);
        }
        
        }
        return $request->wantsJson()
                    ? new Response('', 201)
                    : redirect($this->redirectPath());
    }
}
