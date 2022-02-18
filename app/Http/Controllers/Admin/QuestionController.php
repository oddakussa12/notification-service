<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;
use Yajra\DataTables\DataTables;
use Validator;

class QuestionController extends Controller
{
    public function approveQuestion(Request $request){
        $question = Question::where('id',$request->id)->first();
        if($question != null){
            $question->is_approved = 1;
            $question->is_rejected = 0;
            $question->save();
            return response()->json(["Message" => "Question approved successfully"],200);
        }else{
            return response()->json(['Error' => "Question not found"]);
        } 
    }
    public function declineQuestion(Request $request){
        $question = Question::where('id',$request->id)->first();
        if($question != null){
            $question->is_rejected = 1;
            $question->is_approved = 0;
            $question->save();
            return response()->json(["Message" => "Question rejected successfully"],200);
        }else{
            return response()->json(['Error' => "Question not found"]);
        } 
    }

    public function unapprovedQuestions(){
        $data = Question::where('is_approved',0)->select('body','created_at','updated_at');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', '<span class="badge badge-pill badge-success">Active</span>')
                    ->addColumn('action', function($row){
       
                        //    $btn = '<a href="javascript:void(0)" class="edit btn btn-info btn-sm">View</a>';
                        //    $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                        //    $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>';
         
                        //     return $btn;

                            $btn = '              <div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-outline-secondary">
                              <i class="mdi mdi-send"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary">
                              <i class="mdi mdi-lead-pencil"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary">
                              <i class="mdi mdi-delete"></i>
                            </button>
                          </div>';

                          return $btn;
                    })
                    ->editColumn('created_at', function ($request) {
                        return $request->created_at->format('Y-m-d h:i:s'); // human readable format
                    })
                    ->editColumn('updated_at', function ($request) {
                        return $request->updated_at->format('Y-m-d h:i:s'); // human readable format
                    })
                    ->rawColumns(['status','action'])
                    ->make(true);
    }
    public function store(Request $request)
    {

        $rules = array(
            'body' => 'required',
            'category_id' => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

    
        $category = Category::where('id',$request->category_id)->first();
        if($category != null){
            $question = Question::create([
                'body' => $request->body,
                'category_id' => $request->category_id,
                // 'user_id' => auth()->user()->id,
                'user_id' => 1,
                'is_approved' => 1,
            ]);
            if ($question->exists) {
                if($request->tag_ids){
                    $question->tags()->sync($request->tag_ids);
                }
                return response()->json(['success' => 'Question created successfuly'], 200);
             } else {
                return response()->json(['error' => 'Error'], 422);
             }
        }else{
            return response()->json(['Error'=>"Category not found"]);
        }
    }
    
}
