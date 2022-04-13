<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use Log;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class getDBSize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getDBSize {id=all}';

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
        $dbid = $this->argument('id');
        $jarfile = public_path('jar/GetDBInformation.jar');
        Log::debug("set jar file path to" .$jarfile);
        $pass_counter = 1;
        $fail_counter = 1;
        $record_count = 1;

        if ( $dbid == "all") {
            Log::debug("Fetching database records for all active database details");
            $db_records = DB::table('database_details')->where('db_is_active',"Y")->whereNull('deleted_at')->get();
            $record_count = count($db_records);
            Log::debug("Record count ".$record_count);
        } else {
            Log::debug("Fetching database record for database details id ".$dbid);
            $db_records = DB::table('database_details')->where('id',$dbid)->where('db_is_active',"Y")->whereNull('deleted_at')->get();
        }

        Log::debug("Starting foreach loop");
        foreach ($db_records as $dbr) {
            $run_jar = true; //this will be false if jar is not be run
            $jar_variables = null;
            $server_name = DB::table('server_details')->where('id', $dbr->server_details_id)->value('server_name');
            $server_ip = DB::table('server_details')->where('id', $dbr->server_details_id)->value('server_ip');
            $dbt = DB::table('database_types')->where('id', $dbr->database_types_id)->value('db_short_name');
            $first_two = substr($dbt, 0, 2);

            if ($first_two == "MS") {
                $db_type = "MSSQL";
                $dba_user = $dbr->db_user;
                $dba_pass = $dbr->db_pass;
                $non_dba_user = "Null";
            } elseif ($first_two == "OR") {
                $db_type = "ORA";
                $dba_record = DB::table('dba_details')->where('server_details_id', $dbr->server_details_id)->where('db_sid',$dbr->db_sid)->first();
                try {
                    $dba_user = $dba_record->dba_user;
                } catch (\Throwable $th) {
                    $dba_user = null;
                    Log::error("DBA_USER not found for Database Details ID ".$dbr->id);
                }
                try {
                    $encrypted = $dba_record->dba_password;
                } catch (\Throwable $th) {
                    $encrypted = null;
                    Log::error("DBA_PASSWORD not found for Database Details ID ".$dbr->id);
                }
                try {
                    $dba_pass = Crypt::decryptString($encrypted);
                } catch (DecryptException $e) {
                    $dba_pass = null;
                    Log::error("Unable to decrypt password for DBD ID ".$dbr->id);
                }
                try {
                    $non_dba_user = $dbr->db_user;
                } catch (\Throwable $th) {
                    $non_dba_user = Null;
                }
            } else {
                $db_type = Null;
                $run_jar = False;
                Log::alert("Marking run_jar as false because db_type is incorrect for ID ".$dbr->id);
            }

            if ((is_null($dba_user)) || (is_null($dba_pass))) {
                // Log::error("dba_user, dba_pass or non_dba_user does not exists for ID ".$dbr->id);
                //
                $run_jar = False;
                Log::alert("Marking run_jar as false because dba_user/dba_password is blank for ID ".$dbr->id);
                $jar_variables = "FAILED FOR ".$dbr->id;
            }

            // echo " -----> ".$run_jar."\n";
            // Below will execute only if run_jar is true
            if($run_jar) {
                $jar_variables = $dbr->id." ".$db_type." ".$server_ip . " " .$dba_user . " ".$dba_pass." " .$dbr->db_sid ." " .$dbr->db_port ." " . $non_dba_user;

                // echo $jar_variables."\n";

                $jar_command = "java -jar ".$jarfile." ".$jar_variables;
                echo $jar_command ."\n";

                DB::table('database_details')->where('id', $dbr->id)->update(['data_gather_in_progress' => 'Y']);

                try {
                    // echo " inside try \n";
                    $retval = exec('java -jar '.$jarfile. ' '.$jar_variables);
                    // dd($retval);
                    if ($retval == "Success") {
                        echo "Success (".$pass_counter." / ".$record_count.")\n";
                        $pass_counter++;
                        Log::info($pass_counter."/".$record_count."} DB size details added for Database Details ID ".$dbr->id);
                    } else {
                        // echo $dbr->id." Failed \n";
                        echo  $dbr->id." Failed (".$pass_counter." / ".$record_count.")\n";
                        $fail_counter++;
                        Log::error($fail_counter."/".$record_count."} Unable to get database size for Database Details ID ".$dbr->id);
                    }
                } catch (\Throwable $th) {
                    Log::error("Unable to get database size for DBD_ID ". $dbr->id .", Error returned ".$th);
                }

                DB::table('database_details')->where('id', $dbr->id)->update(['data_gather_in_progress' => 'N']);

                // Checking for Check Fail Count for the database_details_id
                $cfc_data = DB::table('dbcheck_counts')->where('database_details_id', $dbr->id)->get();
                if (count($cfc_data) == 0) {
                    $cfc_data_count = 0;
                } else {
                    $cfc_data_count = count($cfc_data);
                }
            }
        }
        Log::debug("Foreach loop Ended");
        Log::info($pass_counter." records added to database and ".$fail_counter." failed");
    }
}
