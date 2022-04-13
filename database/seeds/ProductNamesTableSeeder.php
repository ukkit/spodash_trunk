<?php

use Illuminate\Database\Seeder;

class ProductNamesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        // \DB::table('product_names')->delete();

        \DB::table('product_names')->insert(array (
            0 =>
            array (
                'id' => 3,
                'product_short_name' => 'SPO',
                'product_long_name' => 'Service Parts Optimization',
                'product_is_active' => 'Y',
                'created_at' => '2020-04-28 16:11:31',
                'updated_at' => '2020-04-28 16:11:31',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 4,
                'product_short_name' => 'PAI',
                'product_long_name' => 'Performance Analytics and Intelligence',
                'product_is_active' => 'Y',
                'created_at' => '2020-04-28 16:12:05',
                'updated_at' => '2020-04-28 16:12:05',
                'deleted_at' => NULL,
            ),
        ));


    }
}