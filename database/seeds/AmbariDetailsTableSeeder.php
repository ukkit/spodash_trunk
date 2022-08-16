<?php

use Illuminate\Database\Seeder;

class AmbariDetailsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('ambari_details')->delete();

        \DB::table('ambari_details')->insert([
            0 => [
                'id' => 1,
                'ambari_name' => 'andcsv-svghdp3d',
                'ambari_url' => 'http://andcsv-svghdp3d.ptcnet.ptc.com:8080/#/main/dashboard/metrics',
                'ambari_user' => 'admin',
                'ambari_pwd' => 'eyJpdiI6ImZ4SUFidU9QQlpMQ3RGU28yOHVST2c9PSIsInZhbHVlIjoiRFgyUXAyT3BibFRQVmZPZzYxYVlzdz09IiwibWFjIjoiNDU4MzEyMWRhOGQzNGUzNTBlNWVjYzgwMWM5ODgyMGMyMWEzY2M4N2YwN2Y0ZmVlZmJlYjU4MTZlNTUwZTVhYiJ9',
                'created_at' => '2020-09-23 07:03:54',
                'updated_at' => '2020-09-23 07:03:54',
                'deleted_at' => null,
            ],
        ]);
    }
}
