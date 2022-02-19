<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;


class ImportExcel implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $header;

    public function __construct($data,$header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    public function handle()
    {   
        foreach($this->data as $customer){
            $user = Customer::where('phone',$customer)->first();
            if($user == null){
                $customers = array_combine($this->header,$customer);
                Customer::create($customers);
            }
        }
    }

    // invoked if a given job has failed
    public function failed(Throwable $exception)
    {
        // Send user notification of failure, etc...
    }
}
