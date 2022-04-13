<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntellicusDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intellicus_details', function (Blueprint $table) {
            $table->increments('id');
            $table->text('intellicus_name');
            $table->unsignedInteger('server_details_id');
            $table->unsignedInteger('intellicus_versions_id');
            $table->integer('intellicus_port');
            $table->string('intellicus_login');
            $table->text('intellicus_pwd');
            $table->text('intellicus_install_path')->nullable();
            $table->text('intellicus_memory');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('server_details_id')->references('id')->on('server_details');
            $table->foreign('intellicus_versions_id')->references('id')->on('intellicus_versions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intellicus_details');
    }
}
