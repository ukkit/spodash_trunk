<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServerDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed_arr = DB::table('server_details')
                    ->whereNull('gen_sd_id')
                    ->get();

        foreach ($seed_arr as $sar) {

            // $value = DB::table('server_details')->select('server_ip')->where('id', $sar->id)->get()->first();

            $stripped_ip = str_replace('.', '', $sar->server_ip);
            $lower_servername = strtolower($sar->server_name);
            $stripped_servername = str_replace('_', '', $lower_servername);
            $stripped_servername = str_replace('-', '', $stripped_servername);
            $stripped_servername = str_replace('.', '', $stripped_servername);
            $gen_sd_id = $stripped_servername.'_'.$stripped_ip;

            DB::table('server_details')
                ->where('id', $sar->id)
                ->update(['gen_sd_id' => $gen_sd_id]);

            // UPDATE `database_details` SET `dbd_id` = '333333', `deleted_at` = NULL WHERE `database_details`.`id` = 8;
        }
    }
}
