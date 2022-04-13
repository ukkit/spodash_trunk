<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrlChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_checks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('instance_details_id')->nullable();
            $table->unsignedInteger('intellicus_details_id')->nullable();
            $table->integer('fail_count');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('instance_details_id')->references('id')->on('instance_details');
            $table->foreign('intellicus_details_id')->references('id')->on('intellicus_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url_checks');
    }
}
