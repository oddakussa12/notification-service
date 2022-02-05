<?php

namespace App\Http\Controllers;

use App\Models\IncommingMessage;
use Illuminate\Http\Request;

class IncommingMessageController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // return $request->p;

        $message = IncommingMessage::create([
            'phone' => $request->p,
            'message' => $request->q,
        ]);

        // $messages = IncommingMessage::latest();
        // return view('incommingSMS',compact('messages'));
    }


    public function show(IncommingMessage $incommingMessage)
    {
        //
    }


    public function edit(IncommingMessage $incommingMessage)
    {
        //
    }

    public function update(Request $request, IncommingMessage $incommingMessage)
    {
        //
    }

    public function destroy(IncommingMessage $incommingMessage)
    {
        //
    }
}
