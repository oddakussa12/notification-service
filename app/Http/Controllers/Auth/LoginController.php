<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {   
        
        $input = $request->all();
   
        $this->validate($request, [
            'phone' => 'required',
            'password' => 'required',
        ]);
   
        if(auth()->attempt(array('phone' => $input['phone'], 'password' => $input['password'])))
        {
            if (auth()->user()->role == "admin") {
                return redirect()->route('home');
            }else{
                return redirect()->route('/login');
            }
        }else{
            // return redirect()->route('login')
            //     ->with('error','Phone And Password Are Wrong.');

            return back()->withErrors([
                'phone' => 'Cedentials do not match our records.',
                'password' => 'Credentials do not match our records.',
            ]);
        }
          
    }

    public function logout(Request $request) {
        auth()->logout();
        return redirect()->route('login');
        
    }
}
