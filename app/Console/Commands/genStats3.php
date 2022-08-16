<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class genStats3 extends Command
{
    protected $signature = 'command:stats3';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        echo " STARTING ------------------------ STATS3 -------------------------- \n";

        $pass = 0;
        $fail = 0;
        $dropTable = 'DROP TABLE IF EXISTS z_action_data';
        $createTable = 'CREATE TABLE IF NOT EXISTS z_action_data (
            id int(11) NOT NULL AUTO_INCREMENT,
            action_name varchar(50) NOT NULL,

            pass_count int(11) NULL,
            fail_count int(11) NULL,
            scheduler_count int(11) NULL,
            success_time time NULL,
            fail_time time NULL,
            scheduler_time time NULL,
            total_time time NULL,

            created_at datetime NULL,
            CONSTRAINT pk_z_action_data_id PRIMARY KEY (id)
        )';

        \DB::statement($dropTable);
        \DB::statement($createTable);

        // $acData = DB::table('system_statistics')->groupBy('action')->get();
        $acData = DB::table('system_statistics')->select('action')->groupBy('action')->get();

        foreach ($acData as $aD) {
            $pass_count = 0;
            $fail_count = 0;
            $scheduler_count = 0;
            $success_time_array = [];
            $scheduler_time_array = [];
            $fail_time_array = [];
            $total_time_array = [];

            $action = $aD->action;
            $actionData = DB::table('system_statistics')->where('action', $action)->get();
            echo "Action ID: $action - ";

            if (count($actionData) > 0) {
                foreach ($actionData as $sS) {
                    if ($sS->status == 'Successful') {
                        array_push($success_time_array, $sS->time_taken);
                        $pass_count++;
                    } elseif ($sS->status == 'Scheduler') {
                        array_push($scheduler_time_array, $sS->time_taken);
                        $scheduler_count++;
                    } elseif ($sS->status == 'Failed') {
                        array_push($fail_time_array, $sS->time_taken);
                        $fail_count++;
                    } else {
                        // Encountered in-progress
                    }
                }
                echo "$pass_count, $fail_count, $scheduler_count \n";
                // print_r ($fail_time_array);
                // echo $pass_count."-".$fail_count."-".$scheduler_count." | ";
                // echo count($success_time_array) . " - " . count($scheduler_time_array) . " - " . count($fail_time_array) . " - ";

                try {
                    $success_time = add_hrs($success_time_array);
                    $scheduler_time = add_hrs($scheduler_time_array);
                    $fail_time = add_hrs($fail_time_array);
                    $total_time = total_add($success_time, $scheduler_time, $fail_time);
                } catch (\Throwable $th) {
                    throw $th;
                    $success_time = null;
                    $scheduler_time = null;
                    $fail_time = null;
                    $total_time = null;
                }

                try {
                    DB::table('z_action_data')->insert(['id' => null, 'action_name' => $action, 'pass_count' => $pass_count, 'fail_count' => $fail_count, 'scheduler_count' => $scheduler_count, 'success_time' => $success_time, 'fail_time' => $fail_time, 'scheduler_time' => $scheduler_time, 'total_time' => $total_time, 'created_at' => Carbon::now()]);

                    $pass++;
                } catch (\Throwable $th) {
                    throw $th;
                    $fail++;
                }
            }
        }

        echo "\n Passed: ".$pass.' Failed: '.$fail."\n";
        echo " ------------------------ STATS3 -------------------------- ENDS \n";
    }
}
