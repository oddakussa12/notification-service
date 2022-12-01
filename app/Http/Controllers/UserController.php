<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class UserController extends Controller
{
    public function index(){
        $admins = User::all();
        return view('Admin/adminUsers', compact('admins'));
    }
}
