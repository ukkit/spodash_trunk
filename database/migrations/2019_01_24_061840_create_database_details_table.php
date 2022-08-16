<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatabaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('database_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('server_details_id');
            $table->unsignedInteger('database_types_id');
            $table->string('db_sid');
            $table->string('db_user');
            $table->string('db_pass');
            $table->integer('db_port');
            $table->string('jira_number');
            $table->longText('db_notes')->nullable();
            $table->char('db_is_active', 1)->default('Y');
            $table->char('is_dba', 1)->default('N');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('server_details_id')->references('id')->on('server_details')->onDelete('cascade');
            $table->foreign('database_types_id')->references('id')->on('database_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('database_details');
    }
}
