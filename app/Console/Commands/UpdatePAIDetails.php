<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class UpdatePAIDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updatePAIDetails';

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
        $instances = DB::table('instance_details')->get();
        foreach ($instances as $inst) {
            if ($inst->is_hadoop_configured == 'Y') {

                $updated = DB::table('instance_details')->where('id', $inst->id)
                            ->update([
                                'pai_type' => "Hadoop",
                            ]);
                echo "YES " . $inst->id."\n";
            }
        }
    }
}
