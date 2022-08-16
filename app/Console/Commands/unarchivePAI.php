<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class unarchivePAI extends Command
{
    protected $signature = 'command:unarchivePAI';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    private function pvid_to_id($pv_id)
    {
        $sql = DB::table('pai_builds')->select('id')->where('pv_id', $pv_id)->first();
        if (empty($sql)) {
            $sql2 = DB::table('archive_pai_builds')->select('pai_builds_id')->where('pv_id', $pv_id)->first();
            if (empty($sql2)) {
                return null;
            } else {
                return $sql2->pai_builds_id;
            }
        } else {
            $rv = $sql->id;
        }

        return $rv;
    }

    private function db_insert($Asql)
    {
        try {
            DB::table('pai_builds')->insert(['id' => $Asql->pai_builds_id, 'pai_version' => $Asql->pai_version, 'pai_build' => $Asql->pai_build, 'pv_id' => $Asql->pv_id, 'old_pvid' => $Asql->old_pvid, 'is_release_build' => $Asql->is_release_build, 'created_at' => $Asql->created_at]);
            echo $Asql->pai_builds_id." INSERTED \n";
            $doDelete = true;
        } catch (\Throwable $th) {
            throw $th;
            $doDelete = false;
        }

        return $doDelete;
    }

    public function handle()
    {
        $scriptID = 'KjIztaBt4TWJ8b77ie9DhXBFZG9Ga8Y6e0pF1jcVpuDLFxVSe9ZjcLghWxTn2LN2'; //NOT TO BE CHANGED
        $scriptName = 'unarchivePAI'; //NOT TO BE CHANGED

        $pai_build_array = [];
        $pvid_array = [];
        $pai_array = [];
        $pvid_archive = [];
        $pai_id_archive = [];

        $pai_build = DB::table('pai_builds')->get();
        foreach ($pai_build as $key => $value) {
            array_push($pai_build_array, trim($value->id));
        }
        $aspm = DB::table('archive_pai_builds')->get();
        foreach ($aspm as $key => $value) {
            array_push($pvid_archive, trim($value->pv_id));
            array_push($pai_id_archive, trim($value->pai_builds_id));
        }

        $insql = DB::table('instance_details')->get();
        foreach ($insql as $key => $value) {
            if ($value->pai_pv_id) {
                $pai_build_id = $this->pvid_to_id($value->pai_pv_id);
                if (in_array(trim($pai_build_id), $pai_build_array)) {
                } else {
                    array_push($pvid_array, trim($value->pai_pv_id));
                    echo 'PAI_PV_ID: '.$value->pai_pv_id.' Not found '.$value->id."\n";
                }
            }
        }

        if (count($pvid_array) > 0) {
            $pvid_array = array_unique($pvid_array);
            foreach ($pvid_array as $par) {
                if (in_array(trim($par), $pvid_archive)) {
                    $Asql = DB::table('archive_pai_builds')->where('pv_id', $par)->first();
                    if ($Asql) {
                        $doDelete = $this->db_insert($Asql);
                        if ($doDelete) {
                            DB::table('archive_pai_builds')->where('pai_builds_id', $Asql->pai_builds_id)->delete();
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
            if ($value->old_pai_build_id) {
                if (in_array(trim($value->old_pai_build_id), $pai_build_array)) {
                    // echo $value->old_build_id." Found in SPM Build table \n";
                } else {
                    array_push($pai_array, trim($value->old_pai_build_id));
                    echo 'OLD ID: '.$value->old_pai_build_id.' Not found '.$value->id."\n";
                }
            }

            if ($value->new_pai_build_id) {
                if (in_array($value->new_pai_build_id, $pai_build_array)) {
                    // echo "new_build_id Found in SPM Build table \n";
                } else {
                    array_push($pai_array, trim($value->new_pai_build_id));
                    echo 'NEW ID: '.$value->new_pai_build_id.' Not found '.$value->id."\n";
                }
            }
        }

        // echo count($pai_array)."\n";
        // dd($pai_array);
        if (count($pai_array) > 0) {
            $pai_array = array_unique($pai_array);
            echo 'Found '.count($pai_array)." missing SPM build number from action_histories table\n";
            foreach ($pai_array as $par) {
                if (in_array(trim($par), $pai_id_archive)) {
                    $Asql = DB::table('archive_pai_builds')->where('pai_builds_id', $par)->first();
                    if ($Asql) {
                        $doDelete = $this->db_insert($Asql);
                        if ($doDelete) {
                            DB::table('archive_pai_builds')->where('pai_builds_id', $Asql->pai_builds_id)->delete();
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
