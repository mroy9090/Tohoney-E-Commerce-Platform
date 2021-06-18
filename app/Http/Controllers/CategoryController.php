<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CheckRole');
    }
    function category(){
        $category_name_data = Category::where('user_id', Auth::id())->get();
        $soft_delete  = Category::where('user_id', Auth::id())->onlyTrashed()->get();
        
        return view('category.index', compact('category_name_data','soft_delete'));
    }
    function categoryPost(Request $request){
        $request->validate([
            'category_name' => 'required | min:2 | max:20 | unique:categories,category_name',
            'category_image' => 'required | image|mimes:jpg,png'
        ],[
            'category_name.required' => 'Category name should be filled in',
            'category_name.min' => 'Please give atleast 3 charecters',
            'category_name.max' => 'Length should not be more than 20 charecter'
        ]);

        $temporary_image = $request->category_image->getClientOriginalName();
        $temporary_image_location  = $request->file('category_image');
        $random_image_name  = Str::random(2) . time() . "." . $request->category_image->getClientOriginalExtension();
        Image::make($temporary_image_location)->resize(600,471)->save(base_path('public/images/category_image/') . $random_image_name);



        Category::insert([
            'user_id' => Auth::id(),
            'category_name' => $request->category_name,
            'category_image' => $random_image_name,
            'created_at' => Carbon::now()
        ]);
        return back()->with('category_insert_status' , 'Category name '. $request->category_name.' added successfully');
    }
    function categoryUpdate($category_id){
        $data_category = Category::find($category_id);
         return view('category.update',compact('data_category'));

    }

    function categoryUpdatePost(Request $request){
        $request->validate([
            'update_category_name' => 'unique:categories,category_name'
        ]);
        $id = $request->id;
        $category_name = $request->update_category_name;
        Category::find($id)->update([
            'category_name' => $request->update_category_name
        ]);
        return redirect('category');
    }

    function categoryDelete($category_id){
           if(Category::where('id', $category_id)->exists()){
            Category::where('id', $category_id)->delete();
            Product::where('category_id', $category_id)->delete();
            }
            
        $db_query = Category::select('category_name')->where('id', $category_id)->first();
        return back()->with('category_delete', $db_query);
    }
    function categoryCheckedDelete(Request $request){
        if(isset($request->category_id)){
            foreach($request->category_id as $id){
                Category::where('id', $id)->delete();
            }
        }
        else{
            return back()->with('checked_data_status', 'Please checked again');
        }
        
        return back();
    }
    function categoryRestore($category_id){
        Category::withTrashed()->where('id' , $category_id)->restore();
        Product::withTrashed()->where('category_id', $category_id)->restore();
        return back();
    }
    function categoryForceDelete($category_id){
        Category::withTrashed()->where('id', $category_id)->forceDelete();
        Product::withTrashed()->where('category_id', $category_id)->forceDelete();
        return back();
    }

}
