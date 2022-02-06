<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Agent;
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
            'name' => 'required|unique:agents',
            'phone' => 'required|unique:agents',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $form_data = array(
            'name' => $request->name,
            'phone' => $request->phone,
        ); 
        Agent::create($form_data);
        return response()->json(['success'=> 'New agent registered successfully.']); 
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
