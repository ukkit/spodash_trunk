<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use Log;
class actionHistIssue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ahi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $spm_build_array = array();
        $pai_build_array = array();
        $sql_array = array();
        $spm_array =  array();
        $pai_array = array();

        $spm_build = DB::table('product_versions')->get();
        foreach ($spm_build as $key => $value) {
            array_push($spm_build_array, trim($value->id));
        }

        $pai_build = DB::table('pai_builds')->get();
        foreach ($pai_build as $key => $value) {
            array_push($pai_build_array, trim($value->id));
        }
        // dd($spm_build_array);
        $sql1 = DB::table('action_histories')->get();

        foreach ($sql1 as $key => $value) {
            if($value->old_build_id) {
                if (in_array(trim($value->old_build_id), $spm_build_array)) {
                    // echo " Found in SPM Build table \n";
                } else {
                    array_push($spm_array, trim($value->old_build_id));
                    echo "OLD: ".$value->old_build_id." Not found ".$value->id."\n";
                }
            }

            if($value->new_build_id) {
                if (in_array($value->new_build_id, $spm_build_array)) {
                    // echo "new_build_id Found in SPM Build table \n";
                } else {
                    array_push($spm_array, trim($value->new_build_id));
                    echo "NEW: ".$value->new_build_id." Not found ".$value->id."\n";
                }
            }

            if($value->old_pai_build_id) {
                if (in_array(trim($value->old_pai_build_id), $pai_build_array)) {
                    // echo " Found in SPM Build table \n";
                } else {
                    array_push($pai_array, trim($value->old_pai_build_id));
                    echo "OLD: ".$value->old_pai_build_id." Not found ".$value->id."\n";
                }
            }

            if($value->new_pai_build_id) {
                if (in_array($value->new_pai_build_id, $pai_build_array)) {
                    // echo "new_build_id Found in SPM Build table \n";
                } else {
                    array_push($pai_array, trim($value->new_pai_build_id));
                    echo "NEW: ".$value->new_pai_build_id." Not found ".$value->id."\n";
                }
            }
        }

        echo " SPM Builds \n";
        echo count($spm_array)."\n";
        $spm_array = array_unique($spm_array);
        echo count($spm_array)."\n";

        foreach ($spm_array as $spma) {
            $msql = DB::table('archive_product_versions')->where('product_versions_id', $spma)->get();
            if (count($msql) > 0) {
                $doDelete = False;
                foreach ($msql as $mval) {
                    try {
                        DB::table('product_versions')->insert(['id' => $mval->product_versions_id, 'product_ver_number' => $mval->product_ver_number, 'product_build_numer' => $mval->product_build_numer, 'pv_id' => $mval->pv_id, 'is_release_build' => $mval->is_release_build, 'created_at' => $mval->created_at]);
                        echo $mval->product_versions_id." INSERTED \n";
                        $doDelete = True;
                    } catch (\Throwable $th) {
                        throw $th;
                        $doDelete = False;
                    }
                    if($doDelete) {
                        DB::table('archive_product_versions')->where('product_versions_id', $spma)->delete();
                    }


                }
            } else {
                echo $spma." not found in archive table \n";
            }
        }

        echo " PAI Builds \n";
        echo count($pai_array)."\n";
        $pai_array = array_unique($pai_array);
        echo count($pai_array)."\n";

        foreach ($pai_array as $paia) {
            $msql = DB::table('archive_pai_builds')->where('pai_builds_id', $paia)->get();
            if (count($msql) > 0) {
                $doDelete = False;
                foreach ($msql as $mval) {
                    try {
                        DB::table('pai_builds')->insert(['id' => $mval->pai_builds_id, 'pai_version' => $mval->pai_version, 'pai_build' => $mval->pai_build,'pv_id' => $mval->pv_id, 'is_release_build' => $mval->is_release_build, 'created_at' => $mval->created_at]);

                        echo $mval->pai_builds_id." INSERTED \n";
                        $doDelete = True;
                    } catch (\Throwable $th) {
                        throw $th;
                        $doDelete = False;
                    }

                    if($doDelete) {
                        DB::table('archive_pai_builds')->where('pai_builds_id', $paia)->delete();
                    }

                }
            } else {
                echo $spma." not found in archive table \n";
            }
        }

        // print_r($obi_array);
    }
}
