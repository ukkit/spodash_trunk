<?php

use Illuminate\Database\Seeder;

class ReleaseNumbersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('release_numbers')->delete();

        \DB::table('release_numbers')->insert([
            0 => [
                'id' => 3,
                'product_names_id' => 3,
                'release_number' => '12.0.1.3',
                'release_type' => null,
                'released_date' => null,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            1 => [
                'id' => 4,
                'product_names_id' => 3,
                'release_number' => '12.0.1.4',
                'release_type' => null,
                'released_date' => null,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            2 => [
                'id' => 5,
                'product_names_id' => 3,
                'release_number' => '12.1.0.0',
                'release_type' => null,
                'released_date' => null,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
            3 => [
                'id' => 6,
                'product_names_id' => 4,
                'release_number' => '2.0',
                'release_type' => null,
                'released_date' => null,
                'created_at' => null,
                'updated_at' => null,
                'deleted_at' => null,
            ],
        ]);
    }
}
