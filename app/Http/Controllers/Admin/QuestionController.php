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

    public function singleUnapprovedQuestion(Request $request){
        $question = Question::with('tags','category')->where('id',$request->id)->first();
        return $question;
    }
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
        // $questions = Question::where('is_approved',0)->select('id','created_at','updated_at')
        //             ->selectRaw('SUBSTRING(body, 1, 40) as body')
        //             ->with('tags','category');
        // return Datatables::eloquent($questions)
        // ->addColumn('status', '<span class="badge badge-pill badge-danger">Unapproved</span>')
        // ->addColumn('action', function($question) {
        //     // unapprovedQuestionsAction is a blade file
        //     return view('unapprovedQuestionsAction', compact('question'));
        // })

        // ->editColumn('created_at', function ($request) {
        //     return $request->created_at->format('Y-m-d h:i:s'); // human readable format
        // })
        // ->rawColumns(['status'])
        // ->make(true);


        // OPTION TWO

        $data = Question::where('is_approved',0)->where('is_rejected',0)->select('id','created_at','updated_at')
                ->selectRaw('SUBSTRING(body, 1, 40) as body');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', '<span class="badge badge-pill badge-warning">Unapproved</span>')
                    ->addColumn('action', function($row){
       
                            $btn = '<div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" data-id="'.$row->id.'" class="btn btn-outline-primary view-question">
                              <i class="mdi mdi-eye"></i>
                            </button>
                            <button type="button" data-id="'.$row->id.'"  class="btn btn-outline-success approve">
                              <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                            </button>
                            <button type="button" data-id="'.$row->id.'" class="btn btn-outline-danger decline">
                              <i class="mdi mdi-delete"></i>
                            </button>
                          </div>';

                          return $btn;
                    })
                    ->editColumn('created_at', function ($request) {
                        return $request->created_at->format('Y-m-d h:i:s'); // human readable format
                    })
                    ->rawColumns(['status','category','action'])
                    ->make(true);
    }

    public function approvedQuestions(){
        $data = Question::where('is_approved',1)->where('is_rejected',0)->select('id','created_at','updated_at')
                ->selectRaw('SUBSTRING(body, 1, 40) as body');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', '<span class="badge badge-pill badge-success">Approved</span>')
                    // ->addColumn('action', function($row){
       
                    //         $btn = '<div class="btn-group" role="group" aria-label="Basic example">
                    //         <button type="button" data-id="'.$row->id.'" class="btn btn-outline-primary">
                    //           <i class="mdi mdi-eye"></i>
                    //         </button>
                    //         <button type="button" data-id="'.$row->id.'"  class="btn btn-outline-success approve">
                    //           <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                    //         </button>
                    //         <button type="button" data-id="'.$row->id.'" class="btn btn-outline-danger">
                    //           <i class="mdi mdi-delete"></i>
                    //         </button>
                    //       </div>';

                    //       return $btn;
                    // })
                    ->editColumn('created_at', function ($request) {
                        return $request->created_at->format('Y-m-d h:i:s'); // human readable format
                    })
                    ->rawColumns(['status','category'])
                    ->make(true);
    }

    public function rejectedQuestions(){
        $data = Question::where('is_rejected',1)->where('is_approved',0)->select('id','created_at','updated_at')
                ->selectRaw('SUBSTRING(body, 1, 40) as body');

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', '<span class="badge badge-pill badge-danger">Rejected</span>')
                    ->addColumn('action', function($row){
       
                            $btn = '<div class="btn-group" role="group" aria-label="Basic example">
                            <button type="button" data-id="'.$row->id.'" class="btn btn-outline-primary">
                              <i class="mdi mdi-eye"></i>
                            </button>
                            <button type="button" data-id="'.$row->id.'"  class="btn btn-outline-success approve">
                              <i class="mdi mdi-checkbox-marked-circle-outline"></i>
                            </button>
                            <button type="button" data-id="'.$row->id.'" class="btn btn-outline-danger">
                              <i class="mdi mdi-delete"></i>
                            </button>
                          </div>';

                          return $btn;
                    })
                    ->editColumn('created_at', function ($request) {
                        return $request->created_at->format('Y-m-d h:i:s'); // human readable format
                    })
                    ->rawColumns(['status','category','action'])
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
                'user_id' => auth()->user()->id,
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
