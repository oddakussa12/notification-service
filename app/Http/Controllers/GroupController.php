<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Validator;

class GroupController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $rules = array(
            'groupName' => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $form_data = array(
            'name' => $request->groupName,
        ); 
        Group::create($form_data);
        return response()->json(['success'=> 'New customer group created successfully.']); 
    }

    public function show(Group $group)
    {
        //
    }


    public function edit(Group $group)
    {
        //
    }


    public function update(Request $request, Group $group)
    {
        //
    }

    public function destroy(Group $group)
    {
        //
    }
}
