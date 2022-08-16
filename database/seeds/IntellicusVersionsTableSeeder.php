<?php

use Illuminate\Database\Seeder;

class IntellicusVersionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('intellicus_versions')->delete();

        \DB::table('intellicus_versions')->insert([
            0 => [
                'id' => 1,
                'intellicus_version' => '18.1 SP13',
                'intellicus_patch' => null,
                'release_date' => null,
                'is_active' => 'Y',
                'created_at' => '2020-09-02 12:46:03',
                'updated_at' => '2020-09-02 12:46:03',
                'deleted_at' => null,
            ],
            1 => [
                'id' => 2,
                'intellicus_version' => '19.1 SP3',
                'intellicus_patch' => null,
                'release_date' => null,
                'is_active' => 'Y',
                'created_at' => '2020-09-02 12:46:18',
                'updated_at' => '2020-09-02 12:46:18',
                'deleted_at' => null,
            ],
            2 => [
                'id' => 3,
                'intellicus_version' => '19.1 SP3',
                'intellicus_patch' => 'Patch 1',
                'release_date' => null,
                'is_active' => 'Y',
                'created_at' => '2020-09-02 12:46:41',
                'updated_at' => '2020-09-02 12:46:41',
                'deleted_at' => null,
            ],
            3 => [
                'id' => 4,
                'intellicus_version' => '19.1 SP4',
                'intellicus_patch' => null,
                'release_date' => null,
                'is_active' => 'Y',
                'created_at' => '2020-09-02 12:46:52',
                'updated_at' => '2020-09-02 12:46:52',
                'deleted_at' => null,
            ],
            4 => [
                'id' => 5,
                'intellicus_version' => '19.1 SP7',
                'intellicus_patch' => null,
                'release_date' => null,
                'is_active' => 'Y',
                'created_at' => '2020-09-02 12:47:00',
                'updated_at' => '2020-09-02 12:47:00',
                'deleted_at' => null,
            ],
            5 => [
                'id' => 6,
                'intellicus_version' => '19.1 SP8',
                'intellicus_patch' => null,
                'release_date' => null,
                'is_active' => 'Y',
                'created_at' => '2020-09-02 12:47:08',
                'updated_at' => '2020-09-02 12:47:08',
                'deleted_at' => null,
            ],
        ]);
    }
}
