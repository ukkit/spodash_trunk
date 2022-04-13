<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;

class genStats2 extends Command
{

    protected $signature = 'command:stats2';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();

    }

    public function initiate()
    {

    }

    public function handle()
    {
        echo " STARTING ------------------------ STATS2 -------------------------- \n";

        $pass = 0;
        $fail = 0;
        $dropTable = "DROP TABLE IF EXISTS z_release_data";
        $createTable = "CREATE TABLE IF NOT EXISTS z_release_data (
            id int(11) NOT NULL AUTO_INCREMENT,
            spm_version varchar(10) NULL,
            pai_version varchar(10) NULL,

            spm_upgrade_pass_count int(11) NULL,
            pai_upgrade_pass_count int(11) NULL,
            both_upgrade_pass_count int(11) NULL,
            startup_pass_count int(11) NULL,
            shutdown_pass_count int(11) NULL,
            restart_pass_count int(11) NULL,

            spm_upgrade_fail_count int(11) NULL,
            pai_upgrade_fail_count int(11) NULL,
            both_upgrade_fail_count int(11) NULL,
            startup_fail_count int(11) NULL,
            shutdown_fail_count int(11) NULL,
            restart_fail_count int(11) NULL,

            spm_upgrade_max_time time NULL,
            pai_upgrade_max_time time NULL,
            both_upgrade_max_time time NULL,
            startup_max_time time NULL,
            shutdown_max_time time NULL,
            restart_max_time time NULL,

            spm_upgrade_min_time time NULL,
            pai_upgrade_min_time time NULL,
            both_upgrade_min_time time NULL,
            startup_min_time time NULL,
            shutdown_min_time time NULL,
            restart_min_time time NULL,

            spm_upgrade_avg_time time NULL,
            pai_upgrade_avg_time time NULL,
            both_upgrade_avg_time time NULL,
            startup_avg_time time NULL,
            shutdown_avg_time time NULL,
            restart_avg_time time NULL,

            spm_upgrade_total_time time NULL,
            pai_upgrade_total_time time NULL,
            both_upgrade_total_time time NULL,
            startup_total_time time NULL,
            shutdown_total_time time NULL,
            restart_total_time time NULL,

            spm_upgrade_total_fail_time time NULL,
            pai_upgrade_total_fail_time time NULL,
            both_upgrade_total_fail_time time NULL,
            startup_total_fail_time time NULL,
            shutdown_total_fail_time time NULL,
            restart_total_fail_time time NULL,

            all_pass_time time NULL,
            all_fail_time time NULL,

            total_passed_count int(11) NULL,
            total_failed_count int(11) NULL,

            created_at datetime NULL,
            CONSTRAINT pk_z_release_data_id PRIMARY KEY (id)
        )";

        \DB::statement($dropTable);
        \DB::statement($createTable);

        $rnData = DB::table('release_numbers')->get();

        foreach ($rnData as $rD) {

            $spm_version = Null;
            $pai_version = Null;

            $startup = 0;
            $shutdown = 0;
            $restart = 0;
            $spm_upgrade = 0;
            $pai_upgrade = 0;
            $both_upgrade = 0;

            $startup_pass_count = 0;
            $shutdown_pass_count = 0;
            $restart_pass_count = 0;
            $spm_upgrade_pass_count = 0;
            $pai_upgrade_pass_count = 0;
            $both_upgrade_pass_count = 0;

            $startup_fail_count = 0;
            $shutdown_fail_count = 0;
            $restart_fail_count = 0;
            $spm_upgrade_fail_count = 0;
            $pai_upgrade_fail_count = 0;
            $both_upgrade_fail_count = 0;

            $all_pass_time = 0;
            $all_fail_time = 0;

            $startup_array = array();
            $shutdown_array = array();
            $spm_upgrade_array = array();
            $pai_upgrade_array = array();
            $both_upgrade_array = array();
            $restart_array = array();

            $startup_fail_array = array();
            $shutdown_fail_array = array();
            $spm_upgrade_fail_array = array();
            $pai_upgrade_fail_array = array();
            $both_upgrade_fail_array = array();
            $restart_fail_array = array();

            $startup_array_scheduler = array();
            $shutdown_array_scheduler = array();
            $spm_upgrade_array_scheduler = array();
            $pai_upgrade_array_scheduler = array();
            $both_upgrade_array_scheduler = array();
            $restart_array_scheduler = array();

            $release = $rD->release_number;
            $actionData = DB::table('system_statistics')->where('spm_version', $release)->orWhere('pai_version', $release)->get();

            if (count($actionData) > 0 ) {
                // echo $release . " - " . (count($actionData))."\n";

                echo "\n".$release . " - " . (count($actionData))."  --- ";

                foreach ($actionData as $sS) {
                    if ($sS->spm_version == $release) {
                        $spm_version = $release;
                    } else {
                        $pai_version = $release;
                    }

                    if ($sS->action == "StartAppServer") {
                        $startup++;
                        if ($sS->status == "Successful") {
                            array_push($startup_array, $sS->time_taken);
                            $startup_pass_count++;
                        } elseif ($sS->status == "Scheduler") {
                            array_push($startup_array_scheduler, $sS->time_taken);
                            $startup_pass_count++;
                        }
                        else {
                            array_push($startup_fail_array, $sS->time_taken);
                            $startup_fail_count++;
                        }
                    }
                    if ($sS->action == "ShutDownAppServer") {
                        $shutdown++;
                        if ($sS->status == "Successful") {
                            array_push($shutdown_array, $sS->time_taken);
                            $shutdown_pass_count++;
                        } elseif ($sS->status == "Scheduler") {
                            array_push($shutdown_array_scheduler, $sS->time_taken);
                            $shutdown_pass_count++;
                        } else {
                            array_push($shutdown_fail_array, $sS->time_taken);
                            $shutdown_fail_count++;
                        }
                    }
                    if ($sS->action == "SPO_upgrade") {
                        $spm_upgrade++;
                        if ($sS->status == "Successful") {
                            array_push($spm_upgrade_array, $sS->time_taken);
                            $spm_upgrade_pass_count++;
                        } elseif ($sS->status == "Scheduler") {
                            array_push($spm_upgrade_array_scheduler, $sS->time_taken);
                            $spm_upgrade_pass_count++;
                        } else {
                            array_push($spm_upgrade_fail_array, $sS->time_taken);
                            $spm_upgrade_fail_count++;
                        }
                    }
                    if ($sS->action == "PAI_upgrade") {
                        $pai_upgrade++;
                        if ($sS->status == "Successful") {
                            array_push($pai_upgrade_array, $sS->time_taken);
                            $pai_upgrade_pass_count++;
                        } elseif ($sS->status == "Scheduler") {
                            array_push($pai_upgrade_array_scheduler, $sS->time_taken);
                            $pai_upgrade_pass_count++;
                        } else {
                            array_push($pai_upgrade_fail_array, $sS->time_taken);
                            $pai_upgrade_fail_count++;
                        }
                    }
                    if ($sS->action == "BuildUpdate") {
                        $both_upgrade++;
                        if ($sS->status == "Successful") {
                            array_push($both_upgrade_array, $sS->time_taken);
                            $both_upgrade_pass_count++;
                        } elseif ($sS->status == "Scheduler") {
                            array_push($both_upgrade_array_scheduler, $sS->time_taken);
                            $both_upgrade_pass_count++;
                        } else {
                            array_push($both_upgrade_fail_array, $sS->time_taken);
                            $both_upgrade_fail_count++;
                        }
                    }
                    if ($sS->action == "Restart") {
                        $restart++;
                        if ($sS->status == "Successful") {
                            array_push($restart_array, $sS->time_taken);
                            $restart_pass_count++;
                        } elseif ($sS->status == "Scheduler"){
                            array_push($restart_array_scheduler, $sS->time_taken);
                            $restart_pass_count++;
                        } else {
                            array_push($restart_fail_array, $sS->time_taken);
                            $restart_fail_count++;
                        }
                    }

                }

                try {
                    list($spm_upgrade_max_time, $spm_upgrade_min_time, $spm_upgrade_avg_time, $spm_upgrade_total_time) = max_min_avg_total($spm_upgrade_array, $spm_upgrade_array_scheduler);
                } catch (\Throwable $th) {
                    echo $th;
                    $spm_upgrade_max_time = null;
                    $spm_upgrade_min_time = null;
                    $spm_upgrade_avg_time = null;
                    $spm_upgrade_total_time = null;

                }

                try {
                    $spm_upgrade_total_fail_time = fail_hours($spm_upgrade_fail_count,$spm_upgrade_fail_array);
                } catch (\Throwable $th) {
                    $spm_upgrade_total_fail_time = null;
                }

                try {
                    list($pai_upgrade_max_time, $pai_upgrade_min_time, $pai_upgrade_avg_time, $pai_upgrade_total_time) = max_min_avg_total($pai_upgrade_array, $pai_upgrade_array_scheduler);
                } catch (\Throwable $th) {
                    echo $th;
                    $pai_upgrade_max_time = null;
                    $pai_upgrade_min_time = null;
                    $pai_upgrade_avg_time = null;
                    $pai_upgrade_total_time = null;
                    $pai_upgrade_total_fail_time = null;
                }

                try {
                    $pai_upgrade_total_fail_time = fail_hours($pai_upgrade_fail_count,$pai_upgrade_fail_array);
                } catch (\Throwable $th) {
                    $pai_upgrade_total_fail_time = null;
                }

                try {
                    list($both_upgrade_max_time, $both_upgrade_min_time, $both_upgrade_avg_time, $both_upgrade_total_time) = max_min_avg_total($both_upgrade_array, $both_upgrade_array_scheduler);
                } catch (\Throwable $th) {
                    echo $th;
                    $both_upgrade_max_time = null;
                    $both_upgrade_min_time = null;
                    $both_upgrade_avg_time = null;
                    $both_upgrade_total_time = null;
                }

                try {
                    $both_upgrade_total_fail_time = fail_hours($both_upgrade_fail_count,$both_upgrade_fail_array);
                } catch (\Throwable $th) {
                    $both_upgrade_total_fail_time = null;
                }

                try {
                    list($startup_max_time, $startup_min_time, $startup_avg_time, $startup_total_time) = max_min_avg_total($startup_array, $startup_array_scheduler);
                } catch (\Throwable $th) {
                    echo $th;
                    $startup_max_time = null;
                    $startup_min_time = null;
                    $startup_avg_time = null;
                    $startup_total_time = null;
                }

                try {
                    $startup_total_fail_time = fail_hours($startup_fail_count,$startup_fail_array);
                } catch (\Throwable $th) {
                    $startup_total_fail_time = null;
                }

                try {
                    list($shutdown_max_time, $shutdown_min_time, $shutdown_avg_time, $shutdown_total_time) = max_min_avg_total($shutdown_array, $shutdown_array_scheduler);
                } catch (\Throwable $th) {
                    echo $th;
                    $shutdown_max_time = null;
                    $shutdown_min_time = null;
                    $shutdown_avg_time = null;
                    $shutdown_total_time = null;
                }

                try {
                    $shutdown_total_fail_time = fail_hours($restart_fail_count,$shutdown_fail_array);
                } catch (\Throwable $th) {
                    $shutdown_total_fail_time = null;
                }

                try {
                    list($restart_max_time, $restart_min_time, $restart_avg_time, $restart_total_time) = max_min_avg_total($restart_array, $restart_array_scheduler);
                } catch (\Throwable $th) {
                    echo $th;
                    $restart_max_time = null;
                    $restart_min_time = null;
                    $restart_avg_time = null;
                    $restart_total_time = null;
                }

                try {
                    $restart_total_fail_time = fail_hours($restart_fail_count,$restart_fail_array);
                } catch (\Throwable $th) {
                    $restart_total_fail_time = null;
                }

                // echo "\n ====> ".count($restart_fail_array) . count($both_upgrade_fail_array) . count($startup_fail_array) . count($pai_upgrade_fail_array) . count($spm_upgrade_fail_array) . count($shutdown_fail_array) . "\n";


                try {
                    $all_pass_time = add_everything($spm_upgrade_total_time, $pai_upgrade_total_time, $both_upgrade_total_time, $startup_total_time, $shutdown_total_time, $restart_total_time);
                } catch (\Throwable $th) {
                    echo $th;
                    $all_pass_time = 0;
                }

                try {
                    $all_fail_time = add_everything($spm_upgrade_total_fail_time, $pai_upgrade_total_fail_time, $both_upgrade_total_fail_time, $startup_total_fail_time, $shutdown_total_fail_time, $restart_total_fail_time);
                    echo " FAIL ====> ".$spm_upgrade_total_fail_time." | ".$pai_upgrade_total_fail_time." | ".$both_upgrade_total_fail_time." | ".$startup_total_fail_time." | ".$shutdown_total_fail_time." | ".$restart_total_fail_time." | ".$all_fail_time."\n";
                } catch (\Throwable $th) {
                    echo $th;
                    $all_fail_time = 0;
                }

                $total_passed_count = $spm_upgrade_pass_count + $pai_upgrade_pass_count + $both_upgrade_pass_count + $shutdown_pass_count + $restart_pass_count;
                $total_failed_count = $spm_upgrade_fail_count + $pai_upgrade_fail_count + $both_upgrade_fail_count + $shutdown_fail_count + $restart_fail_count;

                // echo $release . " - " . count($spm_upgrade_array) . "\n";

                try {
                    DB::table('z_release_data')->insert(['id'=>null, 'spm_version' => $spm_version, 'pai_version' => $pai_version, 'spm_upgrade_pass_count' => $spm_upgrade_pass_count, 'spm_upgrade_fail_count' => $spm_upgrade_fail_count, 'spm_upgrade_max_time' => $spm_upgrade_max_time, 'spm_upgrade_min_time' => $spm_upgrade_min_time, 'spm_upgrade_avg_time' => $spm_upgrade_avg_time, 'spm_upgrade_total_time' => $spm_upgrade_total_time, 'spm_upgrade_total_fail_time' => $spm_upgrade_total_fail_time, 'pai_upgrade_pass_count' => $pai_upgrade_pass_count, 'pai_upgrade_fail_count' => $pai_upgrade_fail_count, 'pai_upgrade_max_time' => $pai_upgrade_max_time, 'pai_upgrade_min_time'=> $pai_upgrade_min_time, 'pai_upgrade_avg_time'=>$pai_upgrade_avg_time, 'pai_upgrade_total_time'=>$pai_upgrade_total_time, 'pai_upgrade_total_fail_time'=>$pai_upgrade_total_fail_time, 'both_upgrade_fail_count' => $both_upgrade_fail_count, 'both_upgrade_pass_count' => $both_upgrade_pass_count, 'both_upgrade_max_time'=>$both_upgrade_max_time, 'both_upgrade_min_time'=>$both_upgrade_min_time, 'both_upgrade_avg_time'=>$both_upgrade_avg_time, 'both_upgrade_total_time'=>$both_upgrade_total_time, 'both_upgrade_total_fail_time'=>$both_upgrade_total_fail_time, 'startup_pass_count' => $startup_pass_count, 'startup_fail_count' => $startup_fail_count, 'startup_max_time'=>$startup_max_time, 'startup_min_time'=>$startup_min_time, 'startup_avg_time'=>$startup_avg_time, 'startup_total_time'=>$startup_total_time, 'startup_total_fail_time'=>$startup_total_fail_time, 'shutdown_pass_count' => $shutdown_pass_count, 'shutdown_fail_count' => $shutdown_fail_count, 'shutdown_max_time'=>$shutdown_max_time, 'shutdown_min_time'=>$shutdown_min_time, 'shutdown_avg_time'=>$shutdown_avg_time, 'shutdown_total_time'=>$shutdown_total_time, 'shutdown_total_fail_time'=>$shutdown_total_fail_time, 'restart_pass_count' => $restart_pass_count, 'restart_fail_count' => $restart_fail_count, 'restart_max_time'=>$restart_max_time, 'restart_min_time'=>$restart_min_time, 'restart_avg_time'=>$restart_avg_time, 'restart_total_time'=>$restart_total_time, 'restart_total_fail_time'=>$restart_total_fail_time, 'total_passed_count'=>$total_passed_count, 'total_failed_count'=>$total_failed_count, 'all_pass_time'=>$all_pass_time, 'all_fail_time'=>$all_fail_time, 'created_at'=>Carbon::now()]);
                    $pass++;
                } catch (\Throwable $th) {
                    throw $th;
                    $fail++;
                }

            }

        }
        echo "\n Passed: " . $pass . " Failed: " . $fail."\n";
        echo " ------------------------ STATS2 -------------------------- ENDS \n";
    }

}
