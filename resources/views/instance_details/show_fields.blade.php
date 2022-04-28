<?php

$appServerName =$instanceDetail->server_details_by_id->server_name;
$appServerIP = $instanceDetail->server_details_by_id->server_ip;
$appServerOS = $instanceDetail->return_os_details($instanceDetail->server_details_id,'os_long_name')->get('0');
$appServerRam = $instanceDetail->server_details_by_id->server_ram_gb;
$appServerCpu = $instanceDetail->server_details_by_id->server_cpu_cores;
$appServerHdd = $instanceDetail->server_details_by_id->server_hdd_gb;
$appServerUrl = route('serverDetails.show', [$instanceDetail->server_details_by_id]);

$auto_upgraded = "No";
if ($instanceDetail->instance_is_auto_upgraded == "Y") {
    $auto_upgraded = "Yes";
}

if ($instanceDetail->pai_type == "Hadoop") {
    $pai_details = "PAI-Hadoop";
} elseif($instanceDetail->pai_type == "Oracle") {
    $pai_details = "PAI-Oracle";
} else {
    $pai_details = Null;
}

try {
    $spm_version = $instanceDetail->product_versions_by_pvid($instanceDetail->pv_id);
    $spm_release_number = $spm_version->product_ver_number;
    $spm_build_number = $spm_version->product_build_numer;
    $is_rel_build = $spm_version->is_release_build;

    // $release_number = $instanceDetail->return_product_versions_by_pvid($instanceDetail->pv_id,"product_ver_number");
    // $build_number = $instanceDetail->return_product_versions_by_pvid($instanceDetail->pv_id,"product_build_numer");
    // $is_rel_build = $instanceDetail->return_product_versions_by_pvid($instanceDetail->pv_id,"is_release_build");
    // $is_rel_build = trim($is_rel_build,'[]""');
} catch (\Throwable $th) {
    $release_number = null;
    $build_number = null;
    $is_rel_build = null;
}

try {
    $pai_release = $instanceDetail->pai_versions_by_pvid($instanceDetail->pai_pv_id);
    $pai_version_number = $pai_release->pai_version;
    $pai_build_number = $pai_release->pai_build;
} catch (\Throwable $th) {
    $pai_version_number = null;
    $pai_build_number = null;
}

//  SETTING UP $user_has_rights VARIABLE
if (Auth::user()) {
    $user_has_rights = $instanceDetail->check_user_rights_for_instance($instanceDetail->id);
    if (!empty($user_has_rights)) {
        if(Auth::user()->hasAnyRole(['advance', 'admin', 'superadmin'])) {
            $user_has_rights = True;
        }
    }
} else {
    $user_has_rights = null;
}

if (!empty($instanceDetail->intellicus_details_id))
{
    $intellicus_version = null;
    try {
        // $intserv = $instanceDetail->intellicus_details_by_id->server_details_id;
        $intellicus_name = $instanceDetail->intellicus_details_by_id->intellicus_name;
        $intellicus_server_name = $instanceDetail->return_server_details_by_id(($instanceDetail->intellicus_details_by_id->server_details_id),'server_name')->get('0');
        $intellicus_server_ip = $instanceDetail->return_server_details_by_id(($instanceDetail->intellicus_details_by_id->server_details_id),'server_ip')->get('0');

        $intellicus_login = $instanceDetail->intellicus_details_by_id->intellicus_login;
        $intellicus_pass = $instanceDetail->intellicus_details_by_id->intellicus_pwd;

        $int_vid = ($instanceDetail->intellicus_details_by_id->intellicus_versions_id);

        $intellicus_version = $instanceDetail->return_intellicus_version_details($int_vid,'intellicus_version')->get('0');
        $intellicus_patch = $instanceDetail->return_intellicus_version_details($int_vid,'intellicus_patch')->get('0');
        $intellicus_path = $instanceDetail->intellicus_details_by_id->intellicus_install_path;

        $intell_url = "http://".$intellicus_server_ip.":".$instanceDetail->intellicus_details_by_id->intellicus_port."/intellicus";
    } catch (\Throwable $th) {
        //throw $th;
    }
}


$generated_url = "https://" . $instanceDetail->server_details_by_id->server_ip . ":" . $instanceDetail->instance_tomcat_port ."/WebUI/";
$generated_app_server = $instanceDetail->server_details_by_id->server_name." (".$instanceDetail->server_details_by_id->server_ip.")";

# GETTING DB SERVER DETAILS
$dbServerDetails = $instanceDetail->return_db_server_details($instanceDetail->database_details_id);

if(!empty($dbServerDetails)) {
    $dbServerName = $dbServerDetails->server_name;
    $dbServerIP =  $dbServerDetails->server_ip;
    // $dbServerOS = $dbServerDetails->server_ip;
    $dbServerCores = $dbServerDetails->server_cpu_cores;
    $dbServerRam = $dbServerDetails->server_ram_gb;
    $dbServerHdd = $dbServerDetails->server_hdd_gb;

    $dbServerOS = $instanceDetail->return_os_details($dbServerDetails->id,'os_long_name')->get('0');
    // $dbServerOS = $instanceDetail->database_details_id;
    $appServerOS = $instanceDetail->return_os_details($instanceDetail->server_details_id,'os_long_name')->get('0');
    $generated_db_userpass = $instanceDetail->database_details_by_id->db_user."/".$instanceDetail->database_details_by_id->db_pass;
    $generated_connect = $generated_db_userpass."@".$instanceDetail->database_details_by_id->db_sid;
    $dbServerUrl = route('serverDetails.show', [$dbServerDetails->id]);
} else {
    $dbServerName = null;
    $dbServerIP = null;
    // $dbServerOS = null;
    $dbServerCores = null;
    $dbServerRam = null;
    $dbServerHdd = null;
    $dbServerUrl = null;
    $dbServerOS = null;
    $generated_db_userpass = null;
    $generated_connect = null;
}

try {
    $db_sid = $instanceDetail->database_details_by_id->db_sid;
} catch (\Throwable $th) {
    $db_sid = "<strong>ERROR</strong>: Data Missing";
}

$act_records = $instanceDetail->return_all_action_history_by_id($instanceDetail->id);

if (!empty($instanceDetail->pai_details_id)) {

    $pai_server_id = $instanceDetail->return_db_details($instanceDetail->pai_details_id, 'server_details_id');
    $pai_server = $instanceDetail->return_server_details_by_id($pai_server_id, 'server_name')->get('0');

    try {
        $ambari_details = $instanceDetail->return_ambari_details_by_id($instanceDetail->pai_details_by_id->ambari_details_id, 'ambari_url')->get('0');
    } catch (\Throwable $th) {
        $ambari_details = null;
    }

    $pai_type = $instanceDetail->return_db_details($instanceDetail->pai_details_id, 'repository_type');
    $pai_user = $instanceDetail->return_db_details($instanceDetail->pai_details_id, 'db_user');
    $pai_password = $instanceDetail->return_db_details($instanceDetail->pai_details_id, 'db_pass');
    $pai_port = $instanceDetail->return_db_details($instanceDetail->pai_details_id, 'db_port');
    $pai_db = $instanceDetail->return_db_details($instanceDetail->pai_details_id, 'db_sid');
    $icon_list = "";

}

if (!empty($instanceDetail->ml_details_id)) {

    $ml_server_name = $instanceDetail->return_server_details_by_id($instanceDetail->mlDetail->server_details_id,'server_name')->get('0');
    $ml_server_ip = $instanceDetail->return_server_details_by_id($instanceDetail->mlDetail->server_details_id,'server_ip')->get('0');

    $ml_url = "http://".$ml_server_ip.":".$instanceDetail->mlDetail->zeppelin_port."/";
    $ml_user = $instanceDetail->mlDetail->zeppelin_user;
    $ml_pass = $instanceDetail->mlDetail->zeppelin_pwd;
    $ml_port = $instanceDetail->mlDetail->zeppelin_port;
    $ml_name = $instanceDetail->mlDetail->ml_name;
    $ml_path = $instanceDetail->mlDetail->ml_install_path;
}

try {
    $db_long_name = $instanceDetail->return_db_details($instanceDetail->database_details_id,'db_long_name')->get('0');
} catch (\Throwable $th) {
    $db_long_name = null;
}

try {
    $db_patchset = $instanceDetail->return_db_details($instanceDetail->database_details_id,'db_patchset')->get('0');
} catch (\Throwable $th) {
    $db_patchset = null;
}

?>

<div class="row">
    <div class="col-md-4">
        <h4 class="custom-h4"><i class="far fa-file-alt"></i>  Application Server Details</h4>
        <table class="table table-responsive table-condensed table-striped">
            <tr><td><strong>Server Name</strong></td><td><a href="{{ $appServerUrl }}" target="_blank">{!! strtoupper($appServerName) !!}</a></td></tr>
            <tr><td><strong>Server IP</strong></td><td>{!! $appServerIP !!}</td></tr>
            <tr><td><strong>Server OS</strong></td><td>{!! $appServerOS !!}</td></tr>
            <tr><td><strong># Cores</strong></td><td>{!! $appServerCpu !!}</td></tr>
            <tr><td><strong>RAM</strong></td><td>{!! $appServerRam !!} GB</td></tr>
            <tr><td><strong>Disk Space</strong></td><td>{!! $appServerHdd !!} GB</td></tr>
            <tr><td><strong>Tomcat Version</strong></td><td>{!! $instanceDetail->webserver_version !!}</td></tr>
            <tr><td><strong>Installed Path</strong></td><td>{!! $instanceDetail->instance_install_path !!}</td></tr>
        </table>
    </div>
    {{-- DATABASE SERVER DETAILS --}}
    <div class="col-md-4">
        <h4 class="custom-h4"><i class="fas fa-database"></i>  Database Server Details</h4>
        <table class="table table-responsive table-condensed table-striped">
                <tr><td><strong>Server Name</strong></td><td><a href="{{ $dbServerUrl }}" target="_blank">{!! strtoupper($dbServerName) !!}</a></td></tr>
                <tr><td><strong>Server IP</strong></td><td>{!! $dbServerIP !!}</td></tr>
                <tr><td><strong>Server OS</strong></td><td>{!! $dbServerOS !!}</td></tr>
                <tr><td><strong># Cores</strong></td><td>{!! $dbServerCores !!}</td></tr>
                <tr><td><strong>RAM</strong></td><td>{!! $dbServerRam !!} GB</td></tr>
                <tr><td><strong>Disk Space</strong></td><td>{!! $dbServerHdd !!} GB</td></tr>
                <tr><td><strong>DB Version</strong></td><td>{!! $db_long_name !!} {!! $db_patchset !!}</td></tr>

                <tr><td><strong>DB User/Pwd</strong></td><td>{!! $generated_db_userpass !!}</td></tr>
                <tr><td><strong>DB SID/Name</strong></td><td>{!! $db_sid !!}</td></tr>
        </table>
    </div>

    {{--OTHER DETAILS --}}
    <div class="col-md-4">
        <h4 class="custom-h4"><i class="far fa-clipboard"></i></i>  Other Details</h4>
        <table class="table table-responsive table-condensed  table-striped">
                <tr>
                    {{-- <td><strong>{!! $instanceDetail->product_names_by_id->product_short_name !!} Version</strong></td> --}}
                    <td><strong>SPM Version</strong></td>
                    {{-- <td>{!! trim($release_number,'[]"') !!} {!! trim($build_number,'[]"') !!} --}}
                        <td> {{  $spm_release_number }} Build {{ $spm_build_number }}
                    @if($is_rel_build == "Y")
                        <i class="fas fa-crown fa-xs" title="Release Build"></i>
                    @endif
                    </td>
                </tr>
                <tr><td><strong>Tomcat Port</strong></td><td>{!! $instanceDetail->instance_tomcat_port !!}</td></tr>
                <tr><td><strong>Tomcat Service Name</strong></td><td>{!! $instanceDetail->tomcat_service_name !!}</td></tr>
                <tr><td><strong>AutoPilot Service Name</strong></td><td>{!! $instanceDetail->ap_service_name !!}</td></tr>
                <tr><td><strong>JDK</strong></td><td>{!! $instanceDetail->jdk_type !!}&nbsp;{!! $instanceDetail->jdk_version !!}</td></tr>
                <tr><td><strong>Auto-Upgraded</strong></td><td>{!! $auto_upgraded !!}</td></tr>
                <tr><td><strong>JIRA Number</strong></td><td>{!! $instanceDetail->instance_jira !!}</td></tr>
                <tr><td><strong>Check Fail Threshold</strong></td><td>{!! $instanceDetail->check_fail_count !!}</td></tr>
                <tr><td><strong>Notes</strong></td><td>{!! $instanceDetail->instance_note !!}</td></tr>
        </table>
    </div>
   {{-- @endhasanyrole--}}
</div>
<div class="row">
    {{-- INTELLICUS DETAILS --}}
    @if (!empty($instanceDetail->intellicus_details_id))
        <div class="col-md-4">
            <h4 class="custom-h4"><i class="fas fa-info-circle"></i></i>  Intellicus Details</h4>
            <table class="table table-responsive table-condensed table-striped">
                <tr><td><strong>Name</strong></td><td><a href="{{ $intell_url }}" target="_blank">{{ $intellicus_name }}</a></td></tr>
                <tr><td><strong>Server Name</strong></td><td>{{  $intellicus_server_name }}</td></tr>
                <tr><td><strong>IP Address</strong></td><td>{{  $intellicus_server_ip }}</td></tr>
                <tr><td><strong>Version</strong></td><td>{{  $intellicus_version }} {{ $intellicus_patch }}</td></tr>
                @if($user_has_rights)
                <tr><td><strong>Login</strong></td><td>{{  $intellicus_login }}</td></tr>
                <tr><td><strong>Password</strong></td><td>{{  $intellicus_pass }}</td></tr>
                @endif
                @hasanyrole('advance|admin|superadmin')
                    <tr><td><strong>Installed Path</strong></td><td> {{ $intellicus_path }}</td></tr>
                @endhasanyrole
            </table>
        </div>
    @endif

    {{-- PAI DETAILS --}}
    @if(!empty($instanceDetail->pai_details_id))
    <div class="col-md-4">
        <h4 class="custom-h4"><i class="fas fa-snowflake"></i></i>  PAI Details &nbsp;&nbsp;{!! $icon_list !!}</h4>
        <table class="table table-responsive table-condensed table-striped">
            <tr><td><strong>PAI Version</strong></td><td>{{  $pai_version_number }} Build {{ $pai_build_number }}</td></tr>
            <tr><td><strong>Server Name</strong></td><td><a href="{{ route('serverDetails.show', [$pai_server_id]) }}"> {{ strtoupper($pai_server) }} </a></td></tr>
            @if(!@empty($ambari_details))
            <tr><td><strong>Ambari</strong></td><td>{{  $ambari_details }}</td></tr>
            @endif
            @if($user_has_rights)
                <tr><td><strong>Login</strong></td><td>{{  $pai_user }}</td></tr>
                <tr><td><strong>Password</strong></td><td>{{  $pai_password }}</td></tr>
                <tr><td><strong>Database</strong></td><td>{{  $pai_db }}</td></tr>
                @if(!empty($pai_port))
                    <tr><td><strong>Port Number</strong></td><td>{{  $pai_port }}</td></tr>
                @endif
            @endif
        </table>
    </div>
    @endif

    {{-- ML DETAILS --}}
    @if(!empty($instanceDetail->ml_details_id))
    <div class="col-md-4">
        <h4 class="custom-h4"><i class="fab fa-leanpub"></i></i>  Machine Learning Details </h4>
        <table class="table table-responsive table-condensed table-striped">
            <tr><td><strong>Name</strong></td><td><a href="{{ $ml_url }}" target="_blank"> {{ strtoupper($ml_name) }} </a></td></tr>
            <tr><td><strong>Server Name</strong></td><td>{{ $ml_server_name }}</td></tr>
            <tr><td><strong>IP Address</strong></td><td>{{ $ml_server_ip }}</td></tr>
            <tr><td><strong>Zeppelin User</strong></td><td>{{ $ml_user }}</td></tr>
            @if($user_has_rights)
                <tr><td><strong>Zeppelin Password</strong></td><td>{{  $ml_pass }}</td></tr>
            @endif
            <tr><td><strong>Zeppelin Port</strong></td><td>{{ $ml_port }}</td></tr>
            <tr><td><strong>Installed Path</strong></td><td>{{ $ml_path }}</td></tr>
        </table>
    </div>
    @endif

    {{-- ACTION HISTORY RECORDS --}}
    @if(count($act_records))
        <div class="col-md-4">
        <h4 class="custom-h4"><i class="fas fa-history"></i></i>  User Action History</h4>
        <table class="table table-responsive table-condensed table-striped">
            <tbody>
                @php $X = 1; @endphp
            @foreach ($act_records as $records)
                @if(empty($records->deleted_at))
                    @php
                    if ($X > 7) { //SHOW ONLY LAST 7 RECORDS
                        break;
                    }
                    $action_done = trim($records->action,'[]"');
                    $action_text = get_action_text($action_done);

                    $status_icon = "";
                    if ($records->status == "Successful") {
                        $showtime = "<i class=\"fas fa-clock fa-sm\" title=\"Time\"></i> ".$records->end_time;
                        $status_icon = "<i class=\"far fa-check-circle fa-sm\" title=\"Successfull\"></i>";
                    } elseif ($records->status == "Failed") {
                        $showtime = "<i class=\"fas fa-clock fa-sm\" title=\"Time\"></i> ".$records->end_time;
                        $status_icon = "<i class=\"far fa-times-circle fa-sm\" title=\"Failed\"></i>";
                        // $status_td = "<td class=\"status_failed\">";
                    } elseif ($records->status == "In Progress") {
                        $showtime = "<i class=\"fas fa-clock fa-sm\" title=\"Start Time\"></i> ".$records->start_time;
                        $status_icon = "<i class=\"fas fa-sync fa-spin fa-sm\" title=\"Job in Progress\"></i>";
                    } elseif ($records->status == "Scheduler") {
                        $showtime = "<i class=\"fas fa-clock fa-sm\" title=\"Time\"></i> ".$records->end_time;
                        $status_icon = "<i class=\"far fa-times-circle fa-sm\" title=\"Failed\"></i>";
                        // $status_td = "<td class=\"status_warning\">";
                    }
                    $fullname = $instanceDetail->get_username_by_id(trim($records->users_id,'[]"'))->name;
                    $firstname = explode(" ", $fullname)[0];
                    @endphp
                        <tr>
                            <td><i class="fas fa-bolt fa-sm" title="Action Performanced"></i> {!! $action_text !!}</td>
                            <td><i class="fas fa-user fa-sm" title="User"></i> {!! $firstname !!}</td>
                            <td>{!! $showtime !!} IST</td>
                            <td>{!! $status_icon !!} {!! $records->status !!}</td>
                        </tr>
                    @php
                    $X++;
                    @endphp
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

