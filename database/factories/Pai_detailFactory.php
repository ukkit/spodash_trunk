<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Pai_detail;
use Faker\Generator as Faker;

$factory->define(Pai_detail::class, function (Faker $faker) {
    return [
        'name' => $faker->text,
        'server_details_id' => $faker->randomDigitNotNull,
        'ambari_details_id' => $faker->randomDigitNotNull,
        'hive_user' => $faker->word,
        'hive_pwd' => $faker->text,
        'hive_db' => $faker->word,
        'oracle_user' => $faker->word,
        'oracle_pwd' => $faker->text,
        'oracle_sid' => $faker->word,
        'oracle_port' => $faker->randomDigitNotNull,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
