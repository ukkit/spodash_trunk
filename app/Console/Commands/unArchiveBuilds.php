<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use Log;

class unArchiveBuilds extends Command
{
    protected $signature = 'command:unarchiveBuild';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $scriptID = 'tax7i8WhVW47eU4ALprWAiuemcPhkUhdyXQbKbXWCXX6inh82WSCygVtv4wmrpVG'; //NOT TO BE CHANGED

        function pvid_to_id($pv_id, $type) {
            // echo " -->> ".$pv_id;
            if ($type == "SPM") {
                $sql = DB::table('product_versions')->select('id')->where('pv_id',$pv_id)->first();
                if(empty($sql)) {
                    $sql2 = DB::table('archive_product_versions')->select('id')->where('pv_id',$pv_id)->first();
                    $rv = $sql2->id;
                } else {
                    $rv = $sql->id;
                }
            } elseif ($type == "PAI") {
                $sql = DB::table('pai_builds')->select('id')->where('pv_id',$pv_id)->first();
                if(empty($sql)) {
                    $sql2 = DB::table('archive_pai_builds')->select('id')->where('pv_id',$pv_id)->first();
                    $rv = $sql2->id;
                } else {
                    $rv = $sql->id;
                }
            } elseif ($type == "SF") {
                $sql = DB::table('sf_builds')->select('id')->where('pv_id',$pv_id)->first();
                if(empty($sql)) {
                    $sql2 = DB::table('archive_sf_builds')->select('id')->where('pv_id',$pv_id)->first();
                    $rv = $sql2->id;
                } else {
                    $rv = $sql->id;
                }
            }
            // echo $rv."\n";
            return $rv;
        }

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

        $sql2 = DB::table('instance_details')->whereNull('deleted_at')->get();
        foreach ($sql2 as $key => $value) {
            echo $value->id . " -- ";
            if($value->pv_id) {
                $build_id = pvid_to_id($value->pv_id, "SPM");
                if (in_array(trim($build_id), $spm_build_array)) {
                    // echo " Found in SPM Build table \n";
                } else {
                    array_push($spm_array, trim($build_id));
                    echo "OLD PV_ID: ".$build_id." Not found ".$value->id."\n";
                }
            }

            if($value->pai_pv_id) {
                $pai_build_id = pvid_to_id($value->pai_pv_id, "PAI");
                if (in_array(trim($pai_build_id), $pai_build_array)) {
                    // echo " Found in SPM Build table \n";
                } else {
                    array_push($pai_array, trim($pai_build_id));
                    echo "OLD PAI_PV_ID: ".$pai_build_id." Not found ".$value->id."\n";
                }
            }

            if($value->sf_pv_id) {
                $sf_build_id = pvid_to_id($value->sf_pv_id, "SF");
                if (in_array(trim($sf_build_id), $pai_build_array)) {
                    // echo " Found in SPM Build table \n";
                } else {
                    array_push($pai_array, trim($sf_build_id));
                    echo "OLD SF_PV_ID: ".$sf_build_id." Not found ".$value->id."\n";
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
                        DB::table('product_versions')->insert(['id' => $mval->product_versions_id, 'product_ver_number' => $mval->product_ver_number, 'product_build_numer' => $mval->product_build_numer, 'pv_id' => $mval->pv_id, 'old_pvid' => $mval->old_pvid, 'is_release_build' => $mval->is_release_build, 'created_at' => $mval->created_at]);
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
                echo $spma." not found in spm_archive table \n";
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
                        DB::table('pai_builds')->insert(['id' => $mval->pai_builds_id, 'pai_version' => $mval->pai_version, 'pai_build' => $mval->pai_build,'pv_id' => $mval->pv_id, 'old_pvid' => $mval->old_pvid, 'is_release_build' => $mval->is_release_build, 'created_at' => $mval->created_at]);

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
                echo $spma." not found in pai_archive table \n";
            }
        }

        // print_r($obi_array);
    }
}
