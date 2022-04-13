<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstanceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instance_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('server_details_id');
            $table->unsignedInteger('product_names_id');
            $table->unsignedInteger('product_versions_id');
            $table->unsignedInteger('database_details_id');
            $table->string('instance_name');
            $table->integer('instance_tomcat_port');
            $table->integer('instance_ap_port')->nullable();
            $table->integer('instance_web_port')->nullable();
            $table->string('instance_login');
            $table->string('instance_pwd');
            $table->longText('jenkins_url')->nullable();
            $table->char('instance_is_auto_upgraded', 1)->default('Y');
            $table->char('instance_is_active', 1)->default('Y');
            $table->char('instance_show_on_site',1)->default('Y');
            $table->char('show_jenkins_build',1)->default('N');
            $table->char('is_https',1)->nullable()->default('Y');
            $table->string('instance_status')->nullable();
            $table->string('instance_owner')->nullable();
            $table->longText('instance_note')->nullable();
            $table->string('instance_install_path')->nullable();
            $table->string('instance_shared_dir')->nullable();
            $table->string('instance_jira')->nullable();
            $table->integer('instance_web_min_heap_size')->unsigned()->nullable()->default(512);
            $table->integer('instance_web_max_heap_size')->unsigned()->nullable()->default(1024);
            $table->integer('instance_ap_min_heap_size')->unsigned()->nullable()->default(1024);
            $table->integer('instance_ap_max_heap_size')->unsigned()->nullable()->default(4096);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('server_details_id')->references('id')->on('server_details')->onDelete('cascade');
            $table->foreign('product_names_id')->references('id')->on('product_names')->onDelete('cascade');
            $table->foreign('product_versions_id')->references('id')->on('product_versions')->onDelete('cascade');
            $table->foreign('database_details_id')->references('id')->on('database_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instance_details');
    }
}
