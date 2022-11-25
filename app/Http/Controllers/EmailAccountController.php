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
    // this is used in edit email template select field
    public function fetchEmailAccount(Request $request){
        
        $data = EmailAccount::select('id','ACCOUNT_NAME')->get();
        if(count($data) > 0){
            return $data;
        }else{
            $output = '<option>No Category Found</option>';
            echo $output;
        }
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

    public function update(Request $request)
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

        return response()->json(['success' => 'Updated successfuly'], 200);
    }

    public function destroy(Request $request)
    {
        $email_account = EmailAccount::where('id',$request->id)->first();
        if($email_account){
            $email_account->delete();
            return response()->json(['success' => 'Deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful, Email account not found'], 404);
        }
    }
}
