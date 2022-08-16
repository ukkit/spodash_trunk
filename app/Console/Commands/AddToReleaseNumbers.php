<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class AddToReleaseNumbers extends Command
{
    protected $signature = 'command:populateRN';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $pv_records = DB::table('product_versions')
                    ->select('product_ver_number')
                    ->whereNotNull('product_ver_number')
                    ->groupBy('product_ver_number')
                    ->whereNull('deleted_at')
                    ->get()
                    ->toArray();
        $pai_records = DB::table('pai_builds')
                    ->select('pai_version')
                    ->whereNotNull('pai_version')
                    ->groupBy('pai_version')
                    ->whereNull('deleted_at')
                    ->get()
                    ->toArray();
        $rn_records = DB::table('release_numbers')
                    ->select('release_number')
                    ->whereNotNull('release_number')
                    ->groupBy('release_number')
                    ->get()
                    ->toArray();
        // Below 2 lines are used to remove "null" record
        $ars = array_search('null', array_column($pv_records, 'product_ver_number'));
        unset($pv_records[$ars]);

        // Below 2 lines are used to remove "null" record
        $ars2 = array_search('null', array_column($pai_records, 'pai_version'));
        unset($pai_records[$ars2]);

        $arr1 = [];
        $arr2 = [];
        $arr3 = [];
        $arr4 = [];

        foreach ($pv_records as $pvr) {
            array_push($arr1, $pvr->product_ver_number);
        }
        foreach ($rn_records as $rnr) {
            array_push($arr2, $rnr->release_number);
        }
        foreach ($pai_records as $pai) {
            array_push($arr3, $pai->pai_version);
        }

        $array = array_diff($arr1, $arr2);

        // $array = array_diff($pv_records->product_ver_number, $rn_records->release_number);
        $ctr = 0;
        foreach ($array as $ar) {
            $now = Carbon::now();
            DB::table('release_numbers')->insert(
                ['product_names_id' => 3, 'release_number' => $ar, 'created_at' => $now, 'updated_at' => $now]
            );
            $ctr++;
        }
        $rn_records = DB::table('release_numbers')
                    ->select('release_number')
                    ->whereNotNull('release_number')
                    ->groupBy('release_number')
                    ->get()
                    ->toArray();
        foreach ($rn_records as $rnr) {
            array_push($arr4, $rnr->release_number);
        }
        $array2 = array_diff($arr3, $arr4);
        foreach ($array2 as $ar) {
            $now = Carbon::now();
            DB::table('release_numbers')->insert(
                ['product_names_id' => 4, 'release_number' => $ar, 'created_at' => $now, 'updated_at' => $now]
            );
            $ctr++;
        }
        // dd($array);
        echo $ctr.' recrods added to release_numbers table';
    }
}
