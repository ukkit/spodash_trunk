<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsPaiRepositoryToDatabaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('database_details', function (Blueprint $table) {
            $table->unsignedInteger('ambari_details_id')->after('database_types_id')->nullable();
            $table->dropColumn('is_intellicus_repository');
            $table->string('repository_type', 50)->after('is_dba')->default('SPO');

            $table->foreign('ambari_details_id')->references('id')->on('ambari_details');
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
            $table->dropColumn('ambari_details_id');
            $table->dropColumn('repository_type');
        });
    }
}
