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

        \DB::table('release_numbers')->insert(array (
            0 =>
            array (
                'id' => 3,
                'product_names_id' => 3,
                'release_number' => '12.0.1.3',
                'release_type' => NULL,
                'released_date' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 4,
                'product_names_id' => 3,
                'release_number' => '12.0.1.4',
                'release_type' => NULL,
                'released_date' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 5,
                'product_names_id' => 3,
                'release_number' => '12.1.0.0',
                'release_type' => NULL,
                'released_date' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 6,
                'product_names_id' => 4,
                'release_number' => '2.0',
                'release_type' => NULL,
                'released_date' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));


    }
}