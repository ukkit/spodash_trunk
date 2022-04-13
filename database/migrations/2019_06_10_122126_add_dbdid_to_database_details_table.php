<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDbdidToDatabaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('database_details', function (Blueprint $table) {
            $table->string('gen_dbd_id')->after('id')->nullable();
        });

        Artisan::call('db:seed', [
            '--class' => 'DatabaseDetailsTableSeeder',
            '--force' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('database_details', function (Blueprint $table) {
            $table->dropColumn('gen_dbd_id');
        });
    }
}
