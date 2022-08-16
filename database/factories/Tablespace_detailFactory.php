<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tablespace_detail;
use Faker\Generator as Faker;

$factory->define(Tablespace_detail::class, function (Faker $faker) {
    return [
        'database_details_id' => $faker->randomDigitNotNull,
        'tablespace_name' => $faker->word,
        'used_space' => $faker->randomDigitNotNull,
        'free_space' => $faker->randomDigitNotNull,
        'total_space' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
