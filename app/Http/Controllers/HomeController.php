<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailAccount;
use App\Models\User;
use App\Models\Smsmessage;
use App\Models\NotificationTemplate;
use App\Models\NotificationCount;
use Carbon\Carbon;

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

        $counter = NotificationCount::whereDate('created_at', Carbon::today())->first();
        $counterMonth = NotificationCount::whereDate('created_at','>', now()->subDays(30)->endOfDay())->get();

        if($counter != null){
            $todayEmailCount = $counter->email_count;
            $todaySMSCount = $counter->sms_count;
        }else{
            $todayEmailCount = 0;
            $todaySMSCount = 0;
        }

        if(!$counterMonth->isEmpty()){
            $monthSMSCount = 0;
            $monthEmailCount = 0;
            foreach($counterMonth as $countMonth){
                $monthEmailCount = $countMonth->email_count + $monthEmailCount;
                $monthSMSCount = $countMonth->sms_count + $monthSMSCount;
            }
        }else{
            $monthEmailCount = 0;
            $monthSMSCount = 0;
        }

        
        return view('dashboard', compact(
            'users',
            'emailAccounts',
            'smsMessages',
            'notificationTemplate',
            'todayEmailCount',
            'todaySMSCount',
            'monthEmailCount',
            'monthSMSCount'
        ));
    }
}
