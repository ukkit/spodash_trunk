<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\actionHistory;
use DB;
use Carbon\Carbon;

class UpdateActionHistoriesTable extends Command
{

    protected $signature = 'command:actionhistories';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $scriptID = '8kA2mWiWrJVGUPufbha4rmkcGdnvZjEhEaUnkJbzCfhWuSnj2QTTt3rTKRJyCf3G'; //NOT TO BE CHANGED
        // echo "I'm Here";
        // $actions = Action_history::whereNull('end_time')->count();
        $actions = DB::table('action_histories')
                    ->whereNull('end_time')
                    ->whereDate('start_time', '<', Carbon::now()->sub('hour', 1))
                    ->get();
        $counter = 0;

        dd($actions);
        $now = Carbon::now();

        foreach ($actions as $action) {
            // echo $action->id."\n";
            $affected = DB::table('action_histories')
                        ->where('id', $action->id)
                        ->update([
                            'status' => "Scheduler",
                            'end_time'=> $now,
                            'updated_at'=> $now,
                            ]);
            $counter++;
        }
        echo $counter . " record updated. \n";
    }
}
