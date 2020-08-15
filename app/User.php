<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_name', 'phone', 'username',
        'country_id', 'state_id', 'city_id', 'street','api_state', 'api_city', 'company_name', 'website', 'user_type','userType'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function lockdownRequests()
    {
        return $this->belongsToMany('App\LockdownRequest');
    }

    public function requesters(){
        return $this->hasMany(RequestBidders::class,'requester_id','id');
    }

    public function bidders(){
        return $this->hasMany(RequestBidders::class,'bidder_id','id');
    }

     public function logistic_partners(){
        return $this->hasMany(RequestBidders::class,'logistic_partner_id','id');
    }


    public static function updateLogistic($data)
    {
     $logistic  =  self::where([
            ['id', $data['logistic_id'] ],
            ['userType', 'Logistic']
        ])->update([
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'company_name' => $data['company_name'],
            'country_id' => $data['country_id'],
            'state_id' => $data['state_id'],
            'city_id' => $data['city_id'],
            'street' => $data['street'],
          
        ]); 

        return $logistic;
    }
}
