<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateCustomersTable extends Migration
{
    public function payingDate(){
        $today = Carbon::now();
        $payingDate = $today->addDays(3);
        return $payingDate;

        // $date = date('y-m-d h:i:s');
        // $payDate = date('Y-m-d h:i:s', strtotime($date. ' + 3 days'));
        // return $payDate;
    }
    
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id')->nullable();
            $table->string('phone');
            $table->boolean('is_active')->default(true);
            $table->datetime('payingDate')->default($this->payingDate());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
