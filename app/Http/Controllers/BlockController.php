<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Site;
use Validator;
use Illuminate\Http\Request;

class BlockController extends Controller
{

    public function index()
    {
        
    }

    public function siteBlocks($id){
        $site = Site::select('id','name')->where('id',$id)->first();
        $blocks = Block::where('site_id',$id)->withCount('floors')->paginate(5);
        $blockCount = Block::where('site_id', $id)->count();
        return view('blocks',compact('blocks','blockCount','site'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $rules = array(
            'site_id' => 'required',
            'direction' => 'required',
            'block_code' => 'required|unique:blocks',
            'description' => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $block = Block::create([
            'location' => $request->direction,
            'site_id' => $request->site_id,
            'block_code' => $request->block_code,
            'description' => $request->description,
        ]);

        return response()->json(['success'=> 'New block created successfully.']); 
    }

    public function show(Block $block)
    {
        //
    }


    public function edit(Block $block)
    {
        //
    }


    public function update(Request $request, Block $block)
    {
        //
    }


    public function destroy(Block $block)
    {
        //
    }
}
