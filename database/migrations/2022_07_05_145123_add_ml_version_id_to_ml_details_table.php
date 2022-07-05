<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMlVersionIdToMlDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ml_details', function (Blueprint $table) {
            $table->unsignedInteger('ml_builds_id')->after('database_details_id')->nullable();

            $table->foreign('ml_builds_id')->references('id')->on('ml_builds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ml_details', function (Blueprint $table) {
            $table->dropColumn('ml_builds_id');
        });
    }
}
