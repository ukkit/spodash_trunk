<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailSentDateToUrlChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('url_checks', function (Blueprint $table) {
            $table->date('email_sent_date')->after('fail_count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('url_checks', function (Blueprint $table) {
            $table->dropColumn('email_sent_date');
        });
    }
}
