<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDatabaseDetailsIdToIntellicusDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('intellicus_details', function (Blueprint $table) {
            $table->unsignedInteger('database_details_id')->after('intellicus_versions_id')->nullable();

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
        Schema::table('intellicus_details', function (Blueprint $table) {
            $table->dropColumn('database_details_id');
        });
    }
}
