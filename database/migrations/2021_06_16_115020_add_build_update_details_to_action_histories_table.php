<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBuildUpdateDetailsToActionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('action_histories', function (Blueprint $table) {
            $table->unsignedInteger('old_build_id')->after('status')->nullable();
            $table->unsignedInteger('new_build_id')->after('old_build_id')->nullable();

            $table->foreign('old_build_id')->references('id')->on('product_versions');
            $table->foreign('new_build_id')->references('id')->on('product_versions');
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
            $table->dropColumn('old_build_id');
            $table->dropColumn('new_build_id');
        });
    }
}
