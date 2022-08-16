<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenkinsDetailsToInstanceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instance_details', function (Blueprint $table) {
            $table->string('jenkins_uname')->after('jenkins_url')->nullable();
            $table->string('jenkins_pwd')->after('jenkins_uname')->nullable();
            $table->string('jenkins_token')->after('jenkins_pwd')->nullable();
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
            $table->dropColumn('jenkins_uname');
            $table->dropColumn('jenkins_pwd');
            $table->dropColumn('jenkins_token');
        });
    }
}
