<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\actionHistory;
use DB;
use Carbon\Carbon;

class UpdateActionHistoriesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:actionhistories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // echo "I'm Here";
        // $actions = Action_history::whereNull('end_time')->count();
        $actions = DB::table('action_histories')
                    ->whereNull('end_time')
                    ->whereDate('start_time', '<', Carbon::now()->sub('hour', 2))
                    ->get();
        $counter = 0;

        // dd($actions);
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
