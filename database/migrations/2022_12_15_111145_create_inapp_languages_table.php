<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('inapp_languages', function (Blueprint $table) {
            $table->id();
            $table->integer('inapp_notification_id');
            $table->string('code');
            $table->longText('subject');
            $table->longText('body');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inapp_languages');
    }
};
