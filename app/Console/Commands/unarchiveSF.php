<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class unarchiveSF extends Command
{
    protected $signature = 'command:unarchiveSF';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    private function pvid_to_id($pv_id)
    {
        $sql = DB::table('sf_builds')->select('id')->where('pv_id', $pv_id)->first();
        if (empty($sql)) {
            $sql2 = DB::table('archive_sf_builds')->select('sf_builds_id')->where('pv_id', $pv_id)->first();
            if (empty($sql2)) {
                return null;
            } else {
                return $sql2->sf_builds_id;
            }
        } else {
            $rv = $sql->id;
        }

        return $rv;
    }

    private function db_insert($Asql)
    {
        try {
            DB::table('sf_builds')->insert(['id' => $Asql->sf_builds_id, 'sf_pai_version' => $Asql->sf_pai_version, 'sf_pai_build' => $Asql->sf_pai_build, 'pv_id' => $Asql->pv_id, 'old_pvid' => $Asql->old_pvid, 'is_release_build' => $Asql->is_release_build, 'created_at' => $Asql->created_at]);
            echo $Asql->sf_builds_id." INSERTED \n";
            $doDelete = true;
        } catch (\Throwable $th) {
            throw $th;
            $doDelete = false;
        }

        return $doDelete;
    }

    public function handle()
    {
        $scriptID = 'qzEEMTndrPiyGfjFOswU26e1gwI1JmUOTJCxBueh5VFq9zQxyDMqK5MWv0glVzOJ'; //NOT TO BE CHANGED
        $scriptName = 'unarchiveSF'; //NOT TO BE CHANGED

        $sf_build_array = [];
        $pvid_array = [];
        $sf_array = [];
        $pvid_archive = [];
        $sf_id_archive = [];

        $sf_build = DB::table('sf_builds')->get();
        foreach ($sf_build as $key => $value) {
            array_push($sf_build_array, trim($value->id));
        }
        $aspm = DB::table('archive_sf_builds')->get();
        foreach ($aspm as $key => $value) {
            array_push($pvid_archive, trim($value->pv_id));
            array_push($sf_id_archive, trim($value->sf_builds_id));
        }

        $insql = DB::table('instance_details')->get();
        foreach ($insql as $key => $value) {
            if ($value->sf_pv_id) {
                $sf_build_id = $this->pvid_to_id($value->sf_pv_id);
                if (in_array(trim($sf_build_id), $sf_build_array)) {
                } else {
                    array_push($pvid_array, trim($value->sf_pv_id));
                    echo 'sf_PV_ID: '.$value->sf_pv_id.' Not found '.$value->id."\n";
                }
            }
        }

        if (count($pvid_array) > 0) {
            $pvid_array = array_unique($pvid_array);
            foreach ($pvid_array as $par) {
                if (in_array(trim($par), $pvid_archive)) {
                    $Asql = DB::table('archive_sf_builds')->where('pv_id', $par)->first();
                    if ($Asql) {
                        $doDelete = $this->db_insert($Asql);
                        if ($doDelete) {
                            DB::table('archive_sf_builds')->where('sf_builds_id', $Asql->sf_builds_id)->delete();
                        }
                    }
                } else {
                    echo 'NOT FOUND: '.$par."\n";
                }
            }
        } else {
            echo "No missing PAI build number from instance_details table\n";
        }

        $ahsql = DB::table('action_histories')->get();
        foreach ($ahsql as $key => $value) {
            if ($value->old_sf_build_id) {
                if (in_array(trim($value->old_sf_build_id), $sf_build_array)) {
                    // echo $value->old_build_id." Found in SPM Build table \n";
                } else {
                    array_push($sf_array, trim($value->old_sf_build_id));
                    echo 'OLD ID: '.$value->old_sf_build_id.' Not found '.$value->id."\n";
                }
            }

            if ($value->new_sf_build_id) {
                if (in_array($value->new_sf_build_id, $sf_build_array)) {
                    // echo "new_build_id Found in SPM Build table \n";
                } else {
                    array_push($sf_array, trim($value->new_sf_build_id));
                    echo 'NEW ID: '.$value->new_sf_build_id.' Not found '.$value->id."\n";
                }
            }
        }

        // echo count($sf_array)."\n";
        // dd($sf_array);
        if (count($sf_array) > 0) {
            $sf_array = array_unique($sf_array);
            echo 'Found '.count($sf_array)." missing SPM build number from action_histories table\n";
            foreach ($sf_array as $par) {
                if (in_array(trim($par), $sf_id_archive)) {
                    $Asql = DB::table('archive_sf_builds')->where('sf_builds_id', $par)->first();
                    if ($Asql) {
                        $doDelete = $this->db_insert($Asql);
                        if ($doDelete) {
                            DB::table('archive_sf_builds')->where('sf_builds_id', $Asql->sf_builds_id)->delete();
                        }
                    }
                } else {
                    echo 'NOT FOUND: '.$par."\n";
                }
            }
        } else {
            echo "No missing PAI build number from action_histories table\n";
        }

        DB::table('command_histories')->insert(['script_id' => $scriptID, 'script_name' => $scriptName, 'created_at' => Carbon::now()]);
    }
}
