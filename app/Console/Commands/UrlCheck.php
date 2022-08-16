<?php

namespace App\Console\Commands;

use App\Mail\UrlFailed;
use DB;
use Illuminate\Console\Command;
use Log;
use Mail;

class UrlCheck extends Command
{
    protected $signature = 'command:urlCheck {id=all} {--intellicus} {--instance}';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    private function get_http_response_code($theURL)
    {
        $headers = get_headers($theURL);

        return substr($headers[0], 9, 3);
    }

    private function url_test($url)
    {
        $timeout = 15; // INCREASED THIS TO 15 FROM 10
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $http_respond = curl_exec($ch);
        $http_respond = trim(strip_tags($http_respond));
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (($http_code == '200') || ($http_code == '302')) {
            return 'PASS';
        } else {
            // you can return $http_code here if necessary or wanted
            return 'FAIL';
        }
        curl_close($ch);
    }

    public function handle()
    {
        $id = $this->argument('id');
        $runfor = 'all';
        $run_intellicus = $this->option('intellicus');
        $run_instance = $this->option('instance');
        $intellicus_data = null;
        $instance_data = null;

        if (empty($run_instance) && empty($run_intellicus)) {
            // echo "Inside run_both \n";
            $intellicus_data = $this->intellicus_data($id);
            $instance_data = $this->instance_data($id);
        } elseif (! empty($run_intellicus)) {
            // echo "Inside run_intellicus with id $id \n";
            $intellicus_data = $this->intellicus_data($id);
        } else {
            // echo "Inside run_instance \n";
            $instance_data = $this->instance_data($id);
        }

        if (! empty($instance_data)) {
            if ($id == 'all') {
                foreach ($instance_data as $inst) {
                    $return = $this->check_instance($inst);
                }
            } else {
                $return = $this->check_instance($instance_data);
            }
        }

        if (! empty($intellicus_data)) {
            if ($id == 'all') {
                foreach ($intellicus_data as $intell) {
                    $return = $this->check_intellicus($intell);
                }
            } else {
                $return = $this->check_intellicus($intellicus_data);
            }
        }
    }

    private function instance_data($id)
    {
        if ($id == 'all') {
            try {
                $data = DB::table('instance_details')->where('instance_is_active', 'Y')->whereNull('deleted_at')->get();
            } catch (\Throwable $th) {
                $data = null;
            }
        } else {
            try {
                $data = DB::table('instance_details')->where('id', $id)->where('instance_is_active', 'Y')->whereNull('deleted_at')->first();
            } catch (\Throwable $th) {
                $data = null;
            }
        }

        return $data;
    }

    private function intellicus_data($id)
    {
        // echo "Inside intellicus_Dats with ID".$id."\n";
        if ($id == 'all') {
            try {
                $data = DB::table('intellicus_details')->where('is_active', 'Y')->whereNull('deleted_at')->get();
            } catch (\Throwable $th) {
                $data = null;
            }
        } else {
            try {
                $data = DB::table('intellicus_details')->where('id', $id)->where('is_active', 'Y')->whereNull('deleted_at')->first();
            } catch (\Throwable $th) {
                $data = null;
            }
        }

        return $data;
    }

    private function check_instance($record)
    {
        try {
            $server = DB::table('server_details')->where('id', $record->server_details_id)->first();
        } catch (\Throwable $th) {
            Log::error('Unable to find server details for instance ID '.$record->id);
            $server = null;
        }

        if (! empty($server)) {
            if ($record->is_https == 'Y') {
                $http_tag = 'https';
            } else {
                $http_tag = 'http';
            }
            $_url = $http_tag.'://'.$server->server_ip.':'.$record->instance_tomcat_port.'/WebUI/';
            $generated = filter_var($_url, FILTER_SANITIZE_URL);

            $check = $this->url_test($generated);
            $build_update = DB::table('instance_details')->select('running_jenkins_job')->where('id', $record->id)->first();

            try {
                $response_code = $this->get_http_response_code($generated);
            } catch (\Throwable $th) {
                $response_code = 0;
            }

            echo 'INS ID: '.$record->id.' | RC: '.$response_code;

            try {
                $fail_count_from_db = $record->check_fail_count;
            } catch (\Throwable $th) {
                $fail_count_from_db = 0;
            }

            if ($check == 'FAIL') {
                if ($build_update->running_jenkins_job == 'Y') {
                    Log::info('Found running_jenkins_job as Y for instance id '.$record->id.' hence not adding to Failure list');
                } else {
                    $this->add_failure($record->id, 'INS', $fail_count_from_db, $generated);
                    echo ' « FAIL | '.$generated."\n";
                }
            } else {
                $this->remove_failure($record->id, 'INS');
                echo " » PASS \n";
            }
        }

        return $check;
    }

    private function check_intellicus($record)
    {
        try {
            $server = DB::table('server_details')->where('id', $record->server_details_id)->first();
        } catch (\Throwable $th) {
            Log::error('Unable to find server details for intellicus ID '.$record->id);
            $server = null;
        }

        try {
            $fail_count_from_db = $record->check_fail_count;
        } catch (\Throwable $th) {
            $fail_count_from_db = 0;
        }

        if (! empty($server)) {
            $generated = 'http://'.$server->server_ip.':'.$record->intellicus_port.'/intellicus';
            $check = $this->url_test($generated);

            try {
                $response_code = $this->get_http_response_code($generated);
            } catch (\Throwable $th) {
                $response_code = 0;
            }

            echo 'INT ID: '.$record->id.' | RC: '.$response_code;

            if ($check == 'FAIL') {
                $this->add_failure($record->id, 'INT', $fail_count_from_db, $generated);
                echo " « FAIL \n";
            } else {
                $this->remove_failure($record->id, 'INT');
                echo " » PASS \n";
            }
        }

        return $check;
    }

    private function add_failure($id, $type, $fail_count_from_db, $generated)
    {
        // First check if record exists for ID and TYPE
        $instance_id = null;
        $intellicus_id = null;
        $updated_at = now();
        $mail_data = ['id_number' => null, 'type' => null, 'failcount' => null, 'url' => null, 'at_time' => $updated_at, 'subject' => null];

        try {
            if ($type == 'INS') {
                $record = DB::table('url_checks')->where('instance_details_id', $id)->first();
                $instance_id = $id;
                $mail_type = 'Instance';
                $mail_data['subject'] = "SPO-Dashboard: URL check failed for Instance ID $id";
            } else {
                $record = DB::table('url_checks')->where('intellicus_details_id', $id)->first();
                $intellicus_id = $id;
                $mail_type = 'Intellicus';
                $mail_data['subject'] = "SPO-Dashboard: URL check failed for Intellicus ID $id";
            }
        } catch (\Throwable $th) {
            // echo $th;
            $record = null;
        }

        // If not exists then add the record with fail_count as 1
        if (empty($record)) {
            try {
                DB::Table('url_checks')->insert([
                    ['instance_details_id' => $instance_id, 'intellicus_details_id' => $intellicus_id, 'fail_count' => 1, 'created_at' => $updated_at],
                ]);
            } catch (\Throwable $th) {
                echo 'Unable to add Record for instance_id '.$instance_id.' or intellicus_id '.$intellicus_id;
            }
            $mail_data = null;
        } else {
            $fail_count = $record->fail_count;

            // If record exists then increment the fail_count by 1
            $fail_count++;
            DB::table('url_checks')->where('id', $record->id)->update(['fail_count' => $fail_count, 'updated_at' => $updated_at]);
            echo ' | FC: '.$fail_count.' | FC_DB: '.$fail_count_from_db;

            if ($fail_count_from_db > 0 && $fail_count >= $fail_count_from_db) { // IF FAIL_COUNT FROM DB IS 0 (ZERO) THEN DONT SEND EMAIL
                $mail_data['id_number'] = $id;
                $mail_data['type'] = $mail_type;
                $mail_data['failcount'] = $fail_count;
                $mail_data['url'] = $generated;
                $mail_data['at_time'] = date('m-d-Y');
            } else {
                $mail_data = null;
            }
        }

        // dd($mail_data);
        if (! empty($mail_data)) {
            try {
                echo ' EMAIL ';
                $mail_sent = 'Y';
                $email = new UrlFailed($mail_data);
                Mail::to('spo-incredibles@ptc.com')->send($email);
                // Mail::to('ntikku@ptc.com')->send($email);
                echo ' | WILL BE SENDING EMAIL ';
            } catch (\Throwable $th) {
                // echo "Unable to send email ".$th;
                $mail_sent = 'N';
            }

            if ($mail_sent == 'Y') {
                // The logic below is that once email is sent, reset fail_count to 0 so that next mail is sent based on fail_count_from_db
                DB::table('url_checks')->where('id', $record->id)->update(['fail_count' => 0, 'email_sent_date' => date('Y-m-d'), 'updated_at' => $updated_at]);
            }
        } else {
            echo ' | NO EMAIL ';
        }
    }

    private function remove_failure($id, $type)
    {
        // As URL is active, we will check if old failure record exists for ID & TYPE
        // IF they exists then make fail_count = 0 and email_sent_date is set to null
        $instance_id = null;
        $intellicus_id = null;
        $updated_at = now();
        try {
            if ($type == 'INS') {
                $record = DB::table('url_checks')->where('instance_details_id', $id)->first();
            } else {
                $record = DB::table('url_checks')->where('intellicus_details_id', $id)->first();
            }
        } catch (\Throwable $th) {
            // echo $th;
            $record = null;
        }

        if (! empty($record)) {
            if ($record->fail_count > 0) {
                Log::debug('Setting fail_count to ZERO for url_checks ID '.$record->id);
                DB::table('url_checks')->where('id', $record->id)->update(['fail_count' => 0, 'email_sent_date' => null, 'updated_at' => $updated_at]);
            }
        }
    }
}
