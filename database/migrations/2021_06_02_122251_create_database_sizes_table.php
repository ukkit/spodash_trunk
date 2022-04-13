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
        Schema::create('db_sizes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('database_details_id');
            $table->dateTime('db_creation_date');
            $table->dateTime('db_access_datetime')->nullable();
            $table->integer('db_size')->nullable(); // this is for MSSQL Database
            $table->integer('db_temp_size')->nullable(); //this is for MSSQL database
            $table->string('tablespace_name', 100)->nullable(); //for Oracle
            $table->integer('tablespace_used')->nullable(); //for Oracle
            $table->integer('tablespace_free')->nullable(); //for Oracle
            $table->string('temp_tablespace_name', 100)->nullable(); //for Oracle
            $table->integer('temp_tablespace_used')->nullable(); //for Oracle
            $table->integer('temp_tablespace_free')->nullable(); //for Oracle
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
