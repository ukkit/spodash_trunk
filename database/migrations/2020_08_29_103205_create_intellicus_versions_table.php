<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntellicusVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intellicus_versions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('intellicus_version');
            $table->string('intellicus_patch')->nullable();
            $table->date('release_date')->nullable();
            $table->char('is_active',1)->default('Y')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('intellicus_versions');
    }
}
