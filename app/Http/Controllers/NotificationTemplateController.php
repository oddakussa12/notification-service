<?php

namespace App\Http\Controllers;

use App\Models\NotificationTemplate;
use App\Models\Emaillanguage;
use Illuminate\Http\Request;
use Validator;

class NotificationTemplateController extends Controller
{
    
    public function index()
    {
        $emailTemplates = NotificationTemplate::orderBy('created_at', 'desc')->with('emailAccount')->get();
        return view('Admin/emailTemplate',compact('emailTemplates'));
    }

    public function store(Request $request)
    {
        $rules = array(
            'template_name'         => 'required',
            'template_id'         => 'required',
            // 'description'         => 'required',
            // 'is_active'   => 'required',
            'data'   => 'required',
            'email_account_id'   => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $email_template = new NotificationTemplate();
        
        $email_template->name = $request->template_name;
        $email_template->templateId = $request->template_id;
        $email_template->description = $request->description;
        $email_template->data = $request->data;
        $email_template->is_active = $request->is_active;
        $email_template->email_account_id = $request->email_account_id;

        $email_template->save();

        $language = new Emaillanguage();

        $language->notification_template_id = $email_template->id;
        $language->code = "EN";
        $language->body = $request->data;
        $language->save();


        if ($email_template->exists) {
            return response()->json(['success' => 'Email template created successfuly'], 200);
        } else {
            return response()->json(['error' => 'Error'], 422);
        }
    }
    
    public function update(Request $request)
    {
        
        $rules = array(
            'template_name'         => 'required',
            'edit_template_id'         => 'required',
            // 'template_description'         => 'required',
            'is_active'   => 'required',
            'template_data'   => 'required',
            'email_account'   => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $email_template = NotificationTemplate::where('id',$request->template_id)->first();
        
        $email_template->name = $request->template_name;
        $email_template->templateId = $request->edit_template_id;
        $email_template->description = $request->template_description;
        $email_template->data = $request->template_data;
        $email_template->is_active = $request->is_active;
        $email_template->email_account_id = $request->email_account;

        $email_template->save();
        

        return response()->json(['success' => 'Updated successfuly'], 200);
    }

    public function destroy(Request $request)
    {
        $email_template = NotificationTemplate::where('id',$request->id)->first();
        if($email_template){
            $email_template->delete();
            return response()->json(['success' => 'Deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful, Email template not found'], 404);
        }
    }
}
