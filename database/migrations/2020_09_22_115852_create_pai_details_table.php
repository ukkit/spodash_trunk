<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pai_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('server_details_id');
            $table->unsignedInteger('ambari_details_id')->nullable();
            $table->string('pai_type');
            $table->string('pai_user');
            $table->text('pai_pwd');
            $table->string('pai_db');
            $table->integer('pai_port')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('server_details_id')->references('id')->on('server_details');
            $table->foreign('ambari_details_id')->references('id')->on('ambari_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pai_details');
    }
}
