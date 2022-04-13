<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use Log;

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

        $oldSPMData = DB::table($existingSPMTable)->where('is_release_build', 'N')->whereRaw('created_at < now() - interval 15 DAY')->get();
        $oldPAIData = DB::table($existingPAITable)->where('is_release_build', 'N')->whereRaw('created_at < now() - interval 15 DAY')->get();
        $oldSFData = DB::table($existingSFTable)->where('is_release_build', 'N')->whereRaw('created_at < now() - interval 15 DAY')->get();

        // echo count($oldData);

        // CODE FOR SPM PRODUCT VERSION TABLE
        foreach ($oldSPMData as $old) {
            $delete_record = True;
            $todayz = Carbon::now();
            try {
                DB::table($archiveSPMTable)->insert(['id' => Null,'product_versions_id' => $old->id, 'product_ver_number' => $old->product_ver_number, 'product_build_numer' => $old->product_build_numer, 'pv_id' => $old->pv_id, 'is_release_build' => $old->is_release_build, 'created_at' => $old->created_at, 'updated_at' => $old->updated_at, 'deleted_at' => $old->deleted_at, 'record_moved_to_archive_at' => $todayz]);
            } catch (\Exception $e) {
                echo $e->getMessage();
                $delete_record = False;
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

        // CODE FOR PAI VERSION TABLE
        foreach ($oldPAIData as $old2) {
            $delete_record = True;
            $todayz = Carbon::now();
            try {
                DB::table($archivePAITable)->insert(['id' => Null,'pai_builds_id' => $old2->id, 'pai_version' => $old2->pai_version, 'pai_build' => $old2->pai_build, 'pv_id' => $old2->pv_id, 'is_release_build' => $old2->is_release_build, 'created_at' => $old2->created_at, 'updated_at' => $old2->updated_at, 'deleted_at' => $old2->deleted_at, 'record_moved_to_archive_at' => $todayz]);
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

        // CODE FOR SF VERSION TABLE
        foreach ($oldSFData as $old3) {
            $delete_record = True;
            $todayz = Carbon::now();
            try {
                DB::table($archiveSFTable)->insert(['id' => Null,'sf_builds_id' => $old3->id, 'sf_pai_version' => $old3->sf_pai_version, 'sf_pai_build' => $old3->sf_pai_build, 'pv_id' => $old3->pv_id, 'is_release_build' => $old3->is_release_build, 'created_at' => $old3->created_at, 'updated_at' => $old3->updated_at, 'deleted_at' => $old3->deleted_at, 'record_moved_to_archive_at' => $todayz]);
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
    }
}
