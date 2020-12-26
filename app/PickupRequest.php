<?php

namespace App;

use App\ShipmentItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PickupRequest extends Model
{
    use SoftDeletes;

    protected $fillable = ['TransStatus','TransStatusDetails','OrderNo','WaybillNumber',
						   'DeliveryFee','VatAmount','TotalAmount',
						   'Description','Weight','SenderName','SenderCity','SenderTownID',
						   'SenderAddress','SenderPhone','SenderEmail','RecipientName','RecipientCity',
						   'RecipientTownID','RecipientAddress','RecipientPhone','RecipientEmail','PaymentType','DeliveryType','request_id','provider_id','receiver_id','PaymentRef'
						];


 public function request()
    {
        return $this->belongsTo('App\LockdownRequest','request_id','id');
    }

 public function provider()
    {
        return $this->belongsTo('App\User','provider_id','id');
    }

public function receiver()
    {
        return $this->belongsTo('App\User','receiver_id','id');
    }

    public function shipment_items(){
        return $this->hasMany(ShipmentItem::class,'pickupRequest_id','id');
    }

   public static function createNewPickupRequest($data)
        {

        $pickupRequest = self::create([
                'OrderNo' => $data['OrderNo'],
                'TransStatus' => $data['TransStatus'],
                'WaybillNumber' => $data['WaybillNumber'],
                'TransStatusDetails' => $data['TransStatusDetails'],
                'DeliveryFee' => $data['DeliveryFee'],
                'VatAmount' => $data['VatAmount'],
                'TotalAmount' => $data['TotalAmount'],
                'Description' => $data['description'],
                'Weight' => $data['weight'],
                'SenderName'=>$data['senderName'],
                'SenderCity'=> $data['senderCity'],
                'SenderTownID'=> $data['senderTownID'],
                'SenderAddress'=> $data['senderAddress'],
                'SenderPhone' =>$data['senderPhone'],
                'SenderEmail' =>$data['senderEmail'],
                'RecipientName' =>$data['RecipientName'],
                'RecipientCity' =>$data['RecipientCity'],
                'RecipientTownID' =>$data['RecipientTownID'],
                'RecipientAddress' =>$data['RecipientAddress'],
                'RecipientPhone'=>$data['RecipientPhone'],
                'RecipientEmail'=>$data['RecipientEmail'],
                'PaymentType'=>$data['PaymentType'],
                'DeliveryType'=>$data['DeliveryType'],
                'request_id'=>$data['request_id'],
                'provider_id'=>$data['requester_id'],
                'receiver_id'=>$data['bidder_id'],
        ]); 

        $pickup_request = self::where('id', $pickupRequest->id)->first();

         self::createShipmentItems($data,$pickup_request);
         
        return $pickupRequest;
    }

     public static function createShipmentItems($data,$pickupRequest)
    {
    	 if(isset($data['ShipmentItems'])){
        foreach($data['ShipmentItems'] as $item){
            ShipmentItem::create([
                'pickupRequest_id' => $pickupRequest->id,
                'request_id'=>$data['request_id'],
                'provider_id'=>$data['requester_id'],
                'receiver_id'=>$data['bidder_id'],
                'ItemName' => $item['ItemName'],
                'ItemUnitCost' => $item['ItemUnitCost'],
                'ItemQuantity' => $item['ItemQuantity'],
                'ItemColour' => $item['ItemColour'],
                'ItemSize' => $item['ItemSize'],
            ]);
        }
    }
}
 
 public static function updatePickupRequest($data)
 {
    $pickupd_req = self::where('id',$data['pickupRequest_id'])->first();

    if($pickupd_req){
        $pickupd_req->PaymentRef = $data['paymentRef'];
        $pickupd_req->save();
    }
 }

}
