<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('unique_id')->nullable();
            $table->unsignedInteger('users_id');
            $table->unsignedInteger('instance_details_id');
            $table->integer('jenkins_build_id');
            $table->string('action');
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('instance_details_id')->references('id')->on('instance_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_histories');
    }
}
