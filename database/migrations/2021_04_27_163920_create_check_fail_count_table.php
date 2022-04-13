<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCheckFailCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dbcheck_counts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('database_details_id')->unique();
            $table->integer('check_fail_count');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('database_details_id')->references('id')->on('database_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_fail_count');
    }
}
