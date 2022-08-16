<?php

namespace App\Console\Commands;

use App\Models\Action_history;
use Artisan;
use DB;
use Illuminate\Console\Command;

class genStats1 extends Command
{
    protected $signature = 'command:stats1';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Artisan::call('command:populateRN');
        Artisan::call('command:actionhistories');

        $action_stats_table = 'system_statistics';

        $dropTable = "DROP TABLE IF EXISTS $action_stats_table";
        $createTable = "CREATE TABLE IF NOT EXISTS $action_stats_table  (
                id int(11) NOT NULL AUTO_INCREMENT,
                action_histories_id INT(11),
                instance_details_id INT(11),
                user_id INT(11),
                product_short_name varchar(12),
                spm_version varchar(15) NULL,
                pai_version varchar(15) NULL,
                action varchar(50),
                start_time timestamp NULL,
                end_time timestamp NULL,
                time_taken time NULL,
                status varchar(50),
                created_at datetime NULL,
                CONSTRAINT pk_action_stats_table_id PRIMARY KEY (id, action_histories_id)
                )";

        \DB::statement($dropTable);
        \DB::statement($createTable);

        $releaseNumbers = DB::table('release_numbers')->get();

        $actionHistories = Action_history::whereNull('deleted_at')->get();
        // echo (Count($actionHistories));
        $pass = 0;
        $fail = 0;
        $restart = 0;
        $startapp = 0;
        $shutdown = 0;
        $spo_upgrades = 0;
        $spm_version = null;
        $pai_version = null;

        function spm_version($instance_details_id)
        {
            $pvid = DB::table('instance_details')->select('id', 'pv_id')->where('id', $instance_details_id)->first();
            $spmv = DB::table('product_versions')->select('product_ver_number')->where('pv_id', $pvid->pv_id)->first();
            $spmv_ar = DB::table('archive_product_versions')->select('product_ver_number')->where('pv_id', $pvid->pv_id)->first();
            if ($spmv) {
                $spm_version = $spmv->product_ver_number;
            } elseif ($spmv_ar) {
                $spm_version = $spmv_ar->product_ver_number;
            } else {
                $spm_version = null;
            }

            return $spm_version;
        }

        function pai_version($instance_details_id)
        {
            $pvid = DB::table('instance_details')->select('pai_pv_id')->where('id', $instance_details_id)->first();
            $paiv = DB::table('pai_builds')->select('pai_version')->where('pv_id', $pvid->pai_pv_id)->first();
            $paiv_ar = DB::table('archive_pai_builds')->select('pai_version')->where('pv_id', $pvid->pai_pv_id)->first();
            if ($paiv) {
                $pai_version = $paiv->pai_version;
            } elseif ($paiv_ar) {
                $pai_version = $paiv_ar->pai_version;
            } else {
                $pai_version = null;
            }

            return $pai_version;
        }

        foreach ($actionHistories as $aH) {
            echo ' Starting '.$aH->id.' ';
            $action_histories_id = $aH->id;
            $instance_details_id = $aH->instance_details_id;
            $user_id = $aH->users_id;
            $action = $aH->action;
            $start_time = $aH->start_time;
            $end_time = $aH->end_time;
            $status = $aH->status;
            $created_at = $aH->created_at;
            if (is_null($created_at)) {
                if (! is_null($start_time)) {
                    $created_at = $start_time;
                } else {
                    $created_at = null;
                }
            }
            $product_names_id = DB::table('instance_details')->where('id', $aH->instance_details_id)->value('product_names_id');
            $product_short_name = DB::table('product_names')->where('id', $product_names_id)->value('product_short_name');
            if ($aH->old_build_id) {
                $spm_version = DB::table('product_versions')->where('id', $aH->old_build_id)->value('product_ver_number');
            } else {
                $spm_version = null;
            }

            if ($aH->old_pai_build_id) {
                $pai_version = DB::table('pai_builds')->where('id', $aH->old_pai_build_id)->value('pai_version');
            } else {
                $pai_version = null;
            }

            if ($action == 'Restart') {
                $restart++;
                if ($product_short_name == 'SPM' || $product_short_name == 'SPP') {
                    $spm_version = spm_version($instance_details_id);
                }
                if ($product_short_name == 'PAI') {
                    $pai_version = pai_version($instance_details_id);
                }
            }

            if ($action == 'StartAppServer') {
                $startapp++;
                if ($spm_version == null && $pai_version == null) {
                    if ($product_short_name == 'SPM' || $product_short_name == 'SPP') {
                        $spm_version = spm_version($instance_details_id);
                    }
                    if ($product_short_name == 'PAI') {
                        $pai_version = pai_version($instance_details_id);
                    }
                }
            }

            if ($action == 'ShutDownAppServer') {
                $shutdown++;
                if ($spm_version == null && $pai_version == null) {
                    if ($product_short_name == 'SPM' || $product_short_name == 'SPP') {
                        $spm_version = spm_version($instance_details_id);
                    }
                    if ($product_short_name == 'PAI') {
                        $pai_version = pai_version($instance_details_id);
                    }
                }
            }

            if ($action == 'SPO_upgrade') {
                $spo_upgrades++;
                if ($spm_version == null && $pai_version == null) {
                    if ($product_short_name == 'SPM' || $product_short_name == 'SPP') {
                        $spm_version = spm_version($instance_details_id);
                    }
                    if ($product_short_name == 'PAI') {
                        $pai_version = pai_version($instance_details_id);
                    }
                }
            }

            try {
                $time_taken = date_diff($end_time, $start_time)->format('%H:%i:%s');
            } catch (\Throwable $th) {
                $time_taken = null;
            }

            // echo $time_taken->format('%H:%i:%s') . " | ";
            try {
                DB::table($action_stats_table)->insert(['id' => null, 'action_histories_id' => $action_histories_id, 'instance_details_id' => $instance_details_id, 'user_id' => $user_id, 'product_short_name' => $product_short_name, 'spm_version' => $spm_version, 'pai_version' => $pai_version, 'action' => $action, 'start_time' => $start_time, 'end_time' => $end_time, 'time_taken' => $time_taken, 'status' => $status, 'created_at' => $created_at]);
                $pass++;
            } catch (\Throwable $th) {
                echo $th;
                $fail++;
            }

            echo ' END |';
        }
        echo 'Restarts: '.$restart.' | StartAppServer: '.$startapp.' | ShutDownAppServer: '.$shutdown.' | Pass: '.$pass.' | Fail: '.$fail;

        if ($fail < $pass) {
            Artisan::call('command:stats2');
            Artisan::call('command:stats3');
            Artisan::call('command:tpStats');
        }
        // echo "Pass: $pass | Fail: $fail";
    }
}
