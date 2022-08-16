<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPvidToInstanceDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instance_details', function (Blueprint $table) {
            $table->string('pv_id')->after('database_details_id');
            $table->unsignedInteger('product_versions_id')->nullable()->change();
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
            $table->dropColumn('pv_id');
        });
    }
}
