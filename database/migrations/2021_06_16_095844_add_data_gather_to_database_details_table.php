<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDataGatherToDatabaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('database_details', function (Blueprint $table) {
            $table->char('data_gather_in_progress', 1)->after('repository_type')->default('N');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('database_details', function (Blueprint $table) {
            $table->dropColumn('data_gather_in_progress');
        });
    }
}
