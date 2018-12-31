<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTransactionsTable extends Migration {

    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('transactions', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('user_id');
            $table->integer('amount');
            $table->integer('points');
            $table->string('gateway');
            $table->string('authority');
            $table->string('payment_url');
            $table->string('ref_id')->nullable();
            $table->string('description')->nullable();

            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() {
        Schema::dropIfExists('transactions');
    }
}
