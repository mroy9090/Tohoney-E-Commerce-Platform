<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CheckRole');
    }
    function index(){
        $testimonial_data = Testimonial::all();
        return view('testimonial.index',compact('testimonial_data'));
    }
    function testimonialPost(Request $request){
        $request->validate([
            'customer_name' => 'required | min:2 | max:20 | unique:testimonials,customer_name',
            'customer_details' => 'required',
            'customer_position' => 'required',
            'customer_photo' => 'required | image|mimes:jpg,png'
        ]);
        $temporary_address = $request->file('customer_photo');
        $image_name= Str::random(2).time().".".$request->customer_photo->getClientOriginalExtension();
        Image::make($temporary_address)->resize(135, 105)->save(base_path('public/images/testimonial_image/'. $image_name));

        Testimonial::insert($request->except('_token','customer_photo')+[
            'customer_photo' => $image_name,
            'created_at' =>Carbon::now()
        ]);
        return back()->with('testimonial_status','Information added succesfully');
    }
}
