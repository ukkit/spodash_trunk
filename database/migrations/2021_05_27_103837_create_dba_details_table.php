<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDbaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dba_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('server_details_id');
            $table->string('dba_user', 100);
            $table->text('dba_password');
            $table->string('db_sid', 100);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('server_details_id')->references('id')->on('server_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dba_details');
    }
}
