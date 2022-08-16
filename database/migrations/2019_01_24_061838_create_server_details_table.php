<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('os_types_id');
            $table->unsignedInteger('database_types_id');
            $table->unsignedInteger('server_uses_id');
            $table->string('server_name');
            $table->ipAddress('server_ip');
            $table->char('server_class', 10); //VM or PHY or AWS or AZURE
            $table->string('server_location')->nullable();
            $table->integer('server_ram_gb');
            $table->integer('server_hdd_gb');
            $table->integer('server_cpu_cores');
            $table->string('server_user');
            $table->text('server_password'); //changed to text to store encrypted password
            $table->string('admin_user')->nullable();
            $table->text('admin_password')->nullable(); //changed to text to store encrypted password
            $table->char('server_is_active', 1)->default('Y');
            $table->char('server_show_on_site', 1)->default('Y');
            $table->string('server_owner')->nullable();
            $table->longText('server_note')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('os_types_id')->references('id')->on('os_types')->onDelete('cascade');
            $table->foreign('database_types_id')->references('id')->on('database_types')->onDelete('cascade');
            $table->foreign('server_uses_id')->references('id')->on('server_uses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('server_details');
    }
}
