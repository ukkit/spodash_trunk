<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ml_detail;
use Faker\Generator as Faker;

$factory->define(Ml_detail::class, function (Faker $faker) {

    return [
        'server_details_id' => $faker->randomDigitNotNull,
        'instance_details_id' => $faker->randomDigitNotNull,
        'intellicus_details_id' => $faker->randomDigitNotNull,
        'database_details_id' => $faker->randomDigitNotNull,
        'ml_name' => $faker->word,
        'zeppelin_port' => $faker->randomDigitNotNull,
        'zeppelin_user' => $faker->word,
        'zeppelin_pwd' => $faker->text,
        'installed_path' => $faker->word,
        'notes' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
