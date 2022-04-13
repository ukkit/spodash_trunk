<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropPaiDetailsIdFieldAndIndex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('instance_details', function (Blueprint $table) {
            $table->dropForeign('instance_details_pai_details_id_foreign');
            $table->renameColumn('pai_details_id', 'old_pai_details_id');
            $table->integer('to_be_deleted');
         });

         Schema::table('instance_details', function (Blueprint $table) {
            $table->unsignedInteger('pai_details_id')->after('intellicus_details_id')->nullable();
            $table->dropColumn('to_be_deleted');
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
