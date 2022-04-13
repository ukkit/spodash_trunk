<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 8,
                'name' => 'basic',
                'guard_name' => 'web',
                'created_at' => '2019-07-28 22:10:05',
                'updated_at' => '2019-07-28 22:10:05',
            ),
            1 => 
            array (
                'id' => 9,
                'name' => 'advance',
                'guard_name' => 'web',
                'created_at' => '2019-07-28 22:14:38',
                'updated_at' => '2019-07-28 22:14:38',
            ),
            2 => 
            array (
                'id' => 10,
                'name' => 'admin',
                'guard_name' => 'web',
                'created_at' => '2019-07-28 22:17:27',
                'updated_at' => '2019-07-28 22:17:27',
            ),
            3 => 
            array (
                'id' => 11,
                'name' => 'zero',
                'guard_name' => 'web',
                'created_at' => '2019-07-28 22:18:18',
                'updated_at' => '2019-07-28 22:18:18',
            ),
            4 => 
            array (
                'id' => 13,
                'name' => 'superadmin',
                'guard_name' => 'web',
                'created_at' => '2019-07-29 18:06:46',
                'updated_at' => '2019-07-29 18:06:46',
            ),
            5 => 
            array (
                'id' => 14,
                'name' => 'release-manager',
                'guard_name' => 'web',
                'created_at' => '2020-04-25 19:25:45',
                'updated_at' => '2020-04-25 19:25:45',
            ),
        ));
        
        
    }
}