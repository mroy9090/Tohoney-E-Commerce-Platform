<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   function setting(){
       $setting_data = Setting::all();
       return view('setting.index', compact('setting_data'));
   }
   function settingpost(Request $request){
        $request->validate([
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);
        foreach ($request->except('_token') as $key => $value) {
            Setting::where('setting_name' , $key)->update([
                'setting_value' => $value
            ]);
        }
        return back();
   }
}
