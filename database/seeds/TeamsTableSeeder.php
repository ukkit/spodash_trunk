<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('teams')->delete();

        \DB::table('teams')->insert(array (
            0 =>
            array (
                'id' => 1,
                'team_name' => 'All',
                'team_email' => 'SPO-AllTeams@ptc.com',
                'created_at' => '2020-03-19 18:40:30',
                'updated_at' => '2020-03-19 18:40:30',
                'deleted_at' => NULL,
            ),
            1 =>
            array (
                'id' => 2,
                'team_name' => 'Product Managers',
                'team_email' => 'SVG-POs@ptc.com',
                'created_at' => '2020-03-21 20:07:05',
                'updated_at' => '2020-09-02 18:00:13',
                'deleted_at' => NULL,
            ),
            2 =>
            array (
                'id' => 3,
                'team_name' => 'Avengers',
                'team_email' => 'SPO-Avengers@ptc.com',
                'created_at' => '2020-03-21 20:07:14',
                'updated_at' => '2020-09-02 17:55:16',
                'deleted_at' => NULL,
            ),
            3 =>
            array (
                'id' => 4,
                'team_name' => 'Incredibles',
                'team_email' => 'spo-incredibles@ptc.com',
                'created_at' => '2020-03-21 20:07:26',
                'updated_at' => '2020-09-02 17:55:29',
                'deleted_at' => NULL,
            ),
            4 =>
            array (
                'id' => 5,
                'team_name' => 'Justice League',
                'team_email' => 'SPO-JusticeLeague@ptc.com',
                'created_at' => '2020-03-21 20:07:37',
                'updated_at' => '2020-09-02 17:55:44',
                'deleted_at' => NULL,
            ),
            5 =>
            array (
                'id' => 6,
                'team_name' => 'Transformers',
                'team_email' => 'SPO-Transformers@ptc.com',
                'created_at' => '2020-03-21 20:07:55',
                'updated_at' => '2020-09-02 17:56:02',
                'deleted_at' => NULL,
            ),
            6 =>
            array (
                'id' => 7,
                'team_name' => 'Dragons',
                'team_email' => 'SPO-Dragons@ptc.com',
                'created_at' => '2020-03-21 20:08:34',
                'updated_at' => '2020-09-02 17:56:15',
                'deleted_at' => NULL,
            ),
            7 =>
            array (
                'id' => 8,
                'team_name' => 'Seekers',
                'team_email' => 'SPO-Seekers@ptc.com',
                'created_at' => '2020-03-21 20:08:43',
                'updated_at' => '2020-09-02 17:56:27',
                'deleted_at' => NULL,
            ),
            8 =>
            array (
                'id' => 9,
                'team_name' => 'Guardians',
                'team_email' => 'SPO-Guardians@ptc.com',
                'created_at' => '2020-03-21 20:09:05',
                'updated_at' => '2020-09-02 17:56:42',
                'deleted_at' => NULL,
            ),
        ));


    }
}