<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Addtocart;
use App\Models\Country;
use App\Models\Coupun;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Cartorder;
use App\Models\Order_detail;

class AddtocartController extends Controller
{
    function addcart(Request $request,$product_id){
        $product_id = $product_id;
        $ip_address = $request->ip();
        $quantity = $request->quantity;
        $product_quantity = Product::find($product_id);
        if($quantity>$product_quantity->product_quantity){
            return back()->with('status','we dont enough product');
        }
        if(Addtocart::where('product_id', $product_id)->where('ip_address', $ip_address)->exists()){
            
            Addtocart::where('product_id', $product_id)->where('ip_address', $ip_address)->increment('quantity', $quantity);
        }
        else{
            Addtocart::insert([
                'quantity' => $quantity,
                'product_id' => $product_id,
                'ip_address' => $ip_address,
                'created_at'=> Carbon::now()
            ]);
        }
        return back();
    }
    function cartDelete($cart_id){
        Addtocart::find($cart_id)->delete();
        return back();
    }
    function cart($coupun_name = ""){
        $coupun_discount = 0;
        if($coupun_name == ""){
            $coupun_discount = 0;
        }
        else{
            if(Coupun::where('coupun_name', $coupun_name)->exists()){
                if(Carbon::now()->format('Y-m-d') > Coupun::where('coupun_name', $coupun_name)->first()->expired_date){
                    return back()->with('coupun_error', 'expired');
                }
                else{
                    if(Coupun::where('coupun_name', $coupun_name)->first()->users_limit > 0){
                        $coupun_discount= Coupun::where('coupun_name', $coupun_name)->first()->discount_ammount;
                    }
                    else{
                        return back()->with('coupun_error', 'limit has been overed');
                    }

                }
            }
            else{
                return back()->with('coupun_error', 'invalid coupun');
            }
            
        }
        $cart = Addtocart::where('ip_address' , request()->ip())->get();
        return view('cart.index',compact('cart','coupun_discount', 'coupun_name'));
    }
    function cartUpdate(Request $request){
        foreach($request->quantity as $cart_id => $quantity){
            echo $cart_id .$quantity;
            Addtocart::find($cart_id)->update([
                'quantity' => $quantity
            ]);
        }
        return back();
    }
    function checkOut(){
        $country_list = Country::select('id','name')->get();
        // $country_list = City::select('id','name')->get();
        return view('cart.checkout',compact('country_list'));
    }
    function cityPost(Request $request){
        $city_list="";
        // <option value="">choose one</option>
        foreach (City::where('country_id', $request->country_id)->select('id', 'name')->get() as $key) {
            $city_list = $city_list."<option value='".$key->id."'>$key->name</option>";
        }
        echo $city_list;
    }
    function billingPost(Request $request){
        // print_r($request->all());
        if($request->payment_option == 1){
            return view('cart.onlinepayment');
        }
        else{
            // echo "cash on delivary";
            $request->validate([
                'client_name' => 'required',
                'client_email' => 'required',
                'client_phone' => 'required',
                'client_country_name' => 'required',
                'client_city' => 'required',
                'billing_address' => 'required',
                'billing_post_code' => 'required',
                'massage' => 'required',
                'massage' => 'required',
            ]);
            $order_id = Cartorder::insertGetId($request->except('_token')+[
                'subtotal' => session('session_total'),
                'discount' => session('session_coupun_discount'),
                'total' => session('session_total_in_ammount'),
                'payment_status' => 1,
                'created_at' => Carbon::now()
            ]);
            $cart_information = Addtocart::where('ip_address', request()->ip())->select('id','product_id', 'quantity')->get();
            foreach ($cart_information as $cart) {
                Order_detail::insert([
                    'order_id' => $order_id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'created_at' => Carbon::now()
                ]);
                Product::find($cart->product_id)->decrement('product_quantity', $cart->quantity);
                Addtocart::find($cart->id)->delete();

            }
            return back();
        }
    }
}
