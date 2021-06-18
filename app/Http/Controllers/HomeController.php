<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cartorder;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\Auth;
use PDF;





class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $db_data = User::latest()->get();
        $order_details = Cartorder::where('client_name',Auth::user()->name)->latest()->get();
        $cash_on_delevary = Cartorder::where('payment_option',2)->count();
        $credit_card = Cartorder::where('payment_option',1)->count();
        return view('home' , compact('db_data', 'order_details', 'cash_on_delevary', 'credit_card'));
        
    }
    function invoiceDownload($order_id){
        $data = Cartorder::find($order_id);
        $product_details=Order_detail::where('order_id',$order_id)->get();
        $pdf = PDF::loadView('pdf.invoice', compact('data', 'product_details'));
        return $pdf->stream('invoice.pdf');
    }

}
