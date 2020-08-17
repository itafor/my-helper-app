<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShipmentItem extends Model
{
     use SoftDeletes;

    protected $fillable = ['pickupRequest_id','ItemName','ItemUnitCost','ItemQuantity',
						   'ItemColour','ItemSize'
						];

	public function Pickup_request()
    {
        return $this->belongsTo('App\PickupRequest','pickupRequest_id','id');
    }
}
