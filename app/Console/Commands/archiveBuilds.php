<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use Log;
use Artisan;

class archiveBuilds extends Command
{
    protected $signature = 'command:archiveBuild';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $existingSPMTable = 'product_versions';
        $archiveSPMTable = 'archive_product_versions';
        $existingPAITable = 'pai_builds';
        $archivePAITable = 'archive_pai_builds';
        $existingSFTable = 'sf_builds';
        $archiveSFTable = 'archive_sf_builds';
        $archiveTable1 = "CREATE TABLE IF NOT EXISTS $archiveSPMTable  (
            id int(11) NOT NULL AUTO_INCREMENT,
            product_versions_id INT(11),
            product_ver_number varchar(50),
            product_build_numer INT(11),
            pv_id varchar(50),
            old_pvid varchar(50),
            is_release_build char(1),
            created_at timestamp NULL,
            updated_at timestamp NULL,
            deleted_at timestamp NULL,
            record_moved_to_archive_at timestamp NULL,
            CONSTRAINT pk_product_versions_id PRIMARY KEY (id,product_versions_id)
            )";
        $archiveTable2 = "CREATE TABLE IF NOT EXISTS $archivePAITable  (
            id int(11) NOT NULL AUTO_INCREMENT,
            pai_builds_id INT(11),
            pai_version varchar(50),
            pai_build INT(11),
            pv_id varchar(50),
            old_pvid varchar(50),
            is_release_build char(1),
            created_at timestamp NULL,
            updated_at timestamp NULL,
            deleted_at timestamp NULL,
            record_moved_to_archive_at timestamp NULL,
            CONSTRAINT pk_product_versions_id PRIMARY KEY (id,pai_builds_id)
            )";
        $archiveTable3 = "CREATE TABLE IF NOT EXISTS $archiveSFTable  (
            id int(11) NOT NULL AUTO_INCREMENT,
            sf_builds_id INT(11),
            sf_pai_version varchar(50),
            sf_pai_build INT(11),
            pv_id varchar(50),
            old_pvid varchar(50),
            is_release_build char(1),
            created_at timestamp NULL,
            updated_at timestamp NULL,
            deleted_at timestamp NULL,
            record_moved_to_archive_at timestamp NULL,
            CONSTRAINT pk_product_versions_id PRIMARY KEY (id,sf_builds_id)
            )";

        DB::statement($archiveTable1);
        DB::statement($archiveTable2);
        DB::statement($archiveTable3);

        function id_to_pvid($id, $type) {
            if ($type == "SPM") {
                $sql = DB::table('product_versions')->select('pv_id')->where('id',$id)->first();
                if(empty($sql)) {
                    $sql2 = DB::table('archive_product_versions')->select('pv_id')->where('id',$id)->first();
                    $rv = $sql2->pv_id;
                } else {
                    $rv = $sql->pv_id;
                }
            } elseif ($type == "PAI") {
                $sql = DB::table('pai_builds')->select('pv_id')->where('id',$id)->first();
                if(empty($sql)) {
                    $sql2 = DB::table('archive_pai_builds')->select('pv_id')->where('id',$id)->first();
                    $rv = $sql2->pv_id;
                } else {
                    $rv = $sql->pv_id;
                }
            } elseif ($type == "SF") {
                $sql = DB::table('sf_builds')->select('pv_id')->where('id',$id)->first();
                if(empty($sql)) {
                    $sql2 = DB::table('archive_sf_builds')->select('pv_id')->where('id',$id)->first();
                    $rv = $sql2->pv_id;
                } else {
                    $rv = $sql->pv_id;
                }
            }
            echo $rv."\n";
            return $rv;
        }

        $spm_moved = 0;
        $pai_moved = 0;
        $sf_moved = 0;

        $oldSPMData = DB::table($existingSPMTable)->where('is_release_build', 'N')->whereRaw('created_at < now() - interval 15 DAY')->get();
        $spm_rec_count = count($oldSPMData);
        $oldPAIData = DB::table($existingPAITable)->where('is_release_build', 'N')->whereRaw('created_at < now() - interval 15 DAY')->get();
        $pai_rec_count = count($oldPAIData);
        $oldSFData = DB::table($existingSFTable)->where('is_release_build', 'N')->whereRaw('created_at < now() - interval 15 DAY')->get();
        $sf_rec_count = count($oldSFData);

        // CHECKING IF RECORD IS NOT USED IN INSTANCE_DETAILS OR ACTIONS_HISTORIES TABLE
        $pvid_array = array();
        $sf_pvid_array = array();
        $pai_pvid_array = array();

        $instD_pv_id = DB::table('instance_details')->select('pv_id')->whereNotNull('pv_id')->get();
        $instD_pai_pv_id = DB::table('instance_details')->select('pai_pv_id')->whereNotNull('pai_pv_id')->get();
        $instD_sf_pv_id = DB::table('instance_details')->select('sf_pv_id')->whereNotNull('sf_pv_id')->get();
        $ahsql = DB::table('action_histories')->get();

        foreach ($instD_pv_id as $key => $value) {
            array_push($pvid_array, trim($value->pv_id));
        }
        foreach ($instD_pai_pv_id as $key => $value) {
            array_push($pai_pvid_array, trim($value->pai_pv_id));
        }
        foreach ($instD_sf_pv_id as $key => $value) {
            array_push($sf_pvid_array, trim($value->sf_pv_id));
        }
        foreach ($ahsql as $key => $value) {
            // array_push($ah_pv_id_array, trim($value->pv_id));
            if ($value->old_build_id) {
                echo "Old Build ID: ".$value->old_build_id." | ";
                $old_pvid = id_to_pvid(trim($value->old_build_id), "SPM");
                array_push($pvid_array, trim($old_pvid));
            }
            if ($value->new_build_id) {
                echo "New  Build ID: ".$value->new_build_id." | ";
                $new_pvid = id_to_pvid(trim($value->new_build_id), "SPM");
                array_push($pvid_array, trim($new_pvid));
            }

            if ($value->old_pai_build_id) {
                echo "Old PAI Build ID: ".$value->old_pai_build_id." | ";
                $old_pai_pvid = id_to_pvid($value->old_pai_build_id, "PAI");
                array_push($pai_pvid_array, trim($old_pai_pvid));
            }
            if ($value->new_pai_build_id) {
                echo "New PAI Build ID: ".$value->new_pai_build_id." | ";
                $new_pai_pvid = id_to_pvid($value->new_pai_build_id, "PAI");
                array_push($pai_pvid_array, trim($new_pai_pvid));
            }

            if ($value->old_sf_build_id) {
                $old_sf_pvid = id_to_pvid($value->old_sf_build_id, "SF");
                array_push($sf_pvid_array, trim($old_sf_pvid));
            }
            if ($value->new_sf_build_id) {
                $new_sf_pvid = id_to_pvid($value->new_sf_build_id, "SF");
                array_push($sf_pvid_array, trim($new_sf_pvid));
            }
        }
        $pvid_array = array_unique($pvid_array);
        $pai_pvid_array = array_unique($pai_pvid_array);
        $sf_pvid_array = array_unique($sf_pvid_array);

        // dd($pvid_array);

        // CODE FOR SPM PRODUCT VERSION TABLE
        foreach ($oldSPMData as $old) {
            $delete_record = False;
            if(!in_array($old->pv_id, $pvid_array)) {
                try {
                    $todayz = Carbon::now();
                    DB::table($archiveSPMTable)->insert(['id' => Null,'product_versions_id' => $old->id, 'product_ver_number' => $old->product_ver_number, 'product_build_numer' => $old->product_build_numer, 'old_pvid' => $old->old_pvid, 'pv_id' => $old->pv_id, 'is_release_build' => $old->is_release_build, 'created_at' => $old->created_at, 'updated_at' => $old->updated_at, 'deleted_at' => $old->deleted_at, 'record_moved_to_archive_at' => $todayz]);
                    $delete_record = True;
                    $spm_moved++;
                } catch (\Throwable $th) {
                    echo $e->getMessage();
                }
            }

            if($delete_record) {
                try {
                    DB::table($existingSPMTable)->where('id', $old->id)->delete();
                    echo "Record archived for $existingSPMTable ID " . $old->id . "\n";
                } catch (\Throwable $th) {
                    echo "Unable to archive record for $existingSPMTable ID " . $old->id . ", hence removing record from $archiveSPMTable also.\n";
                    DB::table($archiveSPMTable)->where('product_versions_id', $old->id)->delete();
                }
            }
        }

        echo "SPM - Total: ".$spm_rec_count." | Moved: ".$spm_moved."\n";
        // dd(count($pvid_array), count($pai_pvid_array), count($sf_pvid_array));

        // CODE FOR PAI VERSION TABLE
        foreach ($oldPAIData as $old2) {
            $delete_record = False;
            try {
                if (in_array($old2->pv_id, $pai_pvid_array)) {
                    $delete_record = False;
                    // As the pai_pv_id is present in instance_details or action_histories table, so we will not move the record from product_versions table
                } else {
                    $todayz = Carbon::now();
                    DB::table($archivePAITable)->insert(['id' => Null,'pai_builds_id' => $old2->id, 'pai_version' => $old2->pai_version, 'pai_build' => $old2->pai_build, 'pv_id' => $old2->pv_id, 'old_pvid' => $old2->old_pvid, 'is_release_build' => $old2->is_release_build, 'created_at' => $old2->created_at, 'updated_at' => $old2->updated_at, 'deleted_at' => $old2->deleted_at, 'record_moved_to_archive_at' => $todayz]);
                    $delete_record = True;
                    $pai_moved++;
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
                $delete_record = False;
            }

            if($delete_record) {
                try {
                    DB::table($existingPAITable)->where('id', $old2->id)->delete();
                    echo "Record archived for $existingPAITable ID " . $old2->id . "\n";
                } catch (\Throwable $th) {
                    echo "Unable to archive record for $existingPAITable ID " . $old2->id . ", hence removing record from $archivePAITable also.\n";
                    DB::table($archivePAITable)->where('pai_builds_id', $old2->id)->delete();
                }
            }
        }

        echo "PAI - Total: ".$pai_rec_count." | Moved: ".$pai_moved."\n";
        // CODE FOR SF VERSION TABLE
        foreach ($oldSFData as $old3) {
            $delete_record = True;

            try {
                if (in_array($old3->pv_id, $sf_pvid_array)) {
                    $delete_record = False;
                    // As the sf_pv_id is present in instance_details or action_histories table, so we will not move the record from product_versions table
                } else {
                    $todayz = Carbon::now();
                    DB::table($archiveSFTable)->insert(['id' => Null,'sf_builds_id' => $old3->id, 'sf_pai_version' => $old3->sf_pai_version, 'sf_pai_build' => $old3->sf_pai_build, 'pv_id' => $old3->pv_id, 'old_pvid' => $old3->old_pvid, 'is_release_build' => $old3->is_release_build, 'created_at' => $old3->created_at, 'updated_at' => $old3->updated_at, 'deleted_at' => $old3->deleted_at, 'record_moved_to_archive_at' => $todayz]);
                    $delete_record = True;
                    $sf_moved++;
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
                $delete_record = False;
            }

            if($delete_record) {
                try {
                    DB::table($existingSFTable)->where('id', $old3->id)->delete();
                    echo "Record archived for $existingSFTable ID " . $old3->id . "\n";
                } catch (\Throwable $th) {
                    echo "Unable to archive record for $existingSFTable ID " . $old3->id . ", hence removing record from $archiveSFTable also.\n";
                    DB::table($archiveSFTable)->where('sf_builds_id', $old3->id)->delete();
                }
            }
        }
        echo "SF - Total: ".$pai_rec_count." | Moved: ".$pai_moved."\n";
        Artisan::call('command:unarchiveBuild');
    }
}
