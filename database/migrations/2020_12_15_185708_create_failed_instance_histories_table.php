<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedInstanceHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('failed_instance_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('instance_details_id');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('failed_instance_histories');
    }
}
