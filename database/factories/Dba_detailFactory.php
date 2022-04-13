<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Dba_detail;
use Faker\Generator as Faker;

$factory->define(Dba_detail::class, function (Faker $faker) {

    return [
        'server_details_id' => $faker->randomDigitNotNull,
        'dba_user' => $faker->word,
        'dba_password' => $faker->text,
        'db_sid' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
