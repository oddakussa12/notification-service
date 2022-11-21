<?php

namespace App\Http\Controllers;

use App\Models\Smsmessage;
use Illuminate\Http\Request;

class SmsmessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $smsMessages = Smsmessage::orderBy('created_at', 'desc')->with('languages')->get();
        return view('Admin/smsMessages',compact('smsMessages'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Smsmessage  $smsmessage
     * @return \Illuminate\Http\Response
     */
    public function show(Smsmessage $smsmessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Smsmessage  $smsmessage
     * @return \Illuminate\Http\Response
     */
    public function edit(Smsmessage $smsmessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Smsmessage  $smsmessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Smsmessage $smsmessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Smsmessage  $smsmessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Smsmessage $smsmessage)
    {
        //
    }
}
