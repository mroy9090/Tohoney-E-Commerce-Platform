<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faq;
use App\Models\Featured_photo;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\Echo_;
use Illuminate\Support\Facades\Mail;
use App\Mail\BillingStatus;



class AdminController extends Controller
{
    
    function start(){
        $category = Category::all();
        $product = Product::all();
        $testimonial = Testimonial::all();
        $slider = Slider::all();
        return view('index' , compact('category','product', 'testimonial', 'slider'));
    }
    function contact(){
        return view('contact');
    }
    function service()
    {
        return view('service');
    }
    function singleProduct($product_id){
        $category_id = Product::findorfail($product_id)->category_id;
        $category_related_product = Product::where('category_id',$category_id)->where('id','!=',$product_id)->get();
        $product = Product::withTrashed()->find($product_id);
        $category_id = Product::withTrashed()->find($product_id)->category_id;
        $category_name = Category::withTrashed()->find($category_id)->category_name;
        $faq_data  = Faq::all();
        $featured_photos = Featured_photo::all();
        return view('single_product',compact('product', 'category_name', 'faq_data', 'category_related_product', 'featured_photos'));
    }
    function shop(){
        $product = Product::inRandomOrder()->get();
        $category_list = Category::all();
        return view('shop' , compact('product', 'category_list'));
    }
    function singleShop($category_id){
        $category_product = Product::where('category_id',$category_id)->get();
        return view('single_category',compact('category_product'));
    }
    function checkoutPost(Request $request){
        print_r($request->except('_token'));
        $request->validate([
            'name' => 'required | unique:users,name',
            'email' => 'required | unique:users,email'
        ]);
        User::insert([
            'name' =>$request->name,
            'email' =>$request->email,
            'password' =>bcrypt($request->password),
            'role' =>2,
            'created_at' =>Carbon::now()
        ]);
        $message='Thank you FATEMA for openning account in our system';
        Mail::to($request->email)->send(new BillingStatus($message));
        return back();
    }
    function customerLogin(){
        return view('customerLogin.login');
    }
    function customerLoginPost(Request $request){
        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required'
        // ]);
        if(User::where('email', $request->email)->exists()){
            $db_password = User::where('email', $request->email)->first()->password;
            if(Hash::check($request->password, $db_password)){
                if(Auth::attempt($request->except('_token'))){
                    return redirect()->intended('/home');
                }
            }
            else{
                return back()->with('password_error','Invalid password or mail');
            }
        }
        else{
            return back()->with('mail_error','Invalid password or mail');
        }
    }
}
