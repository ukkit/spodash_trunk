<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ambari_detail;
use Faker\Generator as Faker;

$factory->define(Ambari_detail::class, function (Faker $faker) {

    return [
        'ambari_name' => $faker->word,
        'ambari_url' => $faker->word,
        'ambari_user' => $faker->word,
        'ambari_pwd' => $faker->text,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s')
    ];
});
