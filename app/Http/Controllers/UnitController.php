<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Floor;
use App\Models\Block;
use Illuminate\Http\Request;
use Validator;

class UnitController extends Controller
{

    public function index()
    {
        //
    }

    public function floorUnits($id){
        $floor = Floor::select('id','level','block_id')->where('id',$id)->first();
        $block = Block::where('id',$floor->block_id)->first();
        $units = Unit::where('floor_id',$id)->get();
        $unitCount = $units->count();
        return view('units',compact('units','unitCount','floor','block'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $rules = array(
            'floor_id' => 'required',
            'unit_code' => 'required|unique:units',
            'bedrooms' => 'required',
            'direction' => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $unit = Unit::create([
            'unit_code' => $request->unit_code,
            'bedrooms' => $request->bedrooms,
            'direction' => $request->direction,
            'floor_id' => $request->floor_id,
            'status' => "Available",
        ]);

        return response()->json(['success'=> 'New Unit added successfully.']);
    }


    public function show(Unit $unit)
    {
        //
    }

    public function edit(Unit $unit)
    {
        //
    }


    public function update(Request $request, Unit $unit)
    {
        //
    }

    public function destroy(Unit $unit)
    {
        //
    }
}
