<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Intellicus_detail;
use Faker\Generator as Faker;

$factory->define(Intellicus_detail::class, function (Faker $faker) {
    return [
        'server_details_id' => $faker->randomDigitNotNull,
        'intellicus_port' => $faker->randomDigitNotNull,
        'intellicus_login' => $faker->word,
        'intellicus_pwd' => $faker->text,
        'intellicus_install_path' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
