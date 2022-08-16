<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenSdIdToServerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('server_details', function (Blueprint $table) {
            $table->string('gen_sd_id')->after('id')->nullable();
        });

        Artisan::call('db:seed', [
            '--class' => 'ServerDetailsTableSeeder',
            '--force' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('server_details', function (Blueprint $table) {
            $table->dropColumn('gen_sd_id');
        });
    }
}
