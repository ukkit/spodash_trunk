<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMlDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ml_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('server_details_id');
            $table->unsignedInteger('instance_details_id')->nullable();
            $table->unsignedInteger('intellicus_details_id')->nullable();
            $table->unsignedInteger('database_details_id')->nullable(); // To point to pai entry in database_details table
            $table->string('ml_name');
            $table->integer('zeppelin_port');
            $table->string('zeppelin_user');
            $table->text('zeppelin_pwd');
            $table->string('installed_path')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('server_details_id')->references('id')->on('server_details');
            $table->foreign('instance_details_id')->references('id')->on('instance_details');
            $table->foreign('intellicus_details_id')->references('id')->on('intellicus_details');
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
        Schema::dropIfExists('ml_details');
    }
}
