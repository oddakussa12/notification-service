<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Yajra\DataTables\DataTables;
use Validator;

class BlogController extends Controller
{
    public function blogs(){
        $data = Blog::select('created_at')
        ->selectRaw('SUBSTRING(title, 1, 25) as title_part')
        ->selectRaw('SUBSTRING(description, 1, 35) as description_part');
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
   
                    //    $btn = '<a href="javascript:void(0)" class="edit btn btn-info btn-sm">View</a>';
                    //    $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                    //    $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">Delete</a>';
     
                    //     return $btn;

                        $btn = '              <div class="btn-group" role="group" aria-label="Basic example">
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
                ->rawColumns(['action'])
                ->make(true);

    }


    public function store(Request $request)
    {
        $rules = array(
            'title'         => 'required',
            // 'title_am'         => 'required',
            // 'description_am'         => 'required',
            'description'   => 'required',
            'category_id'   => 'required',
            'reading_time'   => 'required',
            'file'     => 'mimes:jpeg,jpg,png,gif|required|max:10000', //kb
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $image = $request->file('file');

        $name = rand().'.'.$image->getClientOriginalName();
        $image->move(public_path('/blogImages'),$name);
        // $image->storeAs('public/',$name);
        $blog = new Blog();
        
        $blog->title = $request->title;
        $blog->reading_time = $request->reading_time;
        $blog->description = $request->description;
        $blog->file = $name;
        $blog->blogcategory_id = $request->category_id;

        if($request->title_am){
            $blog->title_am = $request->title_am;
        }
        if($request->description_am){
            $blog->description_am = $request->description_am;
        }
        $blog->save();

        if ($blog->exists) {
            if($request->tag_ids){
                $blog->tags()->sync($request->tag_ids);
            }
            return response()->json(['success' => 'Blog created successfuly'], 200);
        } else {
            return response()->json(['error' => 'Error'], 422);
        }
    }

    public function update(Request $request, $id)
    {
        return $request;
        $image = $request->file('file');
        if($request->hasFile('file')){
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'category_id' => 'required',
                'reading_time' => 'required',
                'file'     => 'mimes:jpeg,jpg,png,gif|required|max:10000', //kb
            ]);
            if($validator->fails()){
                return response()->json(['errors'=>$validator->errors()]);
            }

            $name = rand().'.'.$image->getClientOriginalName();
            $image->move(public_path('/blogImages'),$name);
            
            $blog = Blog::where('id',$id)->first();
            
            $blog->title = $request->title;
            $blog->file = $name;
            $blog->description = $request->description;
            $blog->blogcategory_id = $request->category_id;
            $blog->reading_time = $request->reading_time;
            if($request->title_am){
                $blog->title_am = $request->title_am;
            }
            if($request->description_am){
                $blog->description_am = $request->description_am;
            }
            if($request->tag_ids){
                $blog->tags()->attach($request->tag_ids);
            }

            $blog->save();

            if ($blog->exists) {
                return response()->json(['success' => 'Blog updated successfuly'], 200);
            } else {
                return response()->json(['error' => 'Error'], 422);
            }
            
        }else{
            return response()->json('Please choose image file');
        }
    }


    public function destroy(Blog $blog, $id)
    {
        $blog = Blog::where('id',$id)->first();
        if($blog){
            $blog->delete();
            return response()->json(['success' => 'Blog deleted successfuly'], 200);
        }else{
            return response()->json(['error' => 'Delete unsuccessful, Blog not found'], 404);
        }
    }

}
