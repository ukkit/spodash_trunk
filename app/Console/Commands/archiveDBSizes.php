<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;
use Log;

class archiveDBSizes extends Command
{

    protected $signature = 'command:archiveDBSizes';

    protected $description = 'Command description';

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
        $existingTable = 'db_sizes';
        $archiveTable = 'archive_db_sizes';
        $SQL = "CREATE TABLE IF NOT EXISTS $archiveTable  (
            id int(11) NOT NULL AUTO_INCREMENT,
            db_sizes_id INT(11),
            database_details_id INT(11),
            db_creation_date timestamp,
            db_access_datetime timestamp NULL,
            db_size INT(11) NULL,
            db_temp_size INT(11) NULL,
            tablespace_name VARCHAR(100) NULL,
            tablespace_used INT(11) NULL,
            tablespace_free INT(11) NULL,
            temp_tablespace_name VARCHAR(100) NULL,
            temp_tablespace_used INT(11) NULL,
            temp_tablespace_free INT(11) NULL,
            created_at timestamp NULL,
            updated_at timestamp NULL,
            deleted_at timestamp NULL,
            record_moved_to_archive_at timestamp NULL,
            CONSTRAINT pk_archive_db_sizes PRIMARY KEY (id, db_sizes_id)
            )";

        DB::statement($SQL);

        $oldData = DB::table($existingTable)->whereRaw('created_at < now() - interval 60 DAY')->get();

        foreach ($oldData as $old) {
            $delete_record = True;
            $todayz = Carbon::now();

            try {
                DB::table($archiveTable)->insert(['id' => Null,'db_sizes_id' => $old->id, 'database_details_id' => $old->database_details_id, 'db_creation_date' => $old->db_creation_date, 'db_access_datetime' => $old->db_access_datetime, 'db_size' => $old->db_size, 'db_temp_size' => $old->db_temp_size, 'tablespace_name' => $old->tablespace_name, 'tablespace_used' => $old->tablespace_used, 'tablespace_free' => $old->tablespace_free, 'temp_tablespace_name' => $old->temp_tablespace_name, 'temp_tablespace_used' => $old->temp_tablespace_used, 'temp_tablespace_free' => $old->temp_tablespace_free,'created_at' => $old->created_at, 'updated_at' => $old->updated_at, 'deleted_at' => $old->deleted_at, 'record_moved_to_archive_at' => $todayz]);
            } catch (\Exception $e) {
                echo $e->getMessage();
                $delete_record = False;
            }

            if($delete_record) {
                try {
                    DB::table($existingTable)->where('id', $old->id)->delete();
                    echo "Record archived for $existingTable ID " . $old->id . "\n";
                } catch (\Throwable $th) {
                    echo "Unable to archive record for $existingTable ID " . $old->id . ", hence removing record from $archiveTable also.\n";
                    DB::table($archiveTable)->where('product_versions_id', $old->id)->delete();
                }
            }
        }

    }
}
