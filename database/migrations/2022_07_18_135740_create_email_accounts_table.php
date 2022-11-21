<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('email_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('ACCOUNT_NAME');
            $table->string('MAIL_MAILER');
            $table->string('MAIL_HOST');
            $table->string('MAIL_PORT');
            $table->string('MAIL_USERNAME');
            $table->string('MAIL_PASSWORD');
            $table->string('MAIL_ENCRYPTION');
            $table->string('MAIL_FROM_ADDRESS');
            $table->string('MAIL_FROM_NAME');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_accounts');
    }
};
