<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUnusedColumnsFromInstanceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instance_details', function (Blueprint $table) {
            $table->dropColumn('pai_type');
            $table->dropColumn('is_hadoop_configured');
            $table->dropColumn('is_intellicus_configured');
            $table->dropColumn('intellicus_url');
            $table->dropColumn('intellicus_login');
            $table->dropColumn('intellicus_passwd');
            $table->dropColumn('intellicus_version');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('instance_details', function (Blueprint $table) {
            //
        });
    }
}
