<?php

namespace App\Http\Controllers;

use App\Category;
use App\ItemSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ProductsController extends Controller
{
    
   public function index(Request $request) {
   	$data['products'] = Category::orderBy('created_at','desc')->get();
    return view('admin.products.index',$data);
}

  public function product_services(Request $request) {
   	$data['products'] = Category::orderBy('title','desc')->get();
    return view('users.products.index',$data);
}


 public function create(Request $request) {
    	
    return view('admin.products.create');
}

 public function showItemDetail($id)
    {
            $data['item'] = Category::find($id);
    return view('admin.products.show',$data);
    }

public function storeItemCategory(Request $request) {

	  $data = $request->all();

       $validator = validator::make($data,[
             'title'=>'required',
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

    public function createItemSubCategory()
    {
            $data['items'] = Category::orderBy('title','desc')->get();
    return view('admin.product_subcategory.create',$data);
    }

        public function storeItemSubcategory(Request $request)
    {

        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|max:50'
            // 'subcategories.*.name' => 'required|max:50'
        ]);
        if($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }

        

        $item_subcategory = ItemSubCategory::createNew($request->all());
       
       if($item_subcategory){
        $status = 'Item SubCategory has been created';

        return back()->with('success',$status);
       

        } else {

        return back()->withInput()->with('error', 'The process could not be completed');
          
        }

        
    }

    public function itemSubcategories(Request $request) {
    $data['items'] = ItemSubCategory::orderBy('created_at','desc')->get();
    return view('admin.product_subcategory.index',$data);
}

public function getItemsByCategory($id)
{
   $items = ItemSubCategory::where('category_id',$id)->get();
   return response()->json(['items'=>$items]);
}
}

