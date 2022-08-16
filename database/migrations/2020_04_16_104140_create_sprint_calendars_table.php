<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSprintCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sprint_calendars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sprint_number')->unique();
            $table->date('sprint_start_date');
            $table->date('sprint_end_date');
            $table->char('sprint_end_date_same_as_next_start_date', 1)->default('Y');
            $table->timestamps();
            $table->softDeletes();
        });

        $seeder = new SprintCalendarsTableSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sprint_calendars');
    }
}
