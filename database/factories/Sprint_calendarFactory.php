<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Sprint_calendar;
use Faker\Generator as Faker;

$factory->define(Sprint_calendar::class, function (Faker $faker) {

    return [
        'sprint_number' => $faker->randomDigitNotNull,
        'sprint_start_date' => $faker->word,
        'sprint_end_date_same_as_next_start_date' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
