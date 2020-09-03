<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderLocation extends Model
{
     protected $fillable = ['request_id','provider_id','receiver_id',
						   'api_state','api_city','api_delivery_town',
						   'providerAddress','api_delivery_town_id'
						];
}
