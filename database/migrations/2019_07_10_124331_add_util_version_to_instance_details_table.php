<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUtilVersionToInstanceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instance_details', function (Blueprint $table) {
            $table->string('jdk_type')->after('instance_ap_max_heap_size')->nullable();
            $table->string('jdk_version')->after('jdk_type')->nullable();
            $table->string('webserver_version')->after('jdk_version')->nullable();
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
            $table->dropColumn('jdk_type');
            $table->dropColumn('jdk_version');
            $table->dropColumn('webserver_version');
        });
    }
}
