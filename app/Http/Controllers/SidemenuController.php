<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoReply;
use App\Models\Lead;
use App\Models\Group;
use App\Models\Agent;
use App\Models\Unit;
use App\Models\Reservation;
use App\Models\Site;
use App\Models\Schedule;
use App\Models\IncommingMessage;
use App\Models\Customer;
use DB;
use Carbon\Carbon;

class SidemenuController extends Controller
{
    public function sendSMSView(){

        return view('sendSMS');
    }
    public function smsReportView(){
        // $job_batches = DB::table('job_batches')->get();
        // return view('reports',compact('job_batches'));

        $leads = Lead::all();
        return view('reports',compact('leads'));
    }

    public function customers(){
        $allCuscount = Customer::all()->count();
        $acCount = Customer::where('is_active',1)->count();
        $dcCount = Customer::where('is_active',0)->count();
        $newCusCount = Customer::whereDate('created_at',Carbon::today())->count();

        $customers = Customer::where('is_active',1)->paginate(3);
        return view('customers',compact('customers','acCount','dcCount','newCusCount','allCuscount'));
    }
    public function disabledCustomers(){
        $allCuscount = Customer::all()->count();
        $acCount = Customer::where('is_active',1)->count();
        $dcCount = Customer::where('is_active',0)->count();
        $newCusCount = Customer::whereDate('created_at',Carbon::today())->count();

        $disabledCustomers = Customer::where('is_active',0)->paginate(5);
        return view('disabledcustomers',compact('disabledCustomers','dcCount','allCuscount','acCount','newCusCount'));
    }
    public function newCustomers(){
        $allCuscount = Customer::all()->count();
        $acCount = Customer::where('is_active',1)->count();
        $dcCount = Customer::where('is_active',0)->count();
        $newCusCount = Customer::whereDate('created_at',Carbon::today())->count();

        $newCustomers = Customer::whereDate('created_at',Carbon::today())->paginate(5);
        return view('newCustomers',compact('newCustomers','dcCount','allCuscount','acCount','newCusCount'));
    }


    public function targets(){
        // $groups = Group::withCount('customers')->latest()->get();
        // return view('targets',compact('groups'));
        $agents = Agent::withCount('leads')->latest()->get();
        return view('targets',compact('agents'));
    }
    public function incommingSMS(){
        $messages = IncommingMessage::latest()->get();
        return view('incommingSMS',compact('messages'));
    }
    public function autoReplyTable(){
        $rules = AutoReply::latest()->get();
        return view('autoreply',compact('rules'));
    }
    public function SMSschedule(){
        $schedules = Schedule::latest()->get();
        $groups = Group::select('id','name')->get();
        return view('SMSschedule',compact('schedules','groups'));
    }

    public function importCustomerView(){
        // $groups = Group::select('id','name')->get();
        // $batch = DB::table('job_batches')->where('name','=','Importing excel file')->latest()->first();
        // return view('importCustomer',compact('groups','batch'));
        $reservations = Reservation::all();
        return view('importCustomer',compact('reservations'));
    }
    public function payment(){
        // $today = Carbon::now();
        // // $batch = [];
        // $batch = DB::table('job_batches')->where('name','=','Payement processing')->latest()->first();
        // // return $batch;
        // // $day = $today->toDateString();
        // $totalCustomer = Customer::all()->count();
        // $totalPayingCustomer = Customer::where('is_active',1)->whereDate('payingDate',Carbon::today())->count();
        // // $totalPayingCustomer = Customer::where('is_active',1)->where('payingDate','<',$today)->count();
        // return view('payment',compact('totalCustomer','totalPayingCustomer','batch'));
        $units = Unit::all();
        $totalUnits = $units->count();
        return view('payment',compact('units','totalUnits'));
    }

    public function dashboard(){
        // return view('dash');
        $sites = Site::withCount('blocks')->paginate(5);
        $siteCount = Site::all()->count();
        return view('sites',compact('sites','siteCount'));
    }
}
