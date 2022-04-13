<?php

use Illuminate\Database\Seeder;

class SPOUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert(array (
            0 =>
            array (
                'id' => 501,
                'name' => 'Avengers User',
                'email' => 'avengers@ptc.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$ugwinSnQu8IUEVjElRYSdeG3pxc3KyD4m66TSTs.2fDhHdjhjU.da',
                'role_id' => 1,
                'last_login_at' => NULL,
                'last_login_ip' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-02-15 17:52:55',
                'updated_at' => '2021-02-15 17:52:55',
            ),
            1 =>
            array (
                'id' => 502,
                'name' => 'Justice League',
                'email' => 'jl@ptc.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$bHSNsIVQNA/q/4TJ2QMWteLn4JYOOLz/mA.B4Td0h/mfiIy8tJ5B2',
                'role_id' => 1,
                'last_login_at' => NULL,
                'last_login_ip' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-02-15 17:53:56',
                'updated_at' => '2021-02-15 17:53:56',
            ),
            2 =>
            array (
                'id' => 503,
                'name' => 'Transformers User',
                'email' => 'transformers@ptc.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$hSlNd6BJ1NLCbkER/Yk7g.xIcoenM/fzSEPUahb./FKhg025H/fwe',
                'role_id' => 1,
                'last_login_at' => NULL,
                'last_login_ip' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-02-15 17:54:25',
                'updated_at' => '2021-02-15 17:54:25',
            ),
            3 =>
            array (
                'id' => 504,
                'name' => 'Seekers User',
                'email' => 'seekers@ptc.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$pjTChH7TGIOGi/YvwLFqkeCaoi9dJBYmpqT1M7bmjMEBYjdDOPF0q',
                'role_id' => 1,
                'last_login_at' => NULL,
                'last_login_ip' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-02-15 17:54:49',
                'updated_at' => '2021-02-15 17:54:49',
            ),
            4 =>
            array (
                'id' => 505,
                'name' => 'Dragons User',
                'email' => 'dragons@ptc.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$8VgT.f2ZZ2po3.z0ZbqISuYlXpIckaDpkJ6goSzaJC1R.slAT.VLO',
                'role_id' => 1,
                'last_login_at' => NULL,
                'last_login_ip' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-02-15 17:55:53',
                'updated_at' => '2021-02-15 17:55:53',
            ),
            5 =>
            array (
                'id' => 506,
                'name' => 'Product Managers',
                'email' => 'pm@ptc.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$2iio3B2fvJZLTjIZG5RP2eyJ5BY2I0udk4XprqI.9JqYOWVYmYPAC',
                'role_id' => 1,
                'last_login_at' => NULL,
                'last_login_ip' => NULL,
                'remember_token' => NULL,
                'created_at' => '2021-02-15 17:56:45',
                'updated_at' => '2021-02-15 17:56:45',
            ),
        ));


        \DB::table('model_has_roles')->insert(array (
            0 =>
            array (
                'role_id' => 8,
                'model_type' => 'App\\User',
                'model_id' => 501,
            ),
            1 =>
            array (
                'role_id' => 8,
                'model_type' => 'App\\User',
                'model_id' => 502,
            ),
            2 =>
            array (
                'role_id' => 8,
                'model_type' => 'App\\User',
                'model_id' => 503,
            ),
            3 =>
            array (
                'role_id' => 8,
                'model_type' => 'App\\User',
                'model_id' => 504,
            ),
            4 =>
            array (
                'role_id' => 8,
                'model_type' => 'App\\User',
                'model_id' => 505,
            ),
            5 =>
            array (
                'role_id' => 8,
                'model_type' => 'App\\User',
                'model_id' => 506,
            ),
        ));

        \DB::table('user_has_teams')->insert(array (
            0 =>
            array (
                'id' => 101,
                'team_id' => 2,
                'user_id' => 506,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 102,
                'team_id' => 7,
                'user_id' => 505,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 103,
                'team_id' => 8,
                'user_id' => 504,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 104,
                'team_id' => 6,
                'user_id' => 503,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' =>105,
                'team_id' => 5,
                'user_id' => 502,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 106,
                'team_id' => 3,
                'user_id' => 501,
                'created_at' => NULL,
                'updated_at' => NULL,
                'deleted_at' => NULL,
            ),
        ));

    }
}
