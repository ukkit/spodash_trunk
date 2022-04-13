<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaiDetailsIdToTablespaceDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tablespace_details', function (Blueprint $table) {
            // $table->string('name', 50)->nullable()->change();
            $table->unsignedInteger('database_details_id')->nullable()->change();
            $table->unsignedInteger('pai_details_id')->after('database_details_id')->nullable();

            $table->foreign('pai_details_id')->references('id')->on('pai_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tablespace_details', function (Blueprint $table) {
            $table->dropColumn('pai_details_id');
        });
    }
}
