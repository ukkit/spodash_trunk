<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed_arr = DB::table('database_details')
                    ->whereNull('gen_dbd_id')
                    ->get();

        foreach ($seed_arr as $sar) {
            $value = DB::table('server_details')->select('server_ip')->where('id', $sar->server_details_id)->get()->first();
            $stripped_ip = str_replace('.', '', $value->server_ip);

            $lower_dbsid = strtolower($sar->db_sid);
            $stripped_dbsid = str_replace('_', '', $lower_dbsid);
            $stripped_dbsid = str_replace('-', '', $stripped_dbsid);

            $lower_dbuser = strtolower($sar->db_user);
            $stripped_dbuser = str_replace('_', '', $lower_dbuser);
            $stripped_dbuser = str_replace('-', '', $stripped_dbuser);

            $dbd_id = $stripped_ip.'_'.$stripped_dbsid.'_'.$stripped_dbuser;

            DB::table('database_details')
                ->where('id', $sar->id)
                ->update(['gen_dbd_id' => $dbd_id]);

            // UPDATE `database_details` SET `dbd_id` = '333333', `deleted_at` = NULL WHERE `database_details`.`id` = 8;
        }
    }
}
