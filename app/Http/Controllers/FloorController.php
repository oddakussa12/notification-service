<?php

namespace App\Http\Controllers;

use App\Models\Floor;
use App\Models\Block;
use App\Models\Site;
use Validator;
use Illuminate\Http\Request;

class FloorController extends Controller
{

    public function index()
    {
        //
    }

    public function blockFloors($id){
        $block = Block::select('id','block_code','site_id')->where('id',$id)->first();
        $site = Site::where('id',$block->site_id)->first();
        $floors = Floor::where('block_id',$id)->withCount('units')->get();
        $floorCount = $floors->count();
        return view('floors',compact('floors','floorCount','block','site'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $rules = array(
            'floor_level' => 'required',
            'block_id' => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $floor = Floor::create([
            'level' => $request->floor_level,
            'block_id' => $request->block_id,
        ]);

        return response()->json(['success'=> 'New floor added successfully.']); 
    }

    public function show(Floor $floor)
    {
        //
    }

    public function edit(Floor $floor)
    {
        //
    }

    public function update(Request $request, Floor $floor)
    {
        //
    }


    public function destroy(Floor $floor)
    {
        //
    }
}
