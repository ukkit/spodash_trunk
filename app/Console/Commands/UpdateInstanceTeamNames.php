<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;

class UpdateInstanceTeamNames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:updateinstanceteamnames';

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
        $teams = DB::table('teams')->get();
        $tablename = 'instance_has_teams';
        $bk_table = now()->format('T_YmdHisu');
        DB::statement('CREATE TABLE '.$bk_table.' LIKE instance_has_teams');
        DB::statement('INSERT '.$bk_table.' SELECT * FROM instance_has_teams');

        // dd($tablename);
        $ctr = 0;
        foreach ($teams as $team) {
            switch ($team->team_name) {
                case 'All':
                    // $all_teams = DB::table('instance_details')->select('id')->whereNull('instance_owner')->orWhere('instance_owner','SPM-All')->get();
                    $all_teams = DB::table('instance_details')->select('id')->where('instance_owner', 'SPM-All')->get();
                    foreach ($all_teams as $all) {
                        DB::table($tablename)->insert(
                            ['instance_id' => $all->id, 'team_id' => $team->id]
                        );
                        $ctr++;
                    }
                    break;
                case 'Product Managers':
                    $pm_team = DB::table('instance_details')->select('id')->where('instance_owner', 'like', 'Product Managers')->get();
                    foreach ($pm_team as $all) {
                        DB::table($tablename)->insert(
                            ['instance_id' => $all->id, 'team_id' => $team->id]
                        );
                        $ctr++;
                    }
                    break;
                case 'Avengers':
                    $avengers = DB::table('instance_details')->select('id')->where('instance_owner', 'like', 'SPO-Avengers')->get();
                    foreach ($avengers as $all) {
                        DB::table($tablename)->insert(
                            ['instance_id' => $all->id, 'team_id' => $team->id]
                        );
                        $ctr++;
                    }
                    break;
                case 'Incredibles':
                    $incredibles = DB::table('instance_details')->select('id')->where('instance_owner', 'like', 'SPO-Incredibles')->get();
                    foreach ($incredibles as $all) {
                        DB::table($tablename)->insert(
                            ['instance_id' => $all->id, 'team_id' => $team->id]
                        );
                        $ctr++;
                    }
                    break;
                case 'Justice League':
                    $justleag = DB::table('instance_details')->select('id')->where('instance_owner', 'like', 'SPO-JusticeLeave')->get();
                    foreach ($justleag as $all) {
                        DB::table($tablename)->insert(
                            ['instance_id' => $all->id, 'team_id' => $team->id]
                        );
                        $ctr++;
                    }
                    break;
                case 'Transformers':
                    $transformers = DB::table('instance_details')->select('id')->where('instance_owner', 'like', 'SPO-Transformers')->get();
                    foreach ($transformers as $all) {
                        DB::table($tablename)->insert(
                            ['instance_id' => $all->id, 'team_id' => $team->id]
                        );
                        $ctr++;
                    }
                    break;
                case 'Dragons':
                    $dragons = DB::table('instance_details')->select('id')->where('instance_owner', 'like', 'SPO-Dragons')->get();
                    foreach ($dragons as $all) {
                        DB::table($tablename)->insert(
                            ['instance_id' => $all->id, 'team_id' => $team->id]
                        );
                        $ctr++;
                    }
                    break;
                case 'Seekers':
                    $seekers = DB::table('instance_details')->select('id')->where('instance_owner', 'like', '	SPO-Seekers')->get();
                    foreach ($seekers as $all) {
                        DB::table($tablename)->insert(
                            ['instance_id' => $all->id, 'team_id' => $team->id]
                        );
                        $ctr++;
                    }
                    break;
                case 'Guardians':
                    $guardians = DB::table('instance_details')->select('id')->where('instance_owner', 'like', 'SPO-Guardians')->get();
                    foreach ($guardians as $all) {
                        DB::table($tablename)->insert(
                            ['instance_id' => $all->id, 'team_id' => $team->id]
                        );
                        $ctr++;
                    }
                    break;
            }
            // dd($instance);
        }
        // dd($all_teams);
        echo $ctr.' records added.';
    }
}
