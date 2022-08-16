<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCheckFailCountToInstellicusDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('intellicus_details', function (Blueprint $table) {
            $table->integer('check_fail_count')->after('is_active')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instellicus_details', function (Blueprint $table) {
            $table->dropColumn('check_fail_count');
        });
    }
}
