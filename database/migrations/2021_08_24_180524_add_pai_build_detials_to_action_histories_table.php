<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaiBuildDetialsToActionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE TABLE action_histories_bkup_180524 LIKE action_histories;');
        DB::statement('INSERT action_histories_bkup_180524 SELECT * FROM action_histories');

        Schema::table('action_histories', function (Blueprint $table) {
            $table->unsignedInteger('old_pai_build_id')->after('new_build_id')->nullable();
            $table->unsignedInteger('new_pai_build_id')->after('old_pai_build_id')->nullable();

            $table->foreign('old_pai_build_id')->references('id')->on('pai_builds');
            $table->foreign('new_pai_build_id')->references('id')->on('pai_builds');
        });

        DB::table('action_histories')
            ->where('action', 'BuildUpdate')
            ->update(['action' => 'SPO_upgrade']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_histories');
        DB::statement('CREATE TABLE action_histories LIKE action_histories_bkup_180524;');
        DB::statement('INSERT action_histories SELECT * FROM action_histories_bkup_180524');
        Schema::dropIfExists('action_histories_bkup_180524');

        // Schema::table('action_histories', function (Blueprint $table) {
        //     $table->dropColumn('old_pai_build_id');
        //     $table->dropColumn('new_pai_build_id');
        // });
    }
}
