<?php

namespace App\Http\Controllers;

use App\Models\Coupun;
use Illuminate\Http\Request;

class CoupunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('coupun.index',[
            'coupun' => Coupun::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Coupun::create($request->except('_token'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupun  $coupun
     * @return \Illuminate\Http\Response
     */
    public function show(Coupun $coupun)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupun  $coupun
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupun $coupun)
    {
        return view('coupun.edit',compact('coupun'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupun  $coupun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupun $coupun)
    {
        $coupun->coupun_name=$request->coupun_name;
        $coupun->discount_ammount=$request->discount_ammount;
        $coupun->users_limit=$request->users_limit;
        $coupun->expired_date=$request->expired_date;
        $coupun->save();
        return redirect('coupun');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupun  $coupun
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupun $coupun)
    {
        $coupun->delete();
        return back();
    }
}
