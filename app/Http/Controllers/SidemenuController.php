<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoReply;
use App\Models\Group;
use App\Models\Schedule;

class SidemenuController extends Controller
{
    public function sendSMSView(){
        
        return view('sendSMS');
    }
    public function smsReportView(){
        return view('reports');
    }
    public function importCustomerView(){
        return view('importCustomer');
    }
    public function customers(){
        return view('customers');
    }
    public function targets(){
        $groups = Group::withCount('customers')->latest()->get();
        return view('targets',compact('groups'));
    }
    public function incommingSMS(){
        return view('incommingSMS');
    }
    public function autoReplyTable(){
        $rules = AutoReply::all();
        return view('autoreply',compact('rules'));
    }
    public function SMSschedule(){
        $schedules = Schedule::latest()->get();
        return view('SMSschedule',compact('schedules'));
    }
    public function runningTask(){
        return view('running');
    }
}
