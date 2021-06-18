<?php

namespace App\Http\Controllers;

use App\Mail\Testmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
class FormController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    function formPost(Request $request){
        $name = $request->name;
        $email = $request->email;
        $subject = $request->subject;
        $msg = $request->msg;
        Mail::to('mridulr172@gmail.com')->send(new Testmail($name,$email,$subject,$msg));
        return back();

    }
}
