<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use Log;
use Schema;

class paiDetailsToDBDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:pai2DBD';

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
        if (Schema::hasTable('pai_details')) {
            $pairec = DB::table('pai_details')->get();
            // foreach;
            $err_count = 0;

            foreach ($pairec as $record) {
                $value = DB::table('server_details')->where('id', $record->server_details_id)->get()->first();
                $stripped_ip = str_replace('.', '', $value->server_ip);
                $lower_dbsid = strtolower($record->pai_db);
                $stripped_dbsid = str_replace('_', '', $lower_dbsid);
                $stripped_dbsid = str_replace('-', '', $stripped_dbsid);
                $lower_dbuser = strtolower($record->pai_user);
                $stripped_dbuser = str_replace('_', '', $lower_dbuser);
                $stripped_dbuser = str_replace('-', '', $stripped_dbuser);

                $dbd_id = $stripped_ip.'_'.$stripped_dbsid.'_'.$stripped_dbuser;

                $gen_dbd_id = null;
                $database_types_id = $value->database_types_id;
                $created_at = Carbon::now()->subDay();

                try {
                    DB::table('database_details')->insert(['id' => null, 'gen_dbd_id' => $dbd_id, 'server_details_id' => $record->server_details_id, 'database_types_id' => $database_types_id, 'ambari_details_id' => $record->ambari_details_id, 'db_sid' => $record->pai_db, 'db_user' => $record->pai_user, 'db_pass' => Crypt::decryptString($record->pai_pwd), 'db_port' => $record->pai_port, 'repository_type' => 'PAI', 'created_at' => $created_at, 'updated_at' => $created_at]);
                    $insertedid = DB::getPdo()->lastInsertId();
                    Log::info('Record moved from PAI Details ID '.$record->id.' to Database Details ID '.$insertedid);

                    $affected = DB::table('instance_details')
                    ->where('old_pai_details_id', $record->id)
                    ->update([
                        'pai_details_id' => $insertedid,
                        'updated_at' => $created_at,
                    ]);

                    // echo "Added ".$record->id. "New ID ". $insertedid. "\n";
                    Log::info('Record updated in Instance Detail for old_pai_details_id '.$record->id.' to pai_details_id '.$insertedid);
                } catch (\Throwable $th) {
                    Log::error('Unable to insert/update record Error returned '.$th);
                    $err_count++;
                }
            }
            if ($err_count == 0) {
                Schema::rename('pai_details', 'redacted_pai_details');
                Log::info('pai_details table renamed to redacted_pai_details');
            } else {
                Log::error('pai_details table not renamed due to error count '.$err_count);
            }
        }
    }
}
