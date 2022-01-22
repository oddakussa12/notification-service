<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Bus;
use Validator;
use DB;
use Redirect;
use App\Jobs\ImportExcel;
use Illuminate\Support\Facades\Http;

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
        // return Customer::create($request->all());
        $rules = array(
            'phone' => 'required|min:10',
        );
        $error = Validator::make($request->all(),$rules);
        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }
    
        $customer = Customer::create($request->all());
        if ($customer->exists) {
            return response()->json(['success' => 'Contact created'], 200);
         } else {
            return response()->json(['error' => 'Error'], 422);
         }
        // return redirect('/home');
    }

    // import the customer excel file by first chunking to temp files and then to database
    public function importCustomer(Request $request){
        // return $request->all();
        if($request->has('mycsv')){
            $data = file(request()->mycsv);

            $chunks = array_chunk($data,10);//create a chunk of the data
            $header=[];

            $batch = Bus::batch([])->name('Import Excel file')->dispatch();
            foreach($chunks as $key => $chunk){
                $data = array_map('str_getcsv',$chunk);
                if($key == 0){//only the first chunk file has header
                    $header = $data[0];
                    unset($data[0]);//remove the header of 
                }
                // create a queue in jobs table
                $batch->add(new ImportExcel($data,$header));   
            }
            // return $batch;
            return view('progress',compact('batch'));
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
}

