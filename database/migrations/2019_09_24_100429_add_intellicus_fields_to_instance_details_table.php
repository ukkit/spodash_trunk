<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIntellicusFieldsToInstanceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('instance_details', function (Blueprint $table) {
            $table->char('is_hadoop_configured', 1)->after('webserver_version')->default('N');
            $table->char('is_contrast_configured', 1)->after('is_hadoop_configured')->default('N');
            $table->char('is_intellicus_configured', 1)->after('is_contrast_configured')->default('N');
            $table->string('intellicus_url')->after('is_intellicus_configured')->nullable();
            $table->string('intellicus_login')->after('intellicus_url')->nullable();
            $table->string('intellicus_passwd')->after('intellicus_login')->nullable();
            $table->string('intellicus_version')->after('intellicus_passwd')->nullable();
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
            $table->dropColumn('is_hadoop_configured');
            $table->dropColumn('is_contrast_configured');
            $table->dropColumn('is_intellicus_configured');
            $table->dropColumn('intellicus_url');
            $table->dropColumn('intellicus_login');
            $table->dropColumn('intellicus_passwd');
            $table->dropColumn('intellicus_version');
        });
    }
}
