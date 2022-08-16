<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSFBuildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sf_builds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sf_pai_version', 20);
            $table->integer('sf_pai_build');
            $table->string('pv_id', 20)->unique();
            $table->char('is_release_build', 1)->default('N');
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
        Schema::dropIfExists('sf_builds');
    }
}
