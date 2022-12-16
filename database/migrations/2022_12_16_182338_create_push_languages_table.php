<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
    {
        Schema::create('push_languages', function (Blueprint $table) {
            $table->id();
            $table->integer('push_notification_id');
            $table->string('code');
            $table->longText('subject');
            $table->longText('body');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('push_languages');
    }
};
