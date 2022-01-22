<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoReply;
use App\Models\Group;
use App\Models\Schedule;
use App\Models\IncommingMessage;
use DB;

class SidemenuController extends Controller
{
    public function sendSMSView(){
        
        return view('sendSMS');
    }
    public function smsReportView(){
        $job_batches = DB::table('job_batches')->get();
        return view('reports',compact('job_batches'));
    }
    public function importCustomerView(){
        $groups = Group::select('id','name')->get();
        return view('importCustomer',compact('groups'));
    }
    public function customers(){
        return view('customers');
    }
    public function targets(){
        $groups = Group::withCount('customers')->latest()->get();
        return view('targets',compact('groups'));
    }
    public function incommingSMS(){
        $messages = IncommingMessage::latest()->get();
        return view('incommingSMS',compact('messages'));
    }
    public function autoReplyTable(){
        $rules = AutoReply::all();
        return view('autoreply',compact('rules'));
    }
    public function SMSschedule(){
        $schedules = Schedule::latest()->get();
        $groups = Group::select('id','name')->get();
        return view('SMSschedule',compact('schedules','groups'));
    }
    public function runningTask(){
        return view('running');
    }
}
