<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleaseNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('release_numbers', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->unsignedInteger('product_names_id');
            $table->char('release_number', 12)->unique();
            $table->string('release_type')->nullable();
            $table->date('released_date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_names_id')->references('id')->on('product_names')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('release_numbers');
    }
}
