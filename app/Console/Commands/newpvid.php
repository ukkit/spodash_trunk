<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class newpvid extends Command
{

    protected $signature = 'command:pvid';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $scriptID = '6uDh9i4FqPjfSUQ5XP7Mifx0Qgn9L8CHotGla8j7NvV4XxjlH9OlezKccJarHIvc'; //NOT TO BE CHANGED
        $doIT = True;

        function pvid_column($tablename,$unique) {
            echo " ------===>>>> Creating pvid column for table: $tablename\n";
            Schema::table($tablename, function (Blueprint $table) {
                $table->string('pv_id')->nullable()->change();
                $table->renameColumn('pv_id', 'old_pvid');
            });
            echo "\tDone with column rename \n";
            if ($unique) {
                Schema::table($tablename, function (Blueprint $table) {
                    $table->string('pv_id', 36)->after('old_pvid')->nullable()->unique();
                });
            } else {
                Schema::table($tablename, function (Blueprint $table) {
                    $table->string('pv_id', 36)->after('old_pvid')->nullable();
                });
            }

            echo "\tDone with adding pv_id column \n";
        }

        function gen_pvid($release, $build) {
            $strip_pvn = preg_replace("/[^0-9]/","",$release);
            $strip_pbn = preg_replace("/[^0-9]/","",$build);
            $pv_id = $strip_pvn."_".$strip_pbn;
            return ($pv_id);
        }

        function update_tables($tablename, $id, $old_pvid, $release, $build) {
            $pvid = gen_pvid($release, $build);
            DB::table($tablename)->where('id', $id)->update(['pv_id' => $pvid]);
            $inst = DB::table('instance_details')->where('pv_id',$old_pvid)->get();
            if($inst) {
                foreach ($inst as $in) {
                    DB::table('instance_details')->where('pv_id',$old_pvid)->update(['pv_id' => $pvid]);
                    echo "Changed pv_id for instance_details ".$in->id."\n";
                }
            }
        }

        $ote = DB::table('one_time_executions')->where('script_id', $scriptID)->first();

        if ($ote) {
            if ($ote->executed == 'N') {
                $ote->executed = 'Y';
                DB::table('one_time_executions')->where('script_id', $scriptID)->update($ote);
                $this->info('Executed');
            } else {
                $this->info('Already executed');
            }
            echo "Y \n";
        } else {
            echo "N \n";

            // product_versions & archive_product_versions
            try {
                echo "Starting with product_versions \n";
                Schema::table('product_versions', function (Blueprint $table) {
                    $table->dropUnique('product_versions_pv_id_unique');
                });
                pvid_column('product_versions', True);
                $pvsql = DB::table('product_versions')->get();
                foreach ($pvsql as $pvr) {
                    update_tables('product_versions', $pvr->id, $pvr->pv_id, $pvr->product_ver_number, $pvr->product_build_numer);
                }
                echo ".... completed product_versions \n";

                echo "Starting with archive_product_versions \n";
                pvid_column('archive_product_versions', False);
                $apvsql = DB::table('archive_product_versions')->get();
                foreach ($apvsql as $apv) {
                    update_tables('archive_product_versions', $apv->id, $apv->pv_id, $apv->product_ver_number, $apv->product_build_numer);
                }

                echo ".... completed archive_product_versions \n";
            } catch (\Throwable $th) {
                echo "SOMETHING WENT WRONG = product_versions \n";
                echo $th;
                $doIT = False;
            }

            // pai_builds & archive_pai_builds
            try {

                echo "Starting with pai_builds \n";
                pvid_column('pai_builds', True);
                $pbsql = DB::table('pai_builds')->get();
                foreach ($pbsql as $pvr) {
                    update_tables('pai_builds', $pvr->id, $pvr->pv_id, $pvr->pai_version, $pvr->pai_build);
                }
                echo "............ completed pai_builds \n";

                echo "Starting with archive_pai_builds \n";
                pvid_column('archive_pai_builds', False);
                $apbsql = DB::table('archive_pai_builds')->get();
                foreach ($apbsql as $pvr) {
                    update_tables('archive_pai_builds', $pvr->id, $pvr->pv_id, $pvr->pai_version, $pvr->pai_build);
                }
                echo "............ completed archive_pai_builds \n";

            } catch (\Throwable $th) {
                echo "SOMETHING WENT WRONG = pai_builds / archive_pai_builds \n";
                echo $th;
                $doIT = False;
            }

            // sf_builds & archive_sf_builds
            try {

                echo "Starting with sf_builds \n";
                Schema::table('sf_builds', function (Blueprint $table) {
                    $table->dropUnique('sf_builds_pv_id_unique');
                });
                pvid_column('sf_builds', True);

                $sfsql = DB::table('sf_builds')->get();
                foreach ($sfsql as $pvr) {
                    update_tables('sf_builds', $pvr->id, $pvr->pv_id, $pvr->sf_pai_version, $pvr->sf_pai_build);
                }
                echo ".... completed sf_builds \n";

                echo "Starting with archive_sf_builds \n";
                pvid_column('archive_sf_builds', True);
                $asfsql = DB::table('sf_builds')->get();
                foreach ($asfsql as $pvr) {
                    update_tables('archive_sf_builds', $pvr->id, $pvr->pv_id, $pvr->sf_pai_version, $pvr->sf_pai_build);
                }
                echo ".... completed archive_sf_builds \n";

            } catch (\Throwable $th) {
                echo "SOMETHING WENT WRONG = sf_builds \n";
                echo $th;
                $doIT = False;
            }

        }
        // echo $scriptID;
        if ($doIT) {
            DB::table('one_time_executions')->insert(['script_id' => $scriptID, 'executed' => 'Y', 'created_at'=>Carbon::now()]);
        }
    }
}
