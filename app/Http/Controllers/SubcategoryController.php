<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Carbon\Carbon;
class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function subCategory(){
        $category = Category::all();
        $subcategory= Subcategory::all();
        return view('subcategory.index',compact('category','subcategory'));
    }
    function subCategoryPost(Request $request){
        Subcategory::insert($request->except('_token')+[
            'created_at' => Carbon::now()
        ]);
        return back();
    }
}
