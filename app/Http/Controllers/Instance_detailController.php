<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateInstance_detailRequest;
use App\Http\Requests\UpdateInstance_detailRequest;
use App\Repositories\Instance_detailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Server_detail;
use App\Models\Product_version;
use App\Models\Product_name;
use App\Models\Database_detail;
use App\Models\Action_history;
use App\Models\Team;
use App\Models\Intellicus_detail;
use App\Models\Ml_detail;
use DB;
use Auth;
use Mail;
use Log;
use Illuminate\Support\Str;
use App\Mail\BuildStarted;
use App\Mail\ServerRestarted;
use App\Mail\ServerShutdown;
use App\Mail\ServerStarted;
// use Carbon\Carbon;

class Instance_detailController extends AppBaseController
{

    /** @var  Instance_detailRepository */
    private $instanceDetailRepository;

    public function __construct(Instance_detailRepository $instanceDetailRepo)
    {
        $this->instanceDetailRepository = $instanceDetailRepo;
    }


    public function index(Request $request)
    {
        Log::debug('inside Instance_detailContoller.index');
        $this->instanceDetailRepository->pushCriteria(new RequestCriteria($request));

        $instanceDetails = $this->instanceDetailRepository->orderBy('updated_at', 'desc')->all();
        return view('instance_details.index')->with('instanceDetails', $instanceDetails);
    }

    public function create()
    {
        Log::debug('inside Instance_detailContoller.create');
        $sd_arr['server_detail'] = DB::table('server_details')
                                    ->join('server_uses', 'server_details.server_uses_id', 'server_uses.id')
                                    ->where('server_uses.use_short_name', 'APP')
                                    ->where('server_details.server_is_active', 'Y')
                                    ->whereNull('server_details.deleted_at')
                                    ->select('server_details.*')
                                    ->get();

        $pv_arr['product_version'] = Product_version::All();
        $pai_arr['pai_version'] = DB::table('pai_builds')->whereNull('deleted_at')->get();
        $id_arr['intellicus_detail'] = Intellicus_detail::whereNull('deleted_at')->get();
        $ml_arr['ml_detail'] = Ml_detail::whereNull('deleted_at')->get();
        $sf_arr['sf_build'] = DB::table('sf_builds')->whereNull('deleted_at')->get();


        $pn_arr['product_name'] = Product_name::where('product_is_active', 'Y')->get();
        // $dd_arr['database_detail'] = Database_detail::where('db_is_active','Y')->get();
        $dd_arr['database_detail'] = Database_detail::where('repository_type','SPO')->where('db_is_active','Y')->whereNull('deleted_at')->get();

        $pd_arr['pai_detail'] = DB::table('database_details')
                                ->join('server_details', 'server_details.id', 'database_details.server_details_id')
                                ->where('database_details.repository_type', 'PAI')
                                ->whereNull('database_details.deleted_at')
                                ->select('database_details.id', 'server_details.server_name', 'server_details.server_ip', 'database_details.db_user', 'database_details.db_sid')
                                ->get();

        return view('instance_details.create')
        ->with($sd_arr)
        ->with($pv_arr)
        ->with($id_arr)
        ->with($pd_arr)
        ->with($pn_arr)
        ->with($dd_arr)
        ->with($pai_arr)
        ->with($ml_arr)
        ->with($sf_arr)
        ->with('this_is_edit', false)
        ->with('show_is_active', false);
    }

    public function store(CreateInstance_detailRequest $request)
    {
        Log::debug('inside Instance_detailContoller.store');
        $input = $request->all();

        $instanceDetail = $this->instanceDetailRepository->create($input);

        Flash::success('Instance Detail saved successfully.');
        return redirect(route('instanceDetails.index'));
    }

    public function show($id)
    {
        Log::debug('inside Instance_detailContoller.show');
        $instanceDetail = $this->instanceDetailRepository->findWithoutFail($id);

        if (empty($instanceDetail)) {
            Flash::error('Instance Detail not found');
            return redirect(route('instanceDetails.index'));
        }
        return view('instance_details.show')->with('instanceDetail', $instanceDetail);
    }

    public function edit($id)
    {
        Log::debug('inside Instance_detailContoller.edit');
        $instanceDetail = $this->instanceDetailRepository->findWithoutFail($id);

        if (empty($instanceDetail)) {
            Flash::error('Instance Detail not found');
            return redirect(route('instanceDetails.index'));
        }

        $sd_arr['server_detail'] = Server_detail::All();
        $pv_arr['product_version'] = Product_version::All();
        $pai_arr['pai_version'] = DB::table('pai_builds')->whereNull('deleted_at')->get();
        $pn_arr['product_name'] = Product_name::All();
        $id_arr['intellicus_detail'] = Intellicus_detail::whereNull('deleted_at')->get();
        $ml_arr['ml_detail'] = Ml_detail::whereNull('deleted_at')->get();
        $dd_arr['database_detail'] = Database_detail::where('repository_type','SPO')->where('db_is_active','Y')->whereNull('deleted_at')->get();
        $sf_arr['sf_build'] = DB::table('sf_builds')->whereNull('deleted_at')->get();

        $tm_arr['teams_arr'] = DB::table('instance_has_teams')->where('instance_id',$id)->get();
        $team_list['teams'] = \App\Models\Team::all()->sortBy('team_name');
        $pd_arr['pai_detail'] = DB::table('database_details')
                                ->join('server_details', 'server_details.id', 'database_details.server_details_id')
                                ->where('database_details.repository_type', 'PAI')
                                ->whereNull('database_details.deleted_at')
                                ->select('database_details.id', 'server_details.server_name', 'server_details.server_ip', 'database_details.db_user', 'database_details.db_sid')
                                ->get();

        $rec_arr['record'] = DB::table('instance_details')->where('id', $id)->get()->first();

        return view('instance_details.edit')
        ->with('instanceDetail', $instanceDetail)
        ->with($sd_arr)
        ->with($pv_arr)
        ->with($pn_arr)
        ->with($id_arr)
        ->with($pd_arr)
        ->with($dd_arr)
        ->with($rec_arr)
        ->with($tm_arr)
        ->with($pai_arr)
        ->with($ml_arr)
        ->with($sf_arr)
        ->with($team_list)
        ->with('show_is_active', true)
        ->with('this_is_edit', true);
    }

    public function update($id, UpdateInstance_detailRequest $request)
    {
        Log::debug('inside Instance_detailContoller.update');
        $instanceDetail = $this->instanceDetailRepository->findWithoutFail($id);

        if (empty($instanceDetail)) {
            Flash::error('Instance Detail not found');
            return redirect(route('instanceDetails.index'));
        }

        $instanceDetail = $this->instanceDetailRepository->update($request->all(), $id);
        DB::table('instance_has_teams')->where('instance_id',$id)->delete();

        $teams_to_update=$request->get('teamName');

        if (!empty($teams_to_update) > 0)
        {
            foreach ($teams_to_update as $tu) {
             DB::table('instance_has_teams')->insert(
                ['instance_id' => $id, 'team_id' => $tu]
                );
            }
        }
        Flash::success('Instance Detail updated successfully for '.$instanceDetail->instance_name);
        return redirect(route('instanceDetails.index'));
    }

    public function destroy($id)
    {
        $instanceDetail = $this->instanceDetailRepository->findWithoutFail($id);

        if (empty($instanceDetail)) {
            Flash::error('Instance Detail not found');
            return redirect(route('instanceDetails.index'));
        }

        $this->instanceDetailRepository->delete($id);
        Flash::success('Instance Detail deleted successfully.');
        return redirect(route('instanceDetails.index'));
    }


    private function build_numbers($instanceDetail, $type)
    {
        if ($type == "SPO") { //THIS IS TO GET SPO RELEASE BUILD DATA
            $id = $instanceDetail->pv_id;
            $build_data = $instanceDetail->product_versions_by_pvid($id);
            $old_build_id = $build_data->id;
            $release_number = $build_data->product_ver_number;
            $build_number = $build_data->product_build_numer;
            $latest_build_available = $instanceDetail->latest_build_number_by_version($release_number)->product_build_numer;
            $new_build_id = $instanceDetail->latest_build_number_by_version($release_number)->id;
        } elseif ($type == "PAI") { // THIS IS TO GET PAI BUILD DATA
            $id = $instanceDetail->pai_pv_id;
            $build_data = $instanceDetail->pai_versions_by_pvid($id);
            // dd($id);
            $old_build_id = $build_data->id;
            $release_number = $build_data->pai_version;
            $build_number = $build_data->pai_build;
            $latest_build_available = $instanceDetail->latest_pai_build_number_by_version($release_number)->pai_build;
            $new_build_id = $instanceDetail->latest_pai_build_number_by_version($release_number)->id;
        } else { // THIS IS FOR SNOWFLAKE BUILD DATA
            $id = $instanceDetail->sf_pv_id;
            $build_data = $instanceDetail->sf_builds_by_pvid($id);
            $old_build_id = $build_data->id;
            $release_number = $build_data->sf_pai_version;
            $build_number = $build_data->sf_pai_build;
            $latest_build_available = $instanceDetail->latest_sf_build_number_by_version($release_number)->sf_pai_build;
            $new_build_id = $instanceDetail->latest_sf_build_number_by_version($release_number)->id;
        }

        $latest_build = $release_number." ".$latest_build_available;
        $current_build = $release_number." ".$build_number;
        return array($latest_build, $current_build, $old_build_id, $new_build_id);
    }

    public function urlExists($url=NULL)
    {
        if($url == NULL) return false;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($httpcode>=200 && $httpcode<300){
            return true;
        } else {
            return false;
        }
    }

    public function runjob($id,$action)
    {
        $uuid = Str::uuid()->toString();
        Log::debug('inside Instance_detailContoller.runjob');
        $mailto = 'nitkku@ptc.com';
        $instanceDetail = $this->instanceDetailRepository->findWithoutFail($id);

        if (empty($instanceDetail)) {
            Flash::error('Instance Detail not found');
            Log::error('Instance Detail not found');
            return redirect(route('instanceDetails.index'));
        }

        // Initializing all variables
        $user_details = Auth::user();

        $do_action = "Y";
        $error_email = "N";
        $spo_incredibles = "spo-incredibles@ptc.com";

        $instance_name = $instanceDetail->instance_name;
        $username = $user_details->name;
        $mail_data = array('instance'=>$instance_name, 'username'=>$username, 'current_build'=>Null, 'latest_build'=>Null, 'instance_id'=>$instanceDetail->id, 'at_time'=>now(), 'subject'=>Null);

        try { // CHECKING IF DATA EXISTS FOR PV_ID
            $instanceDetail->product_versions_by_pvid($instanceDetail->pv_id);
        } catch (\Throwable $th) {
            Log::error('Unable to set pvid or build_data for ID '.$instanceDetail->id);
            $do_action = "N";
        }

        try { //CHECK IF DATA EXISTS FOR PAI_PV_ID
            $instanceDetail->pai_versions_by_pvid($instanceDetail->pai_pv_id);
        } catch (\Throwable $th) {
            Log::error('Unable to set pai_pv_id or build_data for ID '.$instanceDetail->id);
            $do_action = "N";
        }

        try {
            $mail_details = $instanceDetail->return_team_details($instanceDetail->id);
            $mailto = $mail_details->team_email;
        } catch (\Throwable $th) {
            Log::error('Unable to find team email address hence mail will be sent to SPO-Incredibles');
            $mailto = $spo_incredibles;
        }

        if($do_action == "Y") {
            switch($action) {
                case "SPO_upgrade":
                    list($latest_build, $current_build, $old_build_id, $new_build_id) = $this->build_numbers($instanceDetail, "SPO");

                    $mail_data['subject'] = "Build Updated Triggered";
                    $mail_data['latest_build'] = $latest_build;
                    $mail_data['current_build'] = $current_build;
                    $email = new BuildStarted($mail_data);
                    Log::info('Build update trigerred for Instance ID '.$instanceDetail->id.' from '.$current_build.' to '.$latest_build.' by '.$username);
                break;
                case "ShutDownAppServer":
                    $mail_data['subject'] = "Shutdown AppServer Triggered";
                    $email = new ServerShutdown($mail_data);
                    Log::info('Shutdown AppServer Triggered for Instance ID '.$instanceDetail->id.' by '.$username);
                break;
                case "StartAppServer":
                    $mail_data['subject'] = "Start AppServer Triggered";
                    $email = new ServerStarted($mail_data);
                    Log::info('Start AppServer Triggered for Instance ID '.$instanceDetail->id.' by '.$username);
                break;
                case "Restart":
                    $mail_data['subject'] = "Restart AppServer Triggered";
                    $email = new ServerRestarted($mail_data);
                    Log::info('Restart AppServer Triggered for Instance ID '.$instanceDetail->id.' by '.$username);
                break;
                case "PAI_upgrade":
                    list($latest_build, $current_build, $old_build_id, $new_build_id) = $this->build_numbers($instanceDetail, "PAI");
                    $mail_data['subject'] = "PAI upgrade Triggered";
                    $mail_data['latest_build'] = $latest_build;
                    $mail_data['current_build'] = $current_build;
                    $email = new BuildStarted($mail_data);
                    Log::info('PAI upgrade trigerred for Instance ID '.$instanceDetail->id.' from '.$current_build.' to '.$latest_build.' by '.$username);
                break;
                case "SF_upgrade":
                    list($latest_build, $current_build, $old_build_id, $new_build_id) = $this->build_numbers($instanceDetail, "SF");
                    // dd($latest_build, $current_build, $old_build_id, $new_build_id);
                    $mail_data['subject'] = "Snowflake upgrade Triggered";
                    $mail_data['latest_build'] = $latest_build;
                    $mail_data['current_build'] = $current_build;
                    $email = new BuildStarted($mail_data);
                    Log::info('Snowflake upgrade trigerred for Instance ID '.$instanceDetail->id.' from '.$current_build.' to '.$latest_build.' by '.$username);
                break;
                case "SPM_SF_upgrade":
                    list($latest_build_spo, $current_build_spo, $old_build_id_spo, $new_build_id_spo) = $this->build_numbers($instanceDetail, "SPO");
                    list($latest_build_sf, $current_build_sf, $old_build_id_sf, $new_build_id_sf) = $this->build_numbers($instanceDetail, "SF");

                    $mail_data['subject'] = "Build Updated Triggered";
                    $mail_data['latest_build_spo'] = $latest_build_spo;
                    $mail_data['current_build_spo'] = $current_build_spo;
                    $mail_data['latest_build_sf'] = $latest_build_sf;
                    $mail_data['current_build_sf'] = $current_build_sf;
                    $email = new BuildStarted($mail_data);

                    Log::info('SPM and SF build update trigerred for Instance ID '.$instanceDetail->id.' by '.$username.'. This will upgrade SPM Build from '.$current_build_spo.' to '.$latest_build_spo.' and Snowflake Build from '.$current_build_sf.' to '.$latest_build_sf);
                break;
                case "BuildUpdate":
                case "SPM_PAI_upgrade":

                    list($latest_build_spo, $current_build_spo, $old_build_id_spo, $new_build_id_spo) = $this->build_numbers($instanceDetail, "SPO");
                    list($latest_build_pai, $current_build_pai, $old_build_id_pai, $new_build_id_pai) = $this->build_numbers($instanceDetail, "PAI");

                    $mail_data['subject'] = "Build Updated Triggered";
                    $mail_data['latest_build_spo'] = $latest_build_spo;
                    $mail_data['current_build_spo'] = $current_build_spo;
                    $mail_data['latest_build_pai'] = $latest_build_pai;
                    $mail_data['current_build_pai'] = $current_build_pai;
                    $email = new BuildStarted($mail_data);

                    Log::info('SPM and PAI build update trigerred for Instance ID '.$instanceDetail->id.' by '.$username.'. This will upgrade SPM Build from '.$current_build_spo.' to '.$latest_build_spo.' and PAI Build from '.$current_build_pai.' to '.$latest_build_pai);
                break;
            }

            if (env('APP_ENV') == 'Production') {
                Log::info("Checking if jenkings_url is online or not");
                // $urlcheck = $this->urlExists($instanceDetail->jenkins_url);
                $urlcheck = url_test($instanceDetail->jenkins_url);
                if (!$urlcheck) {
                    log::error('Jenkins URL '.$instanceDetail->jenkins_url.' is not online, please check');
                    Flash::error('Jenkins URL for ID '. $instanceDetail->id .' is not online, hence '.$action.' will not be executed');

                    // $mailto = $spo_incredibles;
                    $mailto = 'ntikku@ptc.com';
                    $mail_data['subject'] = "Jenkins URL is not online for ID ".$instanceDetail->id;
                    $error_email = "Y";
                } else {
                    Log::debug('Updating instance_details table, making running_jenkins_job to Y and instance_is_active to N for Instance Details ID '.$id);
                    DB::table('instance_details')->where('id',$id)->update(['running_jenkins_job'=>'Y', 'instance_is_active'=>'N']);

                    Log::debug('Updating action_histories table, adding new record for Instance Detail ID '.$id);
                    if ($action == "SPO_upgrade") {
                        DB::table('action_histories')
                        ->insert(['unique_id'=>$uuid, 'users_id'=>$user_details->id, 'instance_details_id'=>$id,'jenkins_build_id'=>0,'action'=>$action,'start_time'=>now(), 'status'=>'In Progress', 'old_build_id'=>$old_build_id, 'new_build_id'=>$new_build_id,'created_at' => now()]);
                    } elseif ($action == "PAI_upgrade") {
                        DB::table('action_histories')
                        ->insert(['unique_id'=>$uuid, 'users_id'=>$user_details->id, 'instance_details_id'=>$id,'jenkins_build_id'=>0,'action'=>$action,'start_time'=>now(), 'status'=>'In Progress', 'old_pai_build_id'=>$old_build_id, 'new_pai_build_id'=>$new_build_id,'created_at' => now()]);
                    } elseif ($action == "SF_upgrade") {
                        DB::table('action_histories')
                        ->insert(['unique_id'=>$uuid, 'users_id'=>$user_details->id, 'instance_details_id'=>$id,'jenkins_build_id'=>0,'action'=>$action,'start_time'=>now(), 'status'=>'In Progress', 'old_sf_build_id'=>$old_build_id, 'new_sf_build_id'=>$new_build_id,'created_at' => now()]);
                    } elseif (($action == "SPM_PAI_upgrade" || $action == "BuildUpdate")) {
                        DB::table('action_histories')->insert(['unique_id'=>$uuid, 'users_id'=>$user_details->id, 'instance_details_id'=>$id,'jenkins_build_id'=>0,'action'=>$action,'start_time'=>now(), 'status'=>'In Progress', 'old_build_id'=>$old_build_id_spo, 'new_build_id'=>$new_build_id_spo, 'old_pai_build_id'=>$old_build_id_pai, 'new_pai_build_id'=>$new_build_id_pai, 'created_at' => now()]);
                    } elseif ($action == "SPM_SF_upgrade") {
                        DB::table('action_histories')->insert(['unique_id'=>$uuid, 'users_id'=>$user_details->id, 'instance_details_id'=>$id,'jenkins_build_id'=>0,'action'=>$action,'start_time'=>now(), 'status'=>'In Progress', 'old_build_id'=>$old_build_id_spo, 'new_build_id'=>$new_build_id_spo, 'old_sf_build_id'=>$old_build_id_sf, 'new_sf_build_id'=>$new_build_id_sf, 'created_at' => now()]);
                    } else {
                        DB::table('action_histories')
                        ->insert(['unique_id'=>$uuid, 'users_id'=> $user_details->id, 'instance_details_id'=>$id,'jenkins_build_id'=>0,'action'=>$action,'start_time'=>now(), 'status'=>'In Progress','created_at' => now()]);
                    }

                    $url = $instanceDetail->jenkins_url.'buildWithParameters?uuid='.$uuid.'\&target='.$action;
                    Log::debug('Defined URL - '.$url);

                    try {
                        Log::info('Running exec for action - '.$action);
                        exec('curl -X POST -u'.$instanceDetail->jenkins_uname.':'.$instanceDetail->jenkins_token.' '.$url);
                    } catch (\Throwable $th) {
                        Log::error('Action execution failed, details '.$th);
                        $error_email = "Y";
                        $new_subject = $mail_data['subject']." FAILED !!!";
                        $mail_data['subject'] = $new_subject;
                    }

                    Log::info('exec completed for action - '.$action.' sending email');
                    try {
                        if ($error_email = "N") {
                            Log::info('Sending email to '.$mailto.' and cc to '.$spo_incredibles);
                            if ($mailto == "spo-incredibles@ptc.com") {
                                Mail::to($mailto)->send($email);
                            } else {
                                Mail::to($mailto)->cc($spo_incredibles)->send($email);
                            }
                        } else {
                            Log::debug('Sending error email to SPO-Incredibles');
                            Mail::to($spo_incredibles)->send($email);
                        }
                    } catch (\Throwable $th) {
                        Log::error('Unable to send email, check exception: '.$th);
                    }
                }
            } else {
                // dd($action);
                Log::info('NO EXECUTION, JUST LOG ENTRIES AND MAILS');
                Log::info("Checking if jenkings_url is online or not");
                // $urlcheck = $this->urlExists($instanceDetail->jenkins_url);
                $urlcheck = url_test($instanceDetail->jenkins_url);
                // $urlcheck = False;
                if (!$urlcheck) {
                    log::error('Jenkins URL '.$instanceDetail->jenkins_url.' is not online, please notify SPO-Incredibles');
                    Flash::error('Jenkins URL for ID '. $instanceDetail->id .' is not online, hence '.$action.' will not be executed');
                } else {
                    log::info('Jenkins URL '.$instanceDetail->jenkins_url.' is online');
                    Log::info('Updating instance_details table, making running_jenkins_job to Y and instance_is_active to N ');
                    Log::info('Updating action_histories table, adding new record ');

                    // dd($urlcheck);
                    if ($action == "SPO_upgrade") {
                        DB::table('action_histories')
                        ->insert(['unique_id'=>$uuid, 'users_id'=>$user_details->id, 'instance_details_id'=>$id,'jenkins_build_id'=>0,'action'=>$action,'start_time'=>now(), 'status'=>'In Progress', 'old_build_id'=>$old_build_id, 'new_build_id'=>$new_build_id,'created_at' => now()]);
                    } elseif ($action == "PAI_upgrade") {
                        DB::table('action_histories')
                        ->insert(['unique_id'=>$uuid, 'users_id'=>$user_details->id, 'instance_details_id'=>$id,'jenkins_build_id'=>0,'action'=>$action,'start_time'=>now(), 'status'=>'In Progress', 'old_pai_build_id'=>$old_build_id, 'new_pai_build_id'=>$new_build_id,'created_at' => now()]);
                    } elseif ($action == "SF_upgrade") {
                        DB::table('action_histories')
                        ->insert(['unique_id'=>$uuid, 'users_id'=>$user_details->id, 'instance_details_id'=>$id,'jenkins_build_id'=>0,'action'=>$action,'start_time'=>now(), 'status'=>'In Progress', 'old_sf_build_id'=>$old_build_id, 'new_sf_build_id'=>$new_build_id,'created_at' => now()]);
                    } elseif ($action == "SPM_PAI_upgrade") {
                        DB::table('action_histories')->insert(['unique_id'=>$uuid, 'users_id'=>$user_details->id, 'instance_details_id'=>$id,'jenkins_build_id'=>0,'action'=>$action,'start_time'=>now(), 'status'=>'In Progress', 'old_build_id'=>$old_build_id_spo, 'new_build_id'=>$new_build_id_spo, 'old_pai_build_id'=>$old_build_id_pai, 'new_pai_build_id'=>$new_build_id_pai, 'created_at' => now()]);
                    } elseif ($action == "SPM_SF_upgrade") {
                        DB::table('action_histories')->insert(['unique_id'=>$uuid, 'users_id'=>$user_details->id, 'instance_details_id'=>$id,'jenkins_build_id'=>0,'action'=>$action,'start_time'=>now(), 'status'=>'In Progress', 'old_build_id'=>$old_build_id_spo, 'new_build_id'=>$new_build_id_spo, 'old_sf_build_id'=>$old_build_id_sf, 'new_sf_build_id'=>$new_build_id_sf, 'created_at' => now()]);
                    } else {
                        DB::table('action_histories')
                        ->insert(['unique_id'=>$uuid, 'users_id'=> $user_details->id, 'instance_details_id'=>$id,'jenkins_build_id'=>0,'action'=>$action,'start_time'=>now(), 'status'=>'In Progress','created_at' => now()]);
                    }

                    $url = $instanceDetail->jenkins_url.'buildWithParameters?uuid='.$uuid.'\&target='.$action;
                    Log::info('Defined URL - '.$url);

                    Log::info('Running exec for action - '.$action);

                    try {
                        if ($error_email = "N") {
                            Log::info('Sending email to ntikku@ptc.com only');
                            Mail::to('ntikku@ptc.com')->send($email);
                        } else {
                            Log::debug('Sending error email to SPO-Incredibles');
                            Mail::to('ntikku@ptc.com')->send($email);
                        }
                    } catch (\Throwable $th) {
                        Log::error('Unable to send email, check exception: '.$th);
                    }
                    Log::info('exec completed for action - '.$action);
                }

            }
        }
        return redirect()->back();
    }

    public function presales(Request $request)
    {

        $this->instanceDetailRepository->pushCriteria(new RequestCriteria($request));
        Log::debug('inside Instance_detailContoller.index');
        $instanceDetails = $this->instanceDetailRepository->orderBy('updated_at', 'desc')->all();
        return view('instance_details.presales')
            ->with('instanceDetails', $instanceDetails);
    }
}
