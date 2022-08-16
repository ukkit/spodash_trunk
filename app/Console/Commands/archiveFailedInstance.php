<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class archiveFailedInstance extends Command
{
    protected $signature = 'command:archiveFI';

    protected $description = 'This command move records older than 30 days in failed_instance_histories table to archive_fi_histories table';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $existingTable = 'failed_instance_histories';
        $archiveTable = 'archive_fi_histories';
        $SQL = "CREATE TABLE IF NOT EXISTS $archiveTable  (
            id int(11) NOT NULL AUTO_INCREMENT,
            failed_instance_histories_id INT(11),
            instance_details_id INT(11),
            created_at timestamp NULL,
            updated_at timestamp NULL,
            deleted_at timestamp NULL,
            record_moved_to_archive_at timestamp NULL,
            CONSTRAINT pk_archive_fi_histories PRIMARY KEY (id, failed_instance_histories_id)
            )";

        DB::statement($SQL);

        $oldData = DB::table($existingTable)->whereRaw('created_at < now() - interval 60 DAY')->get();

        foreach ($oldData as $old) {
            $delete_record = true;
            $todayz = Carbon::now();

            try {
                DB::table($archiveTable)->insert(['id' => null, 'failed_instance_histories_id' => $old->id, 'instance_details_id' => $old->instance_details_id, 'created_at' => $old->created_at, 'updated_at' => $old->updated_at, 'deleted_at' => $old->deleted_at, 'record_moved_to_archive_at' => $todayz]);
            } catch (\Exception $e) {
                echo $e->getMessage();
                $delete_record = false;
            }

            if ($delete_record) {
                try {
                    DB::table($existingTable)->where('id', $old->id)->delete();
                    echo "Record archived for $existingTable ID ".$old->id."\n";
                } catch (\Throwable $th) {
                    echo "Unable to archive record for $existingTable ID ".$old->id.", hence removing record from $archiveTable also.\n";
                    DB::table($archiveTable)->where('product_versions_id', $old->id)->delete();
                }
            }
        }
    }
}
