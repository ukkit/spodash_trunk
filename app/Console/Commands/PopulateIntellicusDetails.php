<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;

class PopulateIntellicusDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:populateintellicus';

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
        $check_empty = DB::table('intellicus_details')->get();

        if (count($check_empty) == 0) {
            $instance_records = DB::table('instance_details')
                                ->select('id', 'instance_name', 'intellicus_url', 'intellicus_login', 'intellicus_passwd', 'intellicus_version')
                                ->whereNotNull('intellicus_url')
                                ->get();
            $int_ver = DB::table('intellicus_versions')->get();
            $ctr = 1;
            $int_ver_id = 1;
            $count = count($instance_records);
            foreach ($instance_records as $inst_rec) {
                $exp1 = explode('/', $inst_rec->intellicus_url);
                $exp2 = explode(':', $exp1[2]);
                $server = strtolower($exp2[0]);
                $port = $exp2[1];

                $first = $string = str_replace(' ', '', strtolower($inst_rec->intellicus_version));
                $exp3 = explode('patch', $first);

                // echo " ---".$server;
                $server1 = DB::table('server_details')
                                ->select('id')
                                ->where('server_name', strtolower($server))
                                ->get();
                // echo " ---".count($server1);
                if (count($server1) == 0) {
                    $server2 = DB::table('server_details')
                                ->select('id')
                                ->where('server_ip', $server)
                                ->get();
                    $server_id = $server2[0]->id;
                } else {
                    $server_id = $server1[0]->id;
                }

                foreach ($int_ver as $iv) {
                    $iv_ver = str_replace(' ', '', strtolower($iv->intellicus_version));
                    if ($iv_ver == $exp3[0]) {
                        $int_ver_id = $iv->id;
                    }
                }
                // echo $inst_rec->instance_name." | ".$exp3[0]." --- ";
                // dd($server1);
                if ($inst_rec->intellicus_version != null) {
                    DB::table('intellicus_details')->insert(
                        ['id' => $inst_rec->id, 'intellicus_name' => $inst_rec->instance_name, 'server_details_id' => $server_id, 'intellicus_versions_id' => $int_ver_id, 'intellicus_port' => $port, 'intellicus_login' => $inst_rec->intellicus_login, 'intellicus_pwd' => Crypt::encryptString($inst_rec->intellicus_passwd), 'intellicus_memory' => 16]);

                    DB::table('instance_details')->where('id', $inst_rec->id)->update(['intellicus_details_id' => $inst_rec->id]);
                }
                $ctr++;
            }
            echo $ctr.' recrods added to intellicus_details table';
        } else {
            echo 'This command will run only when intellicus_details table is empty';
        }
    }
}
