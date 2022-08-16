<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaiBuildsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pai_builds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pai_version', 20);
            $table->integer('pai_build');
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
        Schema::dropIfExists('pai_builds');
    }
}
