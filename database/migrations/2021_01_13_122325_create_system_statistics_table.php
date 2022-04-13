<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_statistics', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total_instance_details');
            $table->integer('active_instance_details');
            $table->integer('deleted_instance_details');
            $table->integer('auto_upgrade_enabled_instances');

            $table->integer('total_server_details');
            $table->integer('active_server_details');
            $table->integer('deleted_server_details');
            $table->integer('total_database_details');
            $table->integer('active_database_details');
            $table->integer('deleted_database_details');
            $table->integer('total_intellicus_details');
            $table->integer('deleted_intellicus_details');
            $table->integer('total_pai_details');
            $table->integer('deleted_pai_details');
            $table->integer('total_product_versions');
            $table->integer('deleted_product_versions');
            $table->integer('total_release_builds');
            $table->integer('total_users');
            $table->integer('total_teams');
            $table->integer('deleted_teams');
            $table->integer('total_action_histories');
            $table->integer('deleted_action_histories');
            $table->integer('total_intellicus_versions');
            $table->integer('deleted_intellicus_versions');

            $table->integer('avengers_instances');
            $table->integer('dragons_instances');
            $table->integer('jl_instances');
            $table->integer('seekers_instances');
            $table->integer('guardians_instances');
            $table->integer('transformers_instances');
            $table->integer('pm_instances');
            $table->integer('incredibles_instances');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('system_statistics');
    }
}
