<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestPhoto extends Model
{
     use SoftDeletes;

    protected $fillable = ['request_id','image_url','provider_id'];

    public function lockdown_request()
    {
        return $this->belongsTo('App\LockdownRequest','request_id','id');
    }
}
