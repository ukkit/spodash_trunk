<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\System_statistic;
use Faker\Generator as Faker;

$factory->define(System_statistic::class, function (Faker $faker) {

    return [
        'total_instance_details' => $faker->randomDigitNotNull,
        'active_instance_details' => $faker->randomDigitNotNull,
        'deleted_instance_details' => $faker->randomDigitNotNull,
        'auto_upgrade_enabled_instances' => $faker->randomDigitNotNull,
        'total_server_details' => $faker->randomDigitNotNull,
        'active_server_details' => $faker->randomDigitNotNull,
        'deleted_server_details' => $faker->randomDigitNotNull,
        'total_database_details' => $faker->randomDigitNotNull,
        'active_database_details' => $faker->randomDigitNotNull,
        'deleted_database_details' => $faker->randomDigitNotNull,
        'total_intellicus_details' => $faker->randomDigitNotNull,
        'deleted_intellicus_details' => $faker->randomDigitNotNull,
        'total_pai_details' => $faker->randomDigitNotNull,
        'deleted_pai_details' => $faker->randomDigitNotNull,
        'total_product_versions' => $faker->randomDigitNotNull,
        'deleted_product_versions' => $faker->randomDigitNotNull,
        'total_release_builds' => $faker->randomDigitNotNull,
        'total_users' => $faker->randomDigitNotNull,
        'total_teams' => $faker->randomDigitNotNull,
        'deleted_teams' => $faker->randomDigitNotNull,
        'total_action_histories' => $faker->randomDigitNotNull,
        'deleted_action_histories' => $faker->randomDigitNotNull,
        'total_intellicus_versions' => $faker->randomDigitNotNull,
        'deleted_intellicus_versions' => $faker->randomDigitNotNull,
        'avengers_instances' => $faker->randomDigitNotNull,
        'dragons_instances' => $faker->randomDigitNotNull,
        'jl_instances' => $faker->randomDigitNotNull,
        'seekers_instances' => $faker->randomDigitNotNull,
        'guardians_instances' => $faker->randomDigitNotNull,
        'transformers_instances' => $faker->randomDigitNotNull,
        'pm_instances' => $faker->randomDigitNotNull,
        'incredibles_instances' => $faker->randomDigitNotNull,
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
