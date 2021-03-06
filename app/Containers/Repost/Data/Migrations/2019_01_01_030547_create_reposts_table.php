<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateRepostsTable
 */
class CreateRepostsTable extends Migration
{

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reposts', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('content_id');
            $table->integer('referenced_content_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('reposts');
    }
}
