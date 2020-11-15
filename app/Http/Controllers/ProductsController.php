<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ProductsController extends Controller
{
    
   public function index(Request $request) {
   	$data['products'] = Category::orderBy('title','desc')->get();
    return view('admin.products.index',$data);
}

  public function product_services(Request $request) {
   	$data['products'] = Category::orderBy('title','desc')->get();
    return view('users.products.index',$data);
}


 public function create(Request $request) {
    	
    return view('admin.products.create');
}


public function storeLogisticEgent(Request $request) {

	  $data = $request->all();

       $validator = validator::make($data,[
             'title'=>'required',
            'description'=>'required',
    ]);

    if($validator->fails()){
         return  back()->withErrors($validator)
                        ->withInput()->with('error', 'Please fill in a required fields');
    }

    	 DB::beginTransaction();
        try{
    	 $user = Category::create($data);
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            return back()->withInput()->with('error', 'An error occured. Please try again');
        }

        return redirect()->route('admin.product.index')->with('success', 'Product added successfully');
    }
}
