<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('targets');
    }
}
