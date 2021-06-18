<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\Slider;
class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CheckRole');
    }
    function slider(){
        $slider_data= Slider::all();
       return view('slider.index', compact('slider_data'));
    }
    function sliderPost(Request $request){
        $request->validate([
            'slider_title' => 'required | min:2 | max:20 | unique:sliders,slider_title',
            'slider_short_description' => 'required ',
            'slider_photo' => 'required | image|mimes:jpg,png'
        ]);
        
        $temporary_photo_address = $request->file('slider_photo');
        $photo_name = Str::random(2).time() . "." . $request->slider_photo->getClientOriginalExtension();
        Image::make($temporary_photo_address)->resize(1903,750)->save(base_path('public/images/slider_image/'). $photo_name);
        Slider::insert($request->except('_token', 'slider_photo') + [
            //if form data post name and database data field name same we can insert this way also
            'slider_photo' => $photo_name,
            'created_at' => Carbon::now()
        ]);
        return back()->with('product_insert_status', 'product inserted successfully');
    
    }
}
