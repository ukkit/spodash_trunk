<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsActiveToIntellicusDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('intellicus_details', function (Blueprint $table) {
            $table->char('is_active', 1)->after('intellicus_memory')->default('Y');
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
            $table->dropColumn('is_active');
        });
    }
}
