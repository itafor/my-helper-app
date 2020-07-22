<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestBidders extends Model
{
    use SoftDeletes;

    protected $fillable = ['request_id','requester_id','bidder_id',
						   'logistic_partner_id','request_type','status',
						   'confirmation_code','delievery_cost','comment'
						];

 public function request()
    {
        return $this->belongsTo('App\LockdownRequest','request_id','id');
    }

 public function requester()
    {
        return $this->belongsTo('App\User','requester_id','id');
    }

public function bidder()
    {
        return $this->belongsTo('App\User','bidder_id','id');
    }

public function logistic_partner()
    {
        return $this->belongsTo('App\User','logistic_partner_id','id');
    }

public static function createNew($data)
    {
        $logistic = isset($data['logistic_partner_id']) ? $data['logistic_partner_id'] : null;
        $delievery_cost = isset($data['delievery_cost']) ? $data['delievery_cost'] : null;
        $comment = isset($data['comment']) ? $data['comment'] : null;
        $confirmationCode = $data['request_type'] == 'Get Help' ? '123oo21' : null;

        $request_bid = self::create([
            'request_id' => $data['request_id'],
            'requester_id' => $data['requester_id'],
            'bidder_id' => authUser()->id,
            'request_type' =>  $data['request_type'],
            'status' =>  'Pending',
            'logistic_partner_id' =>  $logistic,
            'confirmation_code' =>  $confirmationCode,
            'delievery_cost' =>  $delievery_cost,
            'comment' =>  $comment,
        ]); 
        
        return $request_bid;
    }


}
