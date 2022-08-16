<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionCleanupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_cleanups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('action_histories_id');
            $table->unsignedInteger('instance_details_id')->nullable();
            $table->string('action');
            $table->string('original_status');
            $table->char('original_running_jenkins_job', 1);
            $table->datetime('original_created_at');
            $table->datetime('original_updated_at')->nullable();
            $table->longText('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('instance_details_id')->references('id')->on('instance_details');
            $table->foreign('action_histories_id')->references('id')->on('action_histories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_cleanups');
    }
}
