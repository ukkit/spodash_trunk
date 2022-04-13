<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Intellicus_version;
use Faker\Generator as Faker;

$factory->define(Intellicus_version::class, function (Faker $faker) {

    return [
        'intellicus_version' => $faker->text,
        'intellicus_patch' => $faker->text,
        'release_date' => $faker->word,
        'is_active' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
