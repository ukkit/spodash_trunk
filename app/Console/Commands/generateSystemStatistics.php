<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use Log;
use Carbon\Carbon;

class generateSystemStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:generateSystemStats';

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
        $total_instance_details = DB::table('instance_details')->count();
        $active_instance_details = DB::table('instance_details')->where('instance_is_active','Y')->whereNull('deleted_at')->count();
        $deleted_instance_details = DB::table('instance_details')->whereNotNull('deleted_at')->count();
        $auto_upgrade_enabled_instances = DB::table('instance_details')->where('instance_is_auto_upgraded', 'Y')->whereNull('deleted_at')->count();

        $total_server_details = DB::table('server_details')->count();
        $active_server_details = DB::table('server_details')->where('server_is_active','Y')->whereNull('deleted_at')->count();
        $deleted_server_details = DB::table('server_details')->whereNotNull('deleted_at')->count();

        $total_database_details = DB::table('database_details')->count();
        $active_database_details = DB::table('database_details')->where('db_is_active','Y')->whereNull('deleted_at')->count();
        $deleted_database_details = DB::table('database_details')->whereNotNull('deleted_at')->count();

        $total_intellicus_details = DB::table('intellicus_details')->count();
        $deleted_intellicus_details = DB::table('intellicus_details')->whereNotNull('deleted_at')->count();

        $total_pai_details = DB::table('pai_details')->count();
        $deleted_pai_details = DB::table('pai_details')->whereNotNull('deleted_at')->count();

        $total_product_versions = DB::table('product_versions')->count();
        $deleted_product_versions = DB::table('product_versions')->whereNotNull('deleted_at')->count();
        $total_release_builds = DB::table('product_versions')->where('is_release_build', 'Y')->whereNull('deleted_at')->count();

        $total_users = DB::table('users')->count();
        // $deleted_user = DB::table('users')->whereNotNull('deleted_at')->count();

        $total_teams = DB::table('teams')->count();
        $deleted_teams = DB::table('teams')->whereNotNull('deleted_at')->count();

        $total_action_histories = DB::table('action_histories')->count();
        $deleted_action_histories = DB::table('action_histories')->whereNotNull('deleted_at')->count();

        $total_intellicus_versions = DB::table('intellicus_versions')->count();
        $deleted_intellicus_versions = DB::table('intellicus_versions')->whereNotNull('deleted_at')->count();

        $avengers_id = DB::table('teams')->select('id')->where('team_name', 'Avengers')->first();
        $avengers_instances = DB::table('instance_has_teams')->where('team_id', $avengers_id->id)->count();

        $dragons_id = DB::table('teams')->select('id')->where('team_name', 'Dragons')->first();
        $dragons_instances = DB::table('instance_has_teams')->where('team_id', $dragons_id->id)->count();

        $jl_id = DB::table('teams')->select('id')->where('team_name', 'Justice League')->first();
        $jl_instances = DB::table('instance_has_teams')->where('team_id', $jl_id->id)->count();

        $seekers_id = DB::table('teams')->select('id')->where('team_name', 'Seekers')->first();
        $seekers_instances = DB::table('instance_has_teams')->where('team_id', $seekers_id->id)->count();

        $guardians_id = DB::table('teams')->select('id')->where('team_name', 'Guardians')->first();
        $guardians_instances = DB::table('instance_has_teams')->where('team_id', $guardians_id->id)->count();

        $trans_id = DB::table('teams')->select('id')->where('team_name', 'Transformers')->first();
        $transformers_instances = DB::table('instance_has_teams')->where('team_id', $trans_id->id)->count();

        $pm_id = DB::table('teams')->select('id')->where('team_name', 'Product Managers')->first();
        $pm_instances = DB::table('instance_has_teams')->where('team_id', $pm_id->id)->count();

        $incred_id = DB::table('teams')->select('id')->where('team_name', 'Incredibles')->first();
        $incredibles_instances = DB::table('instance_has_teams')->where('team_id', $incred_id->id)->count();

        try {
            DB::table('system_statistics')->insertGetId(['total_instance_details' => $total_instance_details,
                                                        'active_instance_details' => $active_instance_details,
                                                        'deleted_instance_details' => $deleted_instance_details,
                                                        'auto_upgrade_enabled_instances' => $auto_upgrade_enabled_instances,
                                                        'total_server_details' => $total_server_details,
                                                        'active_server_details' => $active_server_details,
                                                        'deleted_server_details' => $deleted_server_details,
                                                        'total_database_details' => $total_database_details,
                                                        'active_database_details' => $active_database_details,
                                                        'deleted_database_details' => $deleted_database_details,
                                                        'total_intellicus_details' => $total_intellicus_details,
                                                        'deleted_intellicus_details' => $deleted_intellicus_details,
                                                        'total_pai_details' => $total_pai_details,
                                                        'deleted_pai_details' => $deleted_pai_details,
                                                        'total_product_versions' => $total_product_versions,
                                                        'deleted_product_versions' => $deleted_product_versions,
                                                        'total_release_builds' => $total_release_builds,
                                                        'total_users' => $total_users,
                                                        'total_teams' => $total_teams,
                                                        'deleted_teams' => $deleted_teams,
                                                        'total_action_histories' => $total_action_histories,
                                                        'deleted_action_histories' => $deleted_action_histories,
                                                        'total_intellicus_versions' => $total_intellicus_versions,
                                                        'deleted_intellicus_versions' => $deleted_intellicus_versions,
                                                        'avengers_instances' => $avengers_instances,
                                                        'dragons_instances' => $dragons_instances,
                                                        'jl_instances' => $jl_instances,
                                                        'seekers_instances' => $seekers_instances,
                                                        'guardians_instances' => $guardians_instances,
                                                        'transformers_instances' => $transformers_instances,
                                                        'pm_instances' => $pm_instances,
                                                        'incredibles_instances' => $incredibles_instances,
                                                        'created_at' => now() ]);
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }

    }
}
