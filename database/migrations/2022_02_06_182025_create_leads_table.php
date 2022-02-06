<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->integer('progress')->default(0);
            $table->string('status');
            $table->integer('agent_id');
            $table->string('prospect_name')->nullable();
            $table->string('prospect_phone')->nullable();
            $table->boolean('office_invitation')->default(0);
            $table->boolean('site_visit')->default(0);
            $table->boolean('reservation')->default(0);
            $table->integer('unit_id')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
