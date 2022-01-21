<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Validator;

class ScheduleController extends Controller
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
            'schedule_name' => 'required',
            'schedule_time' => 'required',
            'schedule_message' => 'required',
            'group_ids' => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        // $form_data = array(
        //     'name' => $request->schedule_name,
        //     'message' => $request->schedule_message,
        //     'date_time' => $request->schedule_time,
        // ); 
        // Schedule::create($form_data);

        $schedule = Schedule::create([
            'name' => $request->schedule_name,
            'message' => $request->schedule_message,
            'date_time' => $request->schedule_time,
        ]);

        $groups = $request->group_ids;
        $schedule->groups()->attach($groups);

        return response()->json(['success'=> 'New schedule created successfully.']); 
    }

  
    public function show(Schedule $schedule)
    {
        //
    }

    public function edit(Schedule $schedule)
    {
        //
    }

 
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    public function destroy(Schedule $schedule)
    {
        //
    }
}
