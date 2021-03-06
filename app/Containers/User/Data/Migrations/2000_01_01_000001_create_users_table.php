<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('nick_name')->nullable();
            $table->text('description')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('one_time_password')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('gender')->nullable();
            $table->date('birth')->nullable();
            $table->unsignedBigInteger('points')->default(0);
            $table->boolean('is_client')->default(false);
            $table->boolean('is_phone_confirmed')->default(false);
            $table->boolean('is_email_confirmed')->default(false);
            $table->boolean('is_subscription_expired')->default(true);
            $table->timestamp('password_updated_at')->nullable();
            $table->timestamp('one_time_password_updated_at')->nullable();
            $table->timestamp('subscription_expired_at')->default(Carbon::now());

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::drop('users');
    }
}
