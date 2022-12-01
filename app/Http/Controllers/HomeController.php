<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailAccount;
use App\Models\User;
use App\Models\Smsmessage;
use App\Models\NotificationTemplate;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // return view('home');
        $users = User::all()->count();
        $emailAccounts = EmailAccount::all()->count();
        $smsMessages = Smsmessage::all()->count();
        $notificationTemplate = NotificationTemplate::all()->count();
        return view('dashboard', compact('users','emailAccounts','smsMessages','notificationTemplate'));
    }
}
