<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Featured_photo;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    //code begin here
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CheckRole');
    }

    function product(){
        $category_data = Category::all();
        $product_data  = Product::where('user_id', Auth::id())->get();
        $soft_delete  = Product::where('user_id', Auth::id())->onlyTrashed()->get();
        return view('product.index',compact('category_data' , 'product_data', 'soft_delete'));
    }
    function productPost(Request $request){
        $request->validate([
            'product_name' => 'required | min:2 | max:50',
            'product_price' => 'required',
            'product_quantity' => 'required',
            'product_short_description' => 'required',
            'product_long_description' => 'required',
            'alert_product_quantity' => 'required',
            'product_image' => 'required |image|mimes:jpg,png'
        ]);;

        $original_image_name = Str::random(2).time().".". $request->product_image->getClientOriginalExtension();
        $temporary_image_name = $request->product_image->getClientOriginalName();
        $temporary_photo_address = $request->file('product_image');
        Image::make($temporary_photo_address)->resize(600, 471)->save(base_path('public/images/product_image/') . $original_image_name);
        $product_id  = Product::insertGetId( $request->except('_token' , 'product_image', 'product_featured_image')+ [
            //if form data post name and database data field name same we can insert this way also
            'user_id' => Auth::id(),
            'product_image' => $original_image_name,
            'created_at' => Carbon::now()
            ]);
        foreach( $request->file('product_featured_image') as $featured_image){
            $temporary_address_photo = $request->file('product_featured_image');
            $featured_photo = Str::random(2) . time() . "." .$featured_image->getClientOriginalExtension();
            Image::make($featured_image)->resize(600, 471)->save(base_path('public/images/product_featured_images/') . $featured_photo);
            Featured_photo::insert([
                //if form data post name and database data field name same we can insert this way also
            'product_id' => $product_id,
            'featured_photo_name' => $featured_photo,
            'created_at' => Carbon::now()
            ]);
        }
        return back()->with('product_insert_status','product inserted successfully');


    }
    function productUpdate($product_id){
        $data_product = Product::find($product_id);
        $category_list = Category::all();
        return view('product.update', compact('data_product', 'category_list'));

    }
    function productUpdatePost(Request $request){
        $id = $request->product_id;
        if($request->hasFile('update_product_photos')){
            $old_photo = Product::find($request->product_id)->product_image;
            unlink(base_path('public/images/product_image/') . $old_photo);
            $updated_photo_name =  Str::random(2).time().".". $request->update_product_photos->getClientOriginalExtension();
            $temporary_image_address = $request->file('update_product_photos');
            Image::make($temporary_image_address)->resize(600, 471)->save(base_path('public/images/product_image/') . $updated_photo_name);
            Product::find($id)->update([
                'product_image' => $updated_photo_name
            ]);
        }
        Product::find($id)->update([
            'category_id' => $request->update_category_id,
            'product_name' => $request->update_product_name,
            'product_price' =>  $request->update_product_price,
            'product_quantity' => $request->update_product_quantity,
            'product_short_description' => $request->update_product_short_description,
            'product_long_description' => $request->update_product_long_description,
            'alert_product_quantity' => $request->update_alert_product_quantity

        ]);
        return redirect('product');
    }
    function productDelete($product_id){
        if (Product::where('id', $product_id)->exists()) {
            Product::where('id', $product_id)->delete();
        }
        $db_query = Product::select('product_name')->where('id', $product_id)->first();
        return back()->with('category_delete', $db_query);
    }
    function productCheckedDelete(Request $request){
        if (isset($request->product_id)) {
            foreach ($request->product_id as $id) {
                Product::where('id', $id)->delete();
            }
        } else {
            return back()->with('product_checked_data_status', 'Please checked again');
        }

        return back();
    }
    function productRestore($product_id){
        Product::withTrashed()->where('id', $product_id)->restore();
        return back();
    }
    function productForceDelete($product_id){
        Product::withTrashed()->where('id', $product_id)->forceDelete();
        return back();
    }
    function subcategoryPost(Request $request){
        $subcategory_name = "";
        // <option value="">choose one</option>
        foreach (Subcategory::where('category_id', $request->category_id)->select('id', 'subcategory_name')->get() as $key) {
            $city_list = $subcategory_name . "<option value='" . $key->id . "'>$key->subcategory_name</option>";
        }
        echo $city_list;
    }

}
