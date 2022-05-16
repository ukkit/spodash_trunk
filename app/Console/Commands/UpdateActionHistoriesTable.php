<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\actionHistory;
use DB;
use Carbon\Carbon;
use Log;

class UpdateActionHistoriesTable extends Command
{

    protected $signature = 'command:actionhistories';

    protected $description = 'Executed every hour';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $scriptID = '8kA2mWiWrJVGUPufbha4rmkcGdnvZjEhEaUnkJbzCfhWuSnj2QTTt3rTKRJyCf3G'; //NOT TO BE CHANGED

        echo " =====> ".Carbon::now()->sub('minutes', 45)."\n";
        $actions = DB::table('action_histories')
                    ->whereNull('end_time')
                    ->whereTime('start_time', '<', Carbon::now()->sub('minutes', 45))
                    // ->whereDate('start_time', '<', Carbon::now()->sub('hour', 1))
                    ->get();
        $counter = 0;
        echo "Found ".count($actions)." record(s) to update \n";
        Log::info("[command:actionhistories] Found ".count($actions)." record(s) to update");

        foreach ($actions as $act) {
            $doIT = True;
            // echo $action->id."\n";
            $action_histories_id = $act->id;
            $instance_details_id = $act->instance_details_id;
            $action = $act->action;
            $o_status = $act->status;
            $inst = DB::table('instance_details')->where('id',$act->instance_details_id)->first();
            $o_rjj = $inst->running_jenkins_job;
            $o_created_at = $act->created_at;
            $o_updated_at = $act->updated_at;
            $notes = "";

            try {
                DB::table('action_histories')->where('id', $action_histories_id)->update(['status' => "Scheduler",'end_time'=>Carbon::now(),'updated_at'=>Carbon::now()]);
                echo "Record updated in action_histores table for action_id: ".$action_histories_id."\n";
                $notes .= "status changed to Scheduler in action_histores table for action_id: ".$action_histories_id." | ";
            } catch (\Throwable $th) {
                throw $th;
                $doIT = False;
            }

            if($doIT) {
                if ($o_rjj == "Y") {
                    try {
                        DB::table('instance_details')->where('id', $instance_details_id)->update(['running_jenkins_job' => "N",'updated_at'=>Carbon::now()]);
                        echo "Record updated in instance_details table for instance_details_id: ".$instance_details_id."\n";
                        $notes .= "running_jenkins_job updated in instance_details table for instance_details_id: ".$instance_details_id." | ";
                    } catch (\Throwable $th) {
                        throw $th;
                        $doIT = False;
                    }
                } else {
                    echo "No need to update running_jenkins_job in instance_details table for instance_details_id: ".$instance_details_id."\n";
                }

            }

            if($doIT) {
                try {
                    DB::table('action_cleanups')->insert([
                        'action_histories_id' => $action_histories_id,
                        'instance_details_id' => $instance_details_id,
                        'action' => $action,
                        'original_status' => $o_status,
                        'original_running_jenkins_job' => $o_rjj,
                        'original_created_at' => $o_created_at,
                        'original_updated_at' => $o_updated_at,
                        'notes' => $notes,
                        'created_at' => Carbon::now()
                        // 'updated_at' => Carbon::now()
                    ]);
                } catch (\Throwable $th) {
                    throw $th;
                }
            }

            $counter++;
        }
        echo $counter . " record updated. \n";
        Log::info("[command:actionhistories] ".$counter . " record(s) updated.");
    }
}
