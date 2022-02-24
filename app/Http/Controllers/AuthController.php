<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function register(Request $request) {

        // return $request;
        $fields = $request->validate([
            'name' => 'required|string',
            // 'email' => 'required|string|unique:users,email',
            'phone' => 'required',
            // 'password' => 'required|string|confirmed'
        ]);

        // check if user already exist
        if (User::where('phone', '=', $fields['phone'])->exists()) {
            $response = [
                'is_existing' => 1,
            ];
    
            return response($response, 201);
         }else{
            $password = mt_rand(100000,999999);
            $user = User::create([
                'name' => $fields['name'],
                'phone' => $fields['phone'],
                // 'password' => bcrypt($fields['password'])
                'password' => bcrypt($password)
            ]);

            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = [
                'user' => $user,
                'token' => $token,
                'verificationCode' => $password,
                'is_existing' => 0,
            ];

            return response($response, 201);
         }
    }

    public function login(Request $request) {
        $fields = $request->validate([
            'phone' => 'required|string',
            'password' => 'required|string'
        ]);

        // dd($request);

        // Check phone
        $user = User::where('phone', $fields['phone'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials used!'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
   
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'You are logged out'
        ];
    }
}
