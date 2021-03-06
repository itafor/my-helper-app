<?php

namespace App;

use App\ProviderLocation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestBidders extends Model
{
    use SoftDeletes;

    protected $fillable = ['request_id','requester_id','bidder_id',
						   'logistic_partner_id','request_type','status',
						   'confirmation_code','delievery_cost','comment','pickup_status','payment_type','weight'
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
            'requester_id' => $data['requester_id'],//help provider
            'bidder_id' => authUser()->id,//help receiver
            'request_type' =>  $data['request_type'],
            'status' =>  'Pending',
            'logistic_partner_id' =>  $logistic,
            'confirmation_code' =>  $confirmationCode,
            'delievery_cost' =>  $delievery_cost,
            'comment' =>  $comment,
        ]); 

        if($request_bid){
            self::addProviderLocation($data);
        }

        return $request_bid;
    }


    public static function approveHelpSeekersRequest($data)
    {

        $comment = isset($data['comment']) ? $data['comment'] : null;

     $approve_request  =  self::where([
            ['id', $data['request_bid_id'] ],
            ['request_id', $data['request_id'] ],
            ['bidder_id', $data['bidder_id'] ],
            ['requester_id', $data['requester_id'] ],
        ])->update([
            'comment' => $comment,
            'confirmation_code' => mt_rand(100000, 999999).$data['bidder_id'],
            'status' => 'Approved',
            'pickup_status' => 'Success',
        ]); 

        if($approve_request){
            $request_bid = self::where([
            ['id', $data['request_bid_id'] ],
            ['request_id', $data['request_id'] ],
            ['bidder_id', $data['bidder_id'] ],
            ['requester_id', $data['requester_id'] ],
            ])->first();
        return $request_bid;
        }

    }


    public static function grant_request($data)
    {
        $logistic = isset($data['logistic_partner_id']) ? $data['logistic_partner_id'] : null;
        $delievery_cost = isset($data['delievery_cost']) ? $data['delievery_cost'] : null;
        $comment = isset($data['comment']) ? $data['comment'] : null;

        $requestBidder = self::create([
            'request_id' => $data['request_id'],
            'requester_id' => $data['requester_id'],//help provider
            'bidder_id' => $data['bidder_id'],//help receiver
            'request_type' =>  $data['request_type'],
            'status' =>  'Pending',
            'comment' =>  $comment,
        ]); 

        if($requestBidder){
            self::updateRequest($data, $requestBidder);
            self::addProviderLocation($data);
        }
        
        return $requestBidder;
    }


    public static function confirmProductDelivery($data){
    
    $confirm =  self::where([
        ['bidder_id',$data['bidder_id']],
        ['id',$data['request_bid_id']],
        ['confirmation_code',$data['confirmation_code']],
        ['logistic_partner_id',authUser()->id],
    ])->first();
//dd($confirm);
     if($confirm){
    $confirm->status = 'Delivered';
    $confirm->save();
    }
    return $confirm;
    }



    public static function approveRequestToReceiveHelp($data)
    {

        $comment = isset($data['comment']) ? $data['comment'] : null;

     $approve_request  =  self::where([
            ['id', $data['request_bid_id'] ],
            ['request_id', $data['request_id'] ],
            ['bidder_id', $data['bidder_id'] ],
            ['requester_id', $data['requester_id'] ],
        ])->update([
            'comment' => $comment,
            'status' => 'Approved',
            'pickup_status' => 'Success',
        ]); 

        if($approve_request){
            $request_bid = self::where([
            ['id', $data['request_bid_id'] ],
            ['request_id', $data['request_id'] ],
            ['bidder_id', $data['bidder_id'] ],
            ['requester_id', $data['requester_id'] ],
            ])->first();
        return $request_bid;
        }

    }

       public static function updateRequest($data, $requestBidder)
    {

     $update_request  =  self::where([
            ['id', $requestBidder->id],
        ])->update([
            'payment_type' => $data['delivery_cost_payer'],
            'weight' => $data['weight'],
        ]); 

        return $update_request;

    }

    public static function addProviderLocation($data)
    {

         $onforwardingTown= isset($data['api_onforwarding_town_id']) ? explode('-', $data['api_onforwarding_town_id']) : '-testing';

       $trimmedonforwardingTown=trim($onforwardingTown[1]);

        $location = ProviderLocation::create([
            'request_id' => $data['request_id'],
            'provider_id' => authUser()->id,//help provider
            'api_state' => $data['api_state'],
            'api_city' => getCityName_by_citycode($data['api_city']),
            'api_delivery_town' => $trimmedonforwardingTown =='t' ? null : $trimmedonforwardingTown,
            'api_delivery_town_id' => isset($data['api_delivery_town_id']) ? $data['api_delivery_town_id'] : null,
            'providerAddress' => $data['street'],
        ]); 
        
        return $location;
    }
}
