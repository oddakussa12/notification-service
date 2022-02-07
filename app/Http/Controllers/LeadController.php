<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Validator;

class LeadController extends Controller
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
        //
    }


    public function show(Lead $lead)
    {
        //
    }


    public function edit(Lead $lead)
    {
        //
    }

    public function update(Request $request, Lead $lead)
    {
        $rules = array(
            'lead_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'status' => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $lead = Lead::where('id',$request->lead_id)->first();
        if($lead != null){
            $lead->prospect_name = $request->name;
            $lead->prospect_phone = $request->phone;
            $lead->status = $request->status;
            if($request->status == "Prospecting"){
                $lead->progress = 20;
            }elseif($request->status == "Office invitation"){
                $lead->progress = 40;
            }elseif($request->status =="Site visit"){
                $lead->progress = 60;
            }elseif($request->status == "Reservation"){
                $reservation = new Reservation();
                $reservation->status="Pending";
                $reservation->agent_id = 1;
                $reservation->save();
                $lead->progress = 80;
            }elseif($request->status == "Payment made"){
                $lead->progress = 100;
            }
            $lead->save();
            return response()->json(['success'=> 'Lead updated successfully.']);
        }else{
            return "not okay";
        }
        

        // $lead = Unit::create([
        //     'unit_code' => $request->unit_code,
        //     'bedrooms' => $request->bedrooms,
        //     'direction' => $request->direction,
        //     'floor_id' => $request->floor_id,
        //     'status' => "Available",
        // ]);

        
    }


    public function destroy(Lead $lead)
    {
        //
    }
}
