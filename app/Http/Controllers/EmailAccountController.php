<?php

namespace App\Http\Controllers;

use App\Models\EmailAccount;
use Illuminate\Http\Request;

class EmailAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emailAccounts = EmailAccount::orderBy('created_at', 'desc')->get();
        return view('Admin/emailAccounts',compact('emailAccounts'));
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
     * @param  \App\Models\EmailAccount  $emailAccount
     * @return \Illuminate\Http\Response
     */
    public function show(EmailAccount $emailAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmailAccount  $emailAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(EmailAccount $emailAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmailAccount  $emailAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmailAccount $emailAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmailAccount  $emailAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailAccount $emailAccount)
    {
        //
    }
}
