<?php

namespace App;

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

    
}
