<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LockdownRequest extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category');
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
