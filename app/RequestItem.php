<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestItem extends Model
{
     use SoftDeletes;

    protected $fillable = ['request_id','item_category_id','item_id'];

    public function item()
    {
    	return $this->belongsTo(ItemSubCategory::class,'item_id','id');
    }

    public function itemCategory()
    {
    	return $this->belongsTo(Category::class,'item_category_id','id');
    }

     public function lockDownReq()
    {
    	return $this->belongsTo(LockdownRequest::class,'request_id','id');
    }

    	public static function addNew($data, $req)
    	{
    		if(isset($data['items']) && $data['items'] !=''){
    			foreach ($data['items'] as $key => $item) {
    				self::create([
    				'request_id' => $req->id,
    				'item_category_id' => $req->category_id,
    				'item_id' => $item,
    			]);
    			}
    		}
    	}
}

