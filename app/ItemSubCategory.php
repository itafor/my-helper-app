<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemSubCategory extends Model
{


protected $fillable = ['category_id','name'];

public function item_category()
{
	return $this->belongsTo(Category::class,'category_id','id');
}

 public function request_items()
    {
      return $this->hasMany(RequestItem::class,'item_id','id');
    }

    public static function createNew($data)
  {
  	
      foreach ($data['subcategories'] as $key => $subcategory) {
        $subcategory = self::create([
           'name' => $subcategory['name'],
           'category_id' => $data['category_id'],
        ]); 
      }

        return $subcategory;
    }

  public static function updateSubCategory($data)
    {

     $item_subcategory  =  self::where([
            ['id', $data['adSubCategoryId'] ],
        ])->update([
           'category_id' => $data['category_id'],
           'name' => $data['name'],
        ]); 

        return $item_subcategory;

    }
}
