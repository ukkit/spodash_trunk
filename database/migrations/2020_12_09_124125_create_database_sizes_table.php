<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabaseSizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('database_details_id');
            $table->datetime('db_creation_date');
            $table->datetime('db_access_datetime')->nullable();
            $table->integer('db_files_count');
            $table->integer('db_size');
            $table->integer('db_temp_size');
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
        Schema::dropIfExists('database_sizes');
    }
}
