<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Bus;
use Validator;
use DB;
use Redirect;
use Carbon\Carbon;
use App\Jobs\ImportExcel;
use App\Jobs\ProcessPayment;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    public function getCustomers(){
        $customers = Customer::select('phone')->paginate(8);
        return $customers;
    }
    public function dataSeeder(){
        // $faker = Faker\Factory::create();
        $faker = Faker::create();
        $limit = 10;
        for ($i = 0; $i < $limit; $i++) {
            $customer = new Customer();
            $customer->phone = $faker->phoneNumber;
            $customer->save();
            // echo nl2br ('Name: ' . $faker->name . ', Email Address: ' . $faker->unique()->email . ', Contact No: ' . $faker->phoneNumber . "\n");
        }
        return redirect('/home');
    }
    public function disableCustomer($id){
        $customer = Customer::where('id',$id)->first();
        $customer->is_active = 0;
        $customer->save();
        return redirect('/home');
    }
    public function enableCustomer($id){
        $customer = Customer::where('id',$id)->first();
        $customer->is_active = 1;
        $customer->save();
        return redirect('/home');
    }
    public function createCustomer(Request $request){
        $rules = array(
            'phone' => 'required|min:9|max:9',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
    
        // $customer = Customer::create($request->all());
        $checkCustomer = Customer::where('phone','251'.$request->phone)->first();
        if($checkCustomer == null){
            $customer = new Customer();
            $customer->phone = '251'.$request->phone;
            if($request->group_id){
                $customer->group_id = $request->group_id;
            }
            $today = Carbon::now();
            $customer->payingDate = $today->addDays(3);
            $customer->save();
            if ($customer->exists) {
                return response()->json(['success' => 'Contact created'], 200);
             } else {
                return response()->json(['error' => 'Error'], 422);
            }
        }else{
            $error->errors()->add('field', 'Contact is already registered');
            return response()->json(['errors' => $error->errors()->all()]);
        }
    }

    // import the customer excel file by first chunking to temp files and then to database
    public function importCustomer(Request $request){
        $rules = array(
            'mycsv' => 'required',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
        if($request->has('mycsv')){
            $data = file(request()->mycsv);

            $chunks = array_chunk($data,10);//create a chunk of the data
            $header=[];

            $batch = Bus::batch([])->name('Importing excel file')->dispatch();
            foreach($chunks as $key => $chunk){
                $data = array_map('str_getcsv',$chunk);
                if($key == 0){//only the first chunk file has header
                    $header = $data[0];
                    unset($data[0]);//remove the header of 
                }
                // create a queue in jobs table
                $batch->add(new ImportExcel($data,$header));   
            }
            return response()->json(['success' => 'Task created to import customers file'], 200);
            // return $batch;
            // return view('progress',compact('batch'));
            // return redirect()->action(
            //     [CustomerController::class, 'batchStatus'], ['id' => $batch->id]
            // );
            
        }else{
            return "please choose a file";
        }
    }
    public function batchStatus($id){
        $batchId = request('id');
        return Bus::findBatch($batchId);
        // $batch = Bus::findBatch($id);
        // return view('progress',compact('batch'));
    }


    public function paymentProcessing(){
        // $today = Carbon::now();
        // $totalPayingCustomer = Customer::where('is_active',1)->where('payingDate','<',$today)->get();
        $totalPayingCustomer = Customer::where('is_active',1)->whereDate('payingDate',Carbon::today())->get();
        // create a batch job
        $batchh = Bus::batch([])->name('Payement processing')->dispatch();
        // return $totalPayingCustomer;
        foreach($totalPayingCustomer as $customer){
            $batchh->add(new ProcessPayment($customer->phone));
        }
        $batch = DB::table('job_batches')->where('name','=','Payement processing')->latest()->first();
        
        // return to a view
        $totalCustomer = Customer::all()->count();
        $totalPayingCustomer = Customer::where('is_active',1)->whereDate('payingDate',Carbon::today())->count();
        return view('payment',compact('totalCustomer','batch','totalPayingCustomer'));
    }

    public function syncCustomer(){
        include(app_path().'/sdp/sync.php');
    }

    public function allCustomers(){
        $allCuscount = Customer::all()->count();
        $acCount = Customer::where('is_active',1)->count();
        $dcCount = Customer::where('is_active',0)->count();
        $newCusCount = Customer::whereDate('created_at',Carbon::today())->count();
        return view('allCustomers',compact('allCuscount','acCount','dcCount','newCusCount'));
    }
    public function allCustomerApi(){
        // $query = Customer::select('phone','created_at','updated_at');
        // return datatables($query)->make(true);

        $data = Customer::select('phone','created_at','updated_at');
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

}

