<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reportword;
use Validator;

class ReportwordController extends Controller
{
    public function store(Request $request)
    {
        $rules = array(
            'name' => 'required',
            'name_am' => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        
        $word = Reportword::create($request->all());
        if ($word->exists) {
            return response()->json(['success' => 'Success'], 200);
        } else {
            return response()->json(['error' => 'Error'], 422);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name_am' => 'required',
        ]);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->errors()]);
        }

        $word = Reportword::where('id',$id)->first();
        if($word){
            $word->update($request->all()); 
            return response()->json(['success' => 'Success'], 200);
        }else{
            return response()->json(['error' => 'Update unsuccessful, Item not found'], 404);
        }
    }

    public function destroy(Category $category,$id)
    {
        $word = Reportword::where('id',$id)->first();
        if($word){
            $word->delete();
            return response()->json(['success' => 'Success'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful, Item not found'], 404);
        }
    }
}