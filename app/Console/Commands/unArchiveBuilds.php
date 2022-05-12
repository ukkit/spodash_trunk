<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;

class unArchiveBuilds extends Command
{
    protected $signature = 'command:unarchiveAll';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $scriptID = 'tax7i8WhVW47eU4ALprWAiuemcPhkUhdyXQbKbXWCXX6inh82WSCygVtv4wmrpVG'; //NOT TO BE CHANGED
        $scriptname = 'unarchiveAll'; //NOT TO BE CHANGED

        Artisan::call('command:unarchiveSPM');
        Artisan::call('command:unarchivePAI');
        Artisan::call('command:unarchiveSF');

        DB::table('command_histories')->insert(['script_id' => $scriptID, 'script_name' => $scriptname, 'created_at' => Carbon::now()]);
    }
}
