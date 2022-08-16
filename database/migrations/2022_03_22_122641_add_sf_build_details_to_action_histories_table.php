<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSfBuildDetailsToActionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action_histories', function (Blueprint $table) {
            $table->unsignedInteger('old_sf_build_id')->after('new_pai_build_id')->nullable();
            $table->unsignedInteger('new_sf_build_id')->after('old_sf_build_id')->nullable();

            $table->foreign('old_sf_build_id')->references('id')->on('sf_builds');
            $table->foreign('new_sf_build_id')->references('id')->on('sf_builds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('action_histories', function (Blueprint $table) {
            $table->dropColumn('old_sf_build_id');
            $table->dropColumn('new_sf_build_id');
        });
    }
}
