<?php

namespace App\Http\Controllers;

use App\Models\EmailAccount;
use Illuminate\Http\Request;
use Validator;

class EmailAccountController extends Controller
{
   
    public function index()
    {
        $emailAccounts = EmailAccount::orderBy('created_at', 'desc')->get();
        return view('Admin/emailAccounts',compact('emailAccounts'));
    }

    

    public function store(Request $request)
    {
        $rules = array(
            'account_name'         => 'required',
            'mail_mailer'         => 'required',
            'mail_host'         => 'required',
            'mail_port'   => 'required',
            'mail_username'   => 'required',
            'mail_password'   => 'required',
            'mail_encryption'     => 'required',
            'mail_from_address'   => 'required',
            'mail_from_name'     => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $email_account = new EmailAccount();
        
        $email_account->ACCOUNT_NAME = $request->account_name;
        $email_account->MAIL_MAILER = $request->mail_mailer;
        $email_account->MAIL_HOST = $request->mail_host;
        $email_account->MAIL_PORT = $request->mail_port;
        $email_account->MAIL_USERNAME = $request->mail_username;
        $email_account->MAIL_PASSWORD = $request->mail_password;
        $email_account->MAIL_ENCRYPTION = $request->mail_encryption;
        $email_account->MAIL_FROM_ADDRESS = $request->mail_from_address;
        $email_account->MAIL_FROM_NAME = $request->mail_from_name;

        $email_account->save();

        if ($email_account->exists) {
            return response()->json(['success' => 'Email account created successfuly'], 200);
        } else {
            return response()->json(['error' => 'Error'], 422);
        }
    }

    public function show(EmailAccount $emailAccount)
    {
        //
    }


    public function update(Request $request)
    {
        
        // $validator = Validator::make($request->all(), [
        //     'account_name'         => 'required',
        //     'mail_mailer'         => 'required',
        //     'mail_host'         => 'required',
        //     'mail_port'   => 'required',
        //     'mail_username'   => 'required',
        //     'mail_password'   => 'required',
        //     'mail_encryption'     => 'required',
        //     'mail_from_address'   => 'required',
        //     'mail_from_name'     => 'required',
        // ]);
        // if($validator->fails()){
        //     return response()->json(['errors'=>$validator->errors()]);
        // }

        $rules = array(
            'account_name'         => 'required',
            'mail_mailer'         => 'required',
            'mail_host'         => 'required',
            'mail_port'   => 'required',
            'mail_username'   => 'required',
            'mail_password'   => 'required',
            'mail_encryption'     => 'required',
            'mail_from_address'   => 'required',
            'mail_from_name'     => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $email_account = EmailAccount::where('id',$request->account_id)->first();
        
        $email_account->ACCOUNT_NAME = $request->account_name;
        $email_account->MAIL_MAILER = $request->mail_mailer;
        $email_account->MAIL_HOST = $request->mail_host;
        $email_account->MAIL_PORT = $request->mail_port;
        $email_account->MAIL_USERNAME = $request->mail_username;
        $email_account->MAIL_PASSWORD = $request->mail_password;
        $email_account->MAIL_ENCRYPTION = $request->mail_encryption;
        $email_account->MAIL_FROM_ADDRESS = $request->mail_from_address;
        $email_account->MAIL_FROM_NAME = $request->mail_from_name;

        $email_account->save();
       


        return response()->json(['success' => 'Tag updated successfuly'], 200);
        // if ($email_account->exists) {
        //     return response()->json(['success' => 'Updated pdated successfuly'], 200);
        // } else {
        //     return response()->json(['error' => 'Error'], 422);
        // }
    }

    public function destroy(EmailAccount $emailAccount)
    {
        //
    }
}
