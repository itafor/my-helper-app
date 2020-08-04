<?php

namespace App;

use App\RequestPhoto;
use Illuminate\Database\Eloquent\Model;

class LockdownRequest extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

     public function request_bidders(){
        return $this->hasMany(RequestBidders::class,'request_id','id');
    }

     public function requestPhotos(){
        return $this->hasMany(RequestPhoto::class,'request_id','id');
    }


    public static function addPhotos($data,$lockdown_request)
    {
       
        if(isset($data['photos'])){
            foreach($data['photos'] as $photo){

                $files=$photo['image_url'];

                if($files){

            $name=$files->getClientOriginalName();
            
            $files->move('request_photos',$name);
            
                RequestPhoto::create([
                    'request_id' => $lockdown_request->id,
                    'image_url' => $name
                ]);
            
        }
    }
        }
    }
    
}
