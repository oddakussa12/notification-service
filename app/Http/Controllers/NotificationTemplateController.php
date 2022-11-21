<?php

namespace App\Http\Controllers;

use App\Models\NotificationTemplate;
use Illuminate\Http\Request;

class NotificationTemplateController extends Controller
{
    
    public function index()
    {
        $emailTemplates = NotificationTemplate::orderBy('created_at', 'desc')->with('emailAccount')->get();
        return view('Admin/emailTemplate',compact('emailTemplates'));
    }

    
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        //
    }

    public function show(NotificationTemplate $notificationTemplate)
    {
        //
    }

    public function edit(NotificationTemplate $notificationTemplate)
    {
        //
    }

   
    public function update(Request $request, NotificationTemplate $notificationTemplate)
    {
        //
    }

    public function destroy(NotificationTemplate $notificationTemplate)
    {
        //
    }
}
