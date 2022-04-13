<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOsTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('os_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('os_family');
            $table->string('os_short_name');
            $table->string('os_long_name');
            $table->string('os_patchset')->nullable();
            $table->char('os_is_active',1)->default('Y');
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
        Schema::dropIfExists('os_types');
    }
}
