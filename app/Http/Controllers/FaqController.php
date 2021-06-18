<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('CheckRole');
    }
    function faq(){
        $faq_data  = Faq::all();
        return view('faq.index' , compact('faq_data'));
    }
    function faqPost(Request $request){
         $request->validate([
            'faq_question' => 'required',
            'faq_answer' => 'required'
        ]);
       Faq::insert($request->except('_token')+[
            'created_at' => Carbon::now()
       ]); 
       return back()->with('faq_status', 'FREQUENTLY ASKED QUESTION ADDED SUCCESFULLY');
    }
    function faqDelete($faq_id){
        if (Faq::where('id', $faq_id)->exists()) {
            Faq::where('id', $faq_id)->delete();
        }
        return back();
    }
}
