<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Release_milestone;
use Faker\Generator as Faker;

$factory->define(Release_milestone::class, function (Faker $faker) {
    return [
        'release_numbers_id' => $faker->randomDigitNotNull,
        'release_start_date' => $faker->word,
        'release_end_date' => $faker->word,
        'baseline_start_date' => $faker->word,
        'baseline_end_date' => $faker->word,
        'number_of_sprints' => $faker->word,
        'content_complete_start_date' => $faker->word,
        'content_complete_end_date' => $faker->word,
        'regressions_start_date' => $faker->word,
        'regressions_end_date' => $faker->word,
        'enablement_delivery' => $faker->word,
        'enablement_delivery_start_date' => $faker->word,
        'enablement_delivery_end_date' => $faker->word,
        'localization_review' => $faker->word,
        'localization_start_date' => $faker->word,
        'localization_end_date' => $faker->word,
        'run_security_scan' => $faker->word,
        'security_scan_start_date' => $faker->word,
        'security_scan_end_date' => $faker->word,
        'release_branch_creation_date' => $faker->word,
        'documentation_start_date' => $faker->word,
        'documentation_end_date' => $faker->word,
        'code_freeze_date' => $faker->word,
        'release_candidate_date' => $faker->word,
        'final_qa_date' => $faker->word,
        'release_build_date' => $faker->word,
        'has_pre_release' => $faker->word,
        'pre_release_1_date' => $faker->word,
        'has_pre_release_2' => $faker->word,
        'pre_release_2_date' => $faker->word,
        'has_pre_release_3' => $faker->word,
        'pre_release_3_date' => $faker->word,
        'has_pre_release_4' => $faker->word,
        'pre_release_4_date' => $faker->word,
        'released_date' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s'),
        'deleted_at' => $faker->date('Y-m-d H:i:s'),
    ];
});
