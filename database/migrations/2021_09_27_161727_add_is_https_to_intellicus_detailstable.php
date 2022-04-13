<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsHttpsToIntellicusDetailstable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('intellicus_details', function (Blueprint $table) {
            $table->char('is_https', 1)->default('N')->after('intellicus_memory');
            $table->string('jdk_type')->after('is_https')->nullable();
            $table->string('jdk_version')->after('jdk_type')->nullable();

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
            $table->dropColumn('is_https');
            $table->dropColumn('jdk_type');
            $table->dropColumn('jdk_version');
        });
    }
}
