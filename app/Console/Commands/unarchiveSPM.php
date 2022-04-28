<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use Log;

class unarchiveSPM extends Command
{

    protected $signature = 'command:unarchiveSPM';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    private function pvid_to_id($pv_id) {
        $sql = DB::table('product_versions')->select('id')->where('pv_id',$pv_id)->first();
        if(empty($sql)) {
            $sql2 = DB::table('archive_product_versions')->select('product_versions_id')->where('pv_id',$pv_id)->first();
            if (empty($sql2)) {
                return Null;
            } else {
                return $sql2->product_versions_id;
            }
        } else {
            $rv = $sql->id;
        }
        return $rv;
    }

    private function db_insert($Asql) {
        try {
            DB::table('product_versions')->insert(['id' => $Asql->product_versions_id, 'product_ver_number' => $Asql->product_ver_number, 'product_build_numer' => $Asql->product_build_numer, 'pv_id' => $Asql->pv_id, 'old_pvid' => $Asql->old_pvid, 'is_release_build' => $Asql->is_release_build, 'created_at' => $Asql->created_at]);
            echo $Asql->product_versions_id." INSERTED \n";
            $doDelete = True;
        } catch (\Throwable $th) {
            throw $th;
            $doDelete = False;
        }
        return $doDelete;
    }

    public function handle()
    {
        $scriptID = 'kWzz7PB1n8M1z75oblzkD5HnDUgG5r4IjtKtafterZC8lszNcqz171uoN4DK4T0V'; //NOT TO BE CHANGED
        $scriptName = 'unarchiveSPM'; //NOT TO BE CHANGED



        $spm_build_array = array();
        $pvid_array =  array();
        $spm_array = array();
        $pvid_archive = array();
        $spm_id_archive = array();

        $spm_build = DB::table('product_versions')->get();
        foreach ($spm_build as $key => $value) {
            array_push($spm_build_array, trim($value->id));
        }
        $aspm = DB::table('archive_product_versions')->get();
        foreach ($aspm as $key => $value) {
            array_push($pvid_archive, trim($value->pv_id));
            array_push($spm_id_archive, trim($value->product_versions_id));
        }

        $insql = DB::table('instance_details')->get();
        foreach ($insql as $key => $value) {
            if($value->pv_id) {
                $spm_build_id = $this->pvid_to_id($value->pv_id, "SPM");
                if (in_array(trim($spm_build_id), $spm_build_array)) {
                } else {
                    array_push($pvid_array, trim($value->pv_id));
                    echo "PV_ID: ".$value->pv_id." Not found ".$value->id."\n";
                }
            }
        }

        if (count($pvid_array) > 0 ) {
            $pvid_array = array_unique($pvid_array);
            foreach ($pvid_array as $par) {
                if (in_array(trim($par), $pvid_archive)) {
                    $Asql = DB::table('archive_product_versions')->where('pv_id',$par)->first();
                    if ($Asql) {
                        $doDelete = $this->db_insert($Asql);
                        if($doDelete) {
                            DB::table('archive_product_versions')->where('product_versions_id', $Asql->product_versions_id)->delete();
                        }
                    }
                } else {
                    echo "NOT FOUND: ".$par."\n";
                }
            }
        } else {
            echo "No missing SPM build number from instance_details table\n";
        }

        $ahsql = DB::table('action_histories')->get();
        foreach ($ahsql as $key => $value) {
            if($value->old_build_id) {
                if (in_array(trim($value->old_build_id), $spm_build_array)) {
                    // echo $value->old_build_id." Found in SPM Build table \n";
                } else {
                    array_push($spm_array, trim($value->old_build_id));
                    echo "OLD ID: ".$value->old_build_id." Not found ".$value->id."\n";
                }
            }

            if($value->new_build_id) {
                if (in_array($value->new_build_id, $spm_build_array)) {
                    // echo "new_build_id Found in SPM Build table \n";
                } else {
                    array_push($spm_array, trim($value->new_build_id));
                    echo "NEW ID: ".$value->new_build_id." Not found ".$value->id."\n";
                }
            }
        }

        // echo count($spm_array)."\n";
        if (count($spm_array) > 0 ) {
            $spm_array = array_unique($spm_array);
            echo "Found ".count($spm_array)." missing SPM build number from action_histories table\n";
            foreach ($spm_array as $par) {
                if (in_array(trim($par), $spm_id_archive)) {
                    $Asql = DB::table('archive_product_versions')->where('product_versions_id',$par)->first();
                    if ($Asql) {
                        $doDelete = $this->db_insert($Asql);
                        if($doDelete) {
                            DB::table('archive_product_versions')->where('product_versions_id', $Asql->product_versions_id)->delete();
                        }
                    }
                } else {
                    echo "NOT FOUND: ".$par."\n";
                }
            }
        } else {
            echo "No missing SPM build number from action_histories table\n";
        }

        DB::table('command_histories')->insert(['script_id' => $scriptID, 'script_name' => $scriptName, 'created_at'=>Carbon::now()]);

    }
}
