<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Bruce Wayne',
                'email' => 'batman@ptc.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$CzOH5Bc4Ry85pJ14q.XdB.m1I14Sxl2NwYPYTIs0Cak57e0sqKkAe',
                'remember_token' => 'q1revhwEImuhM3lxp1INYLP10BUyhly4IZ6ThMc2Jh8gjznMcFcj7l2wNK3p',
                'last_login_at' => '2020-01-13 18:58:42',
                'last_login_ip' => '',
                'created_at' => '2019-01-25 21:39:31',
                'updated_at' => '2020-01-18 13:15:00',
            ),
        ));
        
        
    }
}