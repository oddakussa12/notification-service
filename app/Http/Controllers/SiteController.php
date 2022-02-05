<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;
use Validator;

class SiteController extends Controller
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
            'site_name' => 'required',
            'site_code' => 'required|unique:sites',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $site = Site::create([
            'name' => $request->site_name,
            'site_code' => $request->site_code,
        ]);

        return response()->json(['success'=> 'New site created successfully.']); 
    }

    public function show(Site $site)
    {
        //
    }

    public function edit(Site $site)
    {
        //
    }


    public function update(Request $request, Site $site)
    {
        //
    }

    public function destroy(Site $site)
    {
        //
    }
}
