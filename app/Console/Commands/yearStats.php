<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class yearStats extends Command
{
    protected $signature = 'command:tpStats';

    protected $description = 'This command is dependent on stats1, stats2 and stats3 to be executed first';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        echo " STARTING ------------------------ TPSTATS -------------------------- \n";

        $fy21StartDate = date('Y-m-d', strtotime('2020-10-01'));
        $fy21EndDate = date('Y-m-d', strtotime('2021-09-30'));
        $fy22StartDate = date('Y-m-d', strtotime('2021-10-01'));
        $fy22EndDate = date('Y-m-d', strtotime('2022-09-30'));
        $fy22Q1StartDate = date('Y-m-d', strtotime('2021-10-01'));
        $fy22Q1EndDate = date('Y-m-d', strtotime('2021-12-31'));
        $fy22Q2StartDate = date('Y-m-d', strtotime('2022-01-01'));
        $fy22Q2EndDate = date('Y-m-d', strtotime('2022-03-31'));
        $fy22Q3StartDate = date('Y-m-d', strtotime('2022-04-01'));
        $fy22Q3EndDate = date('Y-m-d', strtotime('2022-06-30'));
        $fy22Q4StartDate = date('Y-m-d', strtotime('2022-07-01'));
        $fy22Q4EndDate = date('Y-m-d', strtotime('2022-09-30    '));
        $todate = date('Y-m-d');
        $lastSixMonths = date('Y-m-d', strtotime('-6 months'));
        $lastThreeMonths = date('Y-m-d', strtotime('-3 months'));
        $lastOneMonth = date('Y-m-d', strtotime('-1 months'));

        $dropTable = 'DROP TABLE IF EXISTS z_tp_data';
        $createTable = 'CREATE TABLE IF NOT EXISTS z_tp_data (
            id int(11) NOT NULL AUTO_INCREMENT,
            time_period varchar(50) NULL,

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

            all_pass_time varchar(20) NULL,
            all_fail_time varchar(20) NULL,

            total_passed_count int(11) NULL,
            total_failed_count int(11) NULL,

            created_at datetime NULL,
            CONSTRAINT pk_z_release_data_id PRIMARY KEY (id)
        )';

        \DB::statement($dropTable);
        \DB::statement($createTable);

        // function max_min_avg_total($array1, $array2) {
        //     $array = array_merge($array1, $array2);
        //     // echo count($array1)." - ". count($array2)." - ".count($array)." <<==";
        //     if (count($array) < 1) {
        //         $max = Null;
        //         $min = Null;
        //         $avg = Null;
        //         $total = Null;
        //         $gsum = 0;
        //         $average = 0;
        //     } else {
        //         $gsum = 0;
        //         $sum = 0;
        //         $avg = 0;
        //         $total = 0;
        //         $max = max($array);
        //         $min = min($array);
        //         foreach($array as $val) {
        //             $exploded = explode(':',$val);
        //             $sum = $exploded[0]*60*60 + $exploded[1]*60 + $exploded[2];
        //             $gsum = $gsum + $sum;
        //             // echo $val." / ";
        //         }
        //         $average = $gsum / count($array);
        //         if ($average < 24 * 60 * 60) {
        //             $avg = gmdate('H:i:s', $average);
        //         } else {
        //             $hrs = floor($average / 3600);
        //             $min = floor(($average - $hours * 3600) / 60);
        //             $sec = floor($average - ($hours * 3600) - ($minutes * 60));
        //             $avg = "$hrs:$min:$sec";
        //         }
        //         if ($gsum < 24 * 60 * 60) {
        //             $total = gmdate('H:i:s', $gsum);
        //         } else {
        //             $hours = floor($gsum / 3600);
        //             $minutes = floor(($gsum - $hours * 3600) / 60);
        //             $seconds = floor($gsum - ($hours * 3600) - ($minutes * 60));
        //             $total = "$hours:$minutes:$seconds";
        //         }
        //     }
        //     // echo "Max: $max, Min: $min, Avg: $avg, Total: $total GSUM: $gsum AVG: $average FAIL: $fail";
        //     return array($max, $min, $avg, $total );
        // }

        // function fail_hours($rec_count, $array) {
        //     // echo "Fail Count: $rec_count | Array count: ".count($array);
        //     $fail = Null;
        //     $sum=0;
        //     $hours=0;
        //     $minutes=0;
        //     $seconds=0;
        //     $fgsum=0;
        //     if($rec_count > 0) {
        //         foreach ($array as $fval) {
        //             $exploded = explode(':',$fval);
        //             $sum = $exploded[0]*60*60 + $exploded[1]*60 + $exploded[2];
        //             $fgsum = $fgsum + $sum;
        //         }
        //         if ($fgsum < 24 * 60 * 60) {
        //             $fail = gmdate('H:i:s', $fgsum);
        //         } else {
        //             $hours = floor($fgsum / 3600);
        //             $minutes = floor(($fgsum - $hours * 3600) / 60);
        //             $seconds = floor($fgsum - ($hours * 3600) - ($minutes * 60));
        //             $fail = "$hours:$minutes:$seconds";
        //         }
        //     }
        //     return $fail;
        // }

        // function add_everything($var1, $var2, $var3, $var4, $var5, $var6) {
        //     if(!is_null($var1)) {
        //         $exp1 = explode(':',$var1);
        //         $sum1 = $exp1[0]*60*60 + $exp1[1]*60 + $exp1[2];
        //     } else {
        //         $sum1 = 0;
        //     }
        //     if (!is_null($var2)) {
        //         $exp2 = explode(':',$var2);
        //         $sum2 = $exp2[0]*60*60 + $exp2[1]*60 + $exp2[2];
        //     } else {
        //         $sum2 = 0;
        //     }
        //     if (!is_null($var3)) {
        //         $exp3 = explode(':',$var3);
        //         $sum3 = $exp3[0]*60*60 + $exp3[1]*60 + $exp3[2];
        //     } else {
        //         $sum3 = 0;
        //     }
        //     if (!is_null($var4)) {
        //         $exp4 = explode(':',$var4);
        //         $sum4 = $exp4[0]*60*60 + $exp4[1]*60 + $exp4[2];
        //     } else {
        //         $sum4 = 0;
        //     }
        //     if (!is_null($var5)) {
        //         $exp5 = explode(':',$var5);
        //         $sum5 = $exp5[0]*60*60 + $exp5[1]*60 + $exp5[2];
        //     } else {
        //         $sum5 = 0;
        //     }
        //     if (!is_null($var6)) {
        //         $exp6 = explode(':',$var6);
        //         $sum6 = $exp6[0]*60*60 + $exp6[1]*60 + $exp6[2];
        //     } else {
        //         $sum6 = 0;
        //     }
        //     $superSum = $sum1 + $sum2 + $sum3 + $sum4 + $sum5 + $sum6;
        //     $hours = floor($superSum / 3600);
        //     $minutes = floor(($superSum - $hours * 3600) / 60);
        //     $seconds = floor($superSum - ($hours * 3600) - ($minutes * 60));

        //     $rv = $hours.":".$minutes.":".$seconds;
        //     return $rv;
        // }

        function insert_data($time_period, $array)
        {
            $pass = 0;
            $fail = 0;
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

            $startup_array = [];
            $shutdown_array = [];
            $spm_upgrade_array = [];
            $pai_upgrade_array = [];
            $both_upgrade_array = [];
            $restart_array = [];

            $startup_fail_array = [];
            $shutdown_fail_array = [];
            $spm_upgrade_fail_array = [];
            $pai_upgrade_fail_array = [];
            $both_upgrade_fail_array = [];
            $restart_fail_array = [];

            $startup_array_scheduler = [];
            $shutdown_array_scheduler = [];
            $spm_upgrade_array_scheduler = [];
            $pai_upgrade_array_scheduler = [];
            $both_upgrade_array_scheduler = [];
            $restart_array_scheduler = [];

            foreach ($array as $sS) {
                // if ($sS->spm_version == $release) {
                //     $spm_version = $release;
                // } else {
                //     $pai_version = $release;
                // }

                if ($sS->action == 'StartAppServer') {
                    $startup++;
                    if ($sS->status == 'Successful') {
                        array_push($startup_array, $sS->time_taken);
                        $startup_pass_count++;
                    } elseif ($sS->status == 'Scheduler') {
                        array_push($startup_array_scheduler, $sS->time_taken);
                        $startup_pass_count++;
                    } else {
                        array_push($startup_fail_array, $sS->time_taken);
                        $startup_fail_count++;
                    }
                }
                if ($sS->action == 'ShutDownAppServer') {
                    $shutdown++;
                    if ($sS->status == 'Successful') {
                        array_push($shutdown_array, $sS->time_taken);
                        $shutdown_pass_count++;
                    } elseif ($sS->status == 'Scheduler') {
                        array_push($shutdown_array_scheduler, $sS->time_taken);
                        $shutdown_pass_count++;
                    } else {
                        array_push($shutdown_fail_array, $sS->time_taken);
                        $shutdown_fail_count++;
                    }
                }
                if ($sS->action == 'SPO_upgrade') {
                    $spm_upgrade++;
                    if ($sS->status == 'Successful') {
                        array_push($spm_upgrade_array, $sS->time_taken);
                        $spm_upgrade_pass_count++;
                    } elseif ($sS->status == 'Scheduler') {
                        array_push($spm_upgrade_array_scheduler, $sS->time_taken);
                        $spm_upgrade_pass_count++;
                    } else {
                        array_push($spm_upgrade_fail_array, $sS->time_taken);
                        $spm_upgrade_fail_count++;
                    }
                }
                if ($sS->action == 'PAI_upgrade') {
                    $pai_upgrade++;
                    if ($sS->status == 'Successful') {
                        array_push($pai_upgrade_array, $sS->time_taken);
                        $pai_upgrade_pass_count++;
                    } elseif ($sS->status == 'Scheduler') {
                        array_push($pai_upgrade_array_scheduler, $sS->time_taken);
                        $pai_upgrade_pass_count++;
                    } else {
                        array_push($pai_upgrade_fail_array, $sS->time_taken);
                        $pai_upgrade_fail_count++;
                    }
                }
                if ($sS->action == 'BuildUpdate') {
                    $both_upgrade++;
                    if ($sS->status == 'Successful') {
                        array_push($both_upgrade_array, $sS->time_taken);
                        $both_upgrade_pass_count++;
                    } elseif ($sS->status == 'Scheduler') {
                        array_push($both_upgrade_array_scheduler, $sS->time_taken);
                        $both_upgrade_pass_count++;
                    } else {
                        array_push($both_upgrade_fail_array, $sS->time_taken);
                        $both_upgrade_fail_count++;
                    }
                }
                if ($sS->action == 'Restart') {
                    $restart++;
                    if ($sS->status == 'Successful') {
                        array_push($restart_array, $sS->time_taken);
                        $restart_pass_count++;
                    } elseif ($sS->status == 'Scheduler') {
                        array_push($restart_array_scheduler, $sS->time_taken);
                        $restart_pass_count++;
                    } else {
                        array_push($restart_fail_array, $sS->time_taken);
                        $restart_fail_count++;
                    }
                }

                try {
                    [$spm_upgrade_max_time, $spm_upgrade_min_time, $spm_upgrade_avg_time, $spm_upgrade_total_time] = max_min_avg_total($spm_upgrade_array, $spm_upgrade_array_scheduler);
                } catch (\Throwable $th) {
                    // echo $th;
                    $spm_upgrade_max_time = null;
                    $spm_upgrade_min_time = null;
                    $spm_upgrade_avg_time = null;
                    $spm_upgrade_total_time = null;
                }

                try {
                    $spm_upgrade_total_fail_time = fail_hours($spm_upgrade_fail_count, $spm_upgrade_fail_array);
                } catch (\Throwable $th) {
                    $spm_upgrade_total_fail_time = null;
                }

                try {
                    [$pai_upgrade_max_time, $pai_upgrade_min_time, $pai_upgrade_avg_time, $pai_upgrade_total_time] = max_min_avg_total($pai_upgrade_array, $pai_upgrade_array_scheduler);
                } catch (\Throwable $th) {
                    // echo $th;
                    $pai_upgrade_max_time = null;
                    $pai_upgrade_min_time = null;
                    $pai_upgrade_avg_time = null;
                    $pai_upgrade_total_time = null;
                    $pai_upgrade_total_fail_time = null;
                }

                try {
                    $pai_upgrade_total_fail_time = fail_hours($pai_upgrade_fail_count, $pai_upgrade_fail_array);
                } catch (\Throwable $th) {
                    $pai_upgrade_total_fail_time = null;
                }

                try {
                    [$both_upgrade_max_time, $both_upgrade_min_time, $both_upgrade_avg_time, $both_upgrade_total_time] = max_min_avg_total($both_upgrade_array, $both_upgrade_array_scheduler);
                } catch (\Throwable $th) {
                    echo $th;
                    $both_upgrade_max_time = null;
                    $both_upgrade_min_time = null;
                    $both_upgrade_avg_time = null;
                    $both_upgrade_total_time = null;
                }

                try {
                    $both_upgrade_total_fail_time = fail_hours($both_upgrade_fail_count, $both_upgrade_fail_array);
                } catch (\Throwable $th) {
                    $both_upgrade_total_fail_time = null;
                }

                try {
                    [$startup_max_time, $startup_min_time, $startup_avg_time, $startup_total_time] = max_min_avg_total($startup_array, $startup_array_scheduler);
                } catch (\Throwable $th) {
                    echo $th;
                    $startup_max_time = null;
                    $startup_min_time = null;
                    $startup_avg_time = null;
                    $startup_total_time = null;
                }

                try {
                    $startup_total_fail_time = fail_hours($startup_fail_count, $startup_fail_array);
                } catch (\Throwable $th) {
                    $startup_total_fail_time = null;
                }

                try {
                    [$shutdown_max_time, $shutdown_min_time, $shutdown_avg_time, $shutdown_total_time] = max_min_avg_total($shutdown_array, $shutdown_array_scheduler);
                } catch (\Throwable $th) {
                    echo $th;
                    $shutdown_max_time = null;
                    $shutdown_min_time = null;
                    $shutdown_avg_time = null;
                    $shutdown_total_time = null;
                }

                try {
                    $shutdown_total_fail_time = fail_hours($restart_fail_count, $shutdown_fail_array);
                } catch (\Throwable $th) {
                    $shutdown_total_fail_time = null;
                }

                try {
                    [$restart_max_time, $restart_min_time, $restart_avg_time, $restart_total_time] = max_min_avg_total($restart_array, $restart_array_scheduler);
                } catch (\Throwable $th) {
                    echo $th;
                    $restart_max_time = null;
                    $restart_min_time = null;
                    $restart_avg_time = null;
                    $restart_total_time = null;
                }

                try {
                    $restart_total_fail_time = fail_hours($restart_fail_count, $restart_fail_array);
                } catch (\Throwable $th) {
                    $restart_total_fail_time = null;
                }

                try {
                    $all_pass_time = add_everything($spm_upgrade_total_time, $pai_upgrade_total_time, $both_upgrade_total_time, $startup_total_time, $shutdown_total_time, $restart_total_time);
                } catch (\Throwable $th) {
                    echo $th;
                    $all_pass_time = 0;
                }

                try {
                    $all_fail_time = add_everything($spm_upgrade_total_fail_time, $pai_upgrade_total_fail_time, $both_upgrade_total_fail_time, $startup_total_fail_time, $shutdown_total_fail_time, $restart_total_fail_time);
                    // echo " FAIL ====> ".$spm_upgrade_total_fail_time." | ".$pai_upgrade_total_fail_time." | ".$both_upgrade_total_fail_time." | ".$startup_total_fail_time." | ".$shutdown_total_fail_time." | ".$restart_total_fail_time." | ".$all_fail_time."\n";
                } catch (\Throwable $th) {
                    echo $th;
                    $all_fail_time = 0;
                }

                $total_passed_count = $spm_upgrade_pass_count + $pai_upgrade_pass_count + $both_upgrade_pass_count + $shutdown_pass_count + $restart_pass_count;
                $total_failed_count = $spm_upgrade_fail_count + $pai_upgrade_fail_count + $both_upgrade_fail_count + $shutdown_fail_count + $restart_fail_count;
            }
            try {
                DB::table('z_tp_data')->insert(['id' => null, 'time_period' => $time_period, 'spm_upgrade_pass_count' => $spm_upgrade_pass_count, 'spm_upgrade_fail_count' => $spm_upgrade_fail_count, 'spm_upgrade_max_time' => $spm_upgrade_max_time, 'spm_upgrade_min_time' => $spm_upgrade_min_time, 'spm_upgrade_avg_time' => $spm_upgrade_avg_time, 'spm_upgrade_total_time' => $spm_upgrade_total_time, 'spm_upgrade_total_fail_time' => $spm_upgrade_total_fail_time, 'pai_upgrade_pass_count' => $pai_upgrade_pass_count, 'pai_upgrade_fail_count' => $pai_upgrade_fail_count, 'pai_upgrade_max_time' => $pai_upgrade_max_time, 'pai_upgrade_min_time' => $pai_upgrade_min_time, 'pai_upgrade_avg_time' => $pai_upgrade_avg_time, 'pai_upgrade_total_time' => $pai_upgrade_total_time, 'pai_upgrade_total_fail_time' => $pai_upgrade_total_fail_time, 'both_upgrade_fail_count' => $both_upgrade_fail_count, 'both_upgrade_pass_count' => $both_upgrade_pass_count, 'both_upgrade_max_time' => $both_upgrade_max_time, 'both_upgrade_min_time' => $both_upgrade_min_time, 'both_upgrade_avg_time' => $both_upgrade_avg_time, 'both_upgrade_total_time' => $both_upgrade_total_time, 'both_upgrade_total_fail_time' => $both_upgrade_total_fail_time, 'startup_pass_count' => $startup_pass_count, 'startup_fail_count' => $startup_fail_count, 'startup_max_time' => $startup_max_time, 'startup_min_time' => $startup_min_time, 'startup_avg_time' => $startup_avg_time, 'startup_total_time' => $startup_total_time, 'startup_total_fail_time' => $startup_total_fail_time, 'shutdown_pass_count' => $shutdown_pass_count, 'shutdown_fail_count' => $shutdown_fail_count, 'shutdown_max_time' => $shutdown_max_time, 'shutdown_min_time' => $shutdown_min_time, 'shutdown_avg_time' => $shutdown_avg_time, 'shutdown_total_time' => $shutdown_total_time, 'shutdown_total_fail_time' => $shutdown_total_fail_time, 'restart_pass_count' => $restart_pass_count, 'restart_fail_count' => $restart_fail_count, 'restart_max_time' => $restart_max_time, 'restart_min_time' => $restart_min_time, 'restart_avg_time' => $restart_avg_time, 'restart_total_time' => $restart_total_time, 'restart_total_fail_time' => $restart_total_fail_time, 'total_passed_count' => $total_passed_count, 'total_failed_count' => $total_failed_count, 'all_pass_time' => $all_pass_time, 'all_fail_time' => $all_fail_time, 'created_at' => Carbon::now()]);
                $pass++;
            } catch (\Throwable $th) {
                throw $th;
                $fail++;
            }
        }

        $actionData = DB::Table('system_statistics')->orderBy('start_time')->get();
        $tpArray = ['FY21', 'FY22Q1', 'FY22Q2', 'FY22', '6MTH', '3MTH', '1MTH'];
        $fy21array = [];
        $fy22array = [];
        $fy22q1array = [];
        $fy22q2array = [];
        $fy22q3array = [];
        $fy22q4array = [];
        $sixmontharray = [];
        $threemontharray = [];
        $onemontharray = [];

        foreach ($actionData as $aD) {
            $data_date = date('Y-m-d', strtotime($aD->start_time));

            if ($data_date >= $fy21StartDate && $data_date <= $fy21EndDate) {
                $fy21array[] = $aD;
            }
            if ($data_date >= $fy22StartDate && $data_date <= $fy22EndDate) {
                $fy22array[] = $aD;
            }
            if ($data_date >= $fy22Q1StartDate && $data_date <= $fy22Q1EndDate) {
                $fy22q1array[] = $aD;
            }
            if ($data_date >= $fy22Q2StartDate && $data_date <= $fy22Q2EndDate) {
                $fy22q2array[] = $aD;
            }
            if ($data_date >= $fy22Q3StartDate && $data_date <= $fy22Q3EndDate) {
                $fy22q3array[] = $aD;
            }
            if ($data_date >= $fy22Q4StartDate && $data_date <= $fy22Q4EndDate) {
                $fy22q4array[] = $aD;
            }
            if ($data_date >= $lastSixMonths && $data_date <= $todate) {
                $sixmontharray[] = $aD;
            }
            if ($data_date >= $lastThreeMonths && $data_date <= $todate) {
                $threemontharray[] = $aD;
            }
            if ($data_date >= $lastOneMonth && $data_date <= $todate) {
                $onemontharray[] = $aD;
            }
        }
        if (count($fy21array) > 0) {
            insert_data('FY 2021', $fy21array);
        }
        if (count($fy22array) > 0) {
            insert_data('FY 2022', $fy22array);
        }
        if (count($fy22q1array) > 0) {
            insert_data('Q1 FY 2022', $fy22q1array);
        }
        if (count($fy22q2array) > 0) {
            insert_data('Q2 FY 2022', $fy22q2array);
        }
        if (count($fy22q3array) > 0) {
            insert_data('Q3 FY 2022', $fy22q3array);
        }
        if (count($fy22q4array) > 0) {
            insert_data('Q4 FY 2022', $fy22q4array);
        }
        if (count($sixmontharray) > 0) {
            insert_data('Last 6 months', $sixmontharray);
        }
        if (count($threemontharray) > 0) {
            insert_data('Last 3 months', $threemontharray);
        }
        if (count($onemontharray) > 0) {
            insert_data('Last 1 month', $onemontharray);
        }

        echo count($actionData)."\n";
        // echo ."\n");
        // echo (count($fy22array)."\n");
        // echo (count($fy22q1array)."\n");
        // echo (count($fy22q2array)."\n");
        // echo (count($fy22q3array)."\n");
        // echo (count($fy22q4array)."\n");
        // echo (count($sixmontharray)."\n");
        // echo (count($threemontharray)."\n");
        // echo (count($onemontharray)."\n");

        // echo ($fy21StartDate . " - " . $fy21EndDate . "\n");
        // echo ($fy22StartDate . " - " . $fy22EndDate . "\n");
        // echo $fy22Q1StartDate . " - " . $fy22Q1EndDate . "\n";
        // echo $fy22Q2StartDate . " - " . $fy22Q2EndDate . "\n";
        // echo ("6 Months: ".$lastSixMonths."\n");
        // echo ("3 Months: ".$lastThreeMonths."\n");
        // echo ("1 Month: ".$lastOneMonth."\n");
        echo " ------------------------ TPSTATS -------------------------- ENDS \n";
    }
}
