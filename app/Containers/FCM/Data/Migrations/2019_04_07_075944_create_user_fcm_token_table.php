<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserFcmTokenTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_fcm_token', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('user_access_token');
            $table->string('android_fcm_token', 512)->nullable();
            $table->string('apns_id', 512)->nullable();
            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('user_fcm_token');
    }
}
