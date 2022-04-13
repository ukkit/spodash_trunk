<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablespaceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablespace_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('database_details_id');
            $table->string('tablespace_name');
            $table->integer('used_space');
            $table->integer('free_space');
            $table->integer('total_space');
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
        Schema::dropIfExists('tablespace_details');
    }
}
