<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

     protected $fillable = [
        'title', 'description'
    ];

      public static function updateProduct($data)
    {
     $product  =  self::where([
            ['id', $data['product_id'] ],
        ])->update([
            'title' => $data['product_title'],
            'description' => $data['description'],
        ]); 

        return $product;
    }
    
}
