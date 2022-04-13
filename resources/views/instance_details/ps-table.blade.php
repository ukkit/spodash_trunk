<?php
    $CX=1;

?>

<table class="table table-responsive table-condensed table-striped" id="instanceDetails-table">
    <thead>
        <tr>
            @hasanyrole('advance|admin|superadmin')
                <th class="text-center id_column">ID</th>
            @else
                <th class="text-center id_column">#</th>
            @endhasanyrole
            <th class="hidden">Product</th>
            <th class="text-center column_10pct">Customer</th>
            <th class="text-center column_5pct">Build</th>
            <th class="hidden">Intellicus</th>
            <th class="text-center column_7pct">Login</th>
            <th class="details_column">App Details</th>
            <th class="details_column">DB Details</th>
            <th class="hidden">JDK Type</th>
            <th class="column_6pct">Heapsize (MB)</th>
            <th class="column_6pct">Used By</th>
            <th class="column_10pct">User Actions</th>
            <th class="hidden">Notes</th>
            @hasanyrole('advance|admin|superadmin')
                <th class="text-center icon_column"><i class="fas fa-user-cog" title="Tomcat/Autopilot Service Name defined"></i></th>
                <th class="text-center icon_column"><i class="fas fa-heartbeat" title="Instance is Active"></i></th>
                <th class="text-center icon_column"><i class="fas fa-tachometer-alt" title="Show on Dashboard"></i></th>
            @endhasanyrole
            @canany('restart_instanceDetails','edit_instanceDetails','delete_instanceDetails')
                <th class="text-center icon_column"><i class="fas fa-tools" title="Actions"></i></th>
            @endcanany
        </tr>
    </thead>
    <tbody>
    @php
    // dd(count($instanceDetails));
    @endphp
    @if ($instanceDetails !== null)

    @foreach($instanceDetails->chunk(25) as $iDts)

        @foreach($iDts as $instanceDetail)
            <?php
                // $show_on_site = True;
                $show_on_site = False;

                $generated_log_dir = "\\\\" . $instanceDetail->server_details_by_id->server_ip . "\\" . $instanceDetail->instance_shared_dir;

                // dd($instanceDetail->pai_details_by_id->pai_type);
                try {
                    // $pai = strtolower($instanceDetail->pai_details_by_id->pai_type);
                    $pai_type = strtolower($instanceDetail->return_db_details($instanceDetail->pai_details_id,'repository_type'));
                } catch (\Throwable $th) {
                    $pai_type = Null;
                }

                try {
                    $pai_db_type = $instanceDetail->return_database_type($instanceDetail->pai_details_id);
                } catch (\Throwable $th) {
                    $pai_db_type = Null;
                }
                // ICONS
                $icon_list = "";
                if(($pai_type == "pai" && $pai_db_type == "oracle")) {
                    $icon_list .= "<span class=\"grey small\">PAI-Oracle</span> ";
                } elseif(($pai_type == "pai" && $pai_db_type == "hadoop")) {
                    $icon_list .= "<span class=\"grey small\">PAI-Hadoop</span> ";
                }
                if($instanceDetail->jdk_type == "Amazon Corretto") {
                    $icon_list .= "<i class=\"fab fa-amazon\" title=\"Amazon Corretto JDK\"></i> ";
                } elseif($instanceDetail->jdk_type == "Oracle JDK") {
                    $icon_list .= "<i class=\"fab fa-java\" title=\"Oracle JDK\"></i> ";
                }
                if($instanceDetail->is_insight_enabled == "Y") {
                    $icon_list .= "<i class=\"fas fa-info\" title=\"Insight Configured\"></i>";
                }


                //  SETTING UP $user_has_rights VARIABLE
                if (Auth::user()) {
                    $user_has_rights = $instanceDetail->check_user_rights_for_instance($instanceDetail->id);
                } else {
                    $user_has_rights = null;
                }
                $show_userpass = NULL;

                // NEW TEAM NAMES
                try {
                    $for_everyone = NULL;
                    $team_name = "";
                    $team_name_array = $instanceDetail->return_team_names($instanceDetail->id, 'team_name');
                    // dd($team_name_array);
                    $for_everyone = NULL;
                    $team_name = "";
                    if (count($team_name_array) == 1 ) {
                        foreach ($team_name_array as $tna) {
                            if ($tna == "Pre-Sales") {
                                $team_name .= $tna;
                                $show_on_site = True;
                            }
                        }
                    } elseif (count($team_name_array) >= 2) {
                        foreach ($team_name_array as $tna) {
                            if ($tna == "All") {
                                $team_name .= "Everyone <br>";
                                $for_everyone = True;
                            } else {
                                $team_name .= $tna . "<br>";
                            }
                        }
                    }
                } catch (\Throwable $th) {
                    // Log::error($th);
                    $show_on_site = False;
                }


                // GENERATING URLS
                $generated_app_userpass = "";
                if (($instanceDetail->show_instance_login == "Y") && ($user_has_rights)) {
                    $generated_app_userpass = "Username/Password: ".$instanceDetail->instance_login."/ ".$instanceDetail->instance_pwd;
                } elseif ($for_everyone) {
                    $generated_app_userpass = "Username/Password: ".$instanceDetail->instance_login."/ ".$instanceDetail->instance_pwd;
                } else {
                    $generated_app_userpass = "";
                }
                if ($instanceDetail->in_use == "Y") {
                    $generated_app_userpass = "";
                }

                if ($instanceDetail->instance_is_active == "N") {
                    $app_btn_type = "btn-disabled";
                    $intell_btn_type = "btn-disabled";
                } else {
                    $app_btn_type = "btn-info";
                    $intell_btn_type = "btn-default";
                }
                if($instanceDetail->is_https == "Y") {
                    $http_tag = "https";
                    $link_icon = "<button type=\"button\" class=\"btn $app_btn_type btn-xs xsmall\" title=\"$generated_app_userpass\"><i class=\"fas fa-lock fs-sm\" ></i> ".$instanceDetail->product_names_by_id->product_short_name."</button>";
                } else {
                    $http_tag = "http";
                    $link_icon = "<button type=\"button\" class=\"btn $app_btn_type btn-xs xsmall\" title=\"$generated_app_userpass\"><i class=\"fas fa-lock-open fa-sm\" ></i> ".$instanceDetail->product_names_by_id->product_short_name."</button>";
                }

                $generated_url = $http_tag."://" . $instanceDetail->server_details_by_id->server_name .":".$instanceDetail->instance_tomcat_port ."/WebUI/";

                if ($for_everyone)  {
                    $show_userpass = True;
                } elseif (($instanceDetail->enable_instance_auto_login == "Y") && ($user_has_rights))  {
                    $show_userpass = True;
                }
                if ($instanceDetail->in_use == "Y") {
                    $show_userpass = NULL;
                    $generated_app_userpass = "";
                }

                if ($show_userpass) {
                    $generated_url .= "?txtUsername=".$instanceDetail->instance_login."&txtPassword=".$instanceDetail->instance_pwd;
                }

                // GENERATING BUILD AND RELEASE NUMBERS
                try {
                    $rel_number = $instanceDetail->return_product_versions_by_pvid($instanceDetail->pv_id,"product_ver_number");
                    $release_number = trim($rel_number,'[]"');
                    $build_no = $instanceDetail->return_product_versions_by_pvid($instanceDetail->pv_id,"product_build_numer");
                    $build_number = trim($build_no,'[]"');
                    $latest_build_available = $instanceDetail->latest_build_number_by_version($release_number)->product_build_numer;
                    $existing_build_date = $instanceDetail->return_build_creation_date($release_number,$build_number)->created_at;

                    $latest_build_date = $instanceDetail->return_build_creation_date($release_number,$latest_build_available)->created_at;
                    $update_text = "<i class=\"fas fa-level-up-alt\" title=\"Upgrade to ". $release_number ." ". $latest_build_available ."\"></i> ".$latest_build_available;

                    $is_rel_build = $instanceDetail->return_product_versions_by_pvid($instanceDetail->pv_id,"is_release_build");
                    $is_rel_build = trim($is_rel_build,'[]""');

                    $generated_version = $release_number." Build: ".$build_number;

                    //PAI details
                    $instance_pai_pv_id = $instanceDetail->pai_pv_id;

                    $rel_number = $instanceDetail->latest_pai_build_number_by_version($version);
                    $latest_build_available = $instanceDetail->latest_build_number_by_version($release_number)->product_build_numer;
                    $latest_pai_date = $instanceDetail->return_pai_build_creation_date($release_number,$build_number)->created_at;

                } catch (\Throwable $th) {
                    //throw $th;
                    Log::debug('Build details (pv_id '.$instanceDetail->pv_id.') are not available for Instance '. $instanceDetail->instance_name .' (instance_id: '.$instanceDetail->id.')');
                    $release_number = null;
                    $build_number = null;
                    $is_rel_build = null;
                }

                // DB SERVER DETAILS
                try {
                    $generated_db_userpass = $instanceDetail->database_details_by_id->db_user."/".$instanceDetail->database_details_by_id->db_pass;

                    if ($instanceDetail->database_details_by_id->db_user == $instanceDetail->database_details_by_id->db_pass ) {
                        $generated_connect = $instanceDetail->database_details_by_id->db_user."@".$instanceDetail->database_details_by_id->db_sid;
                    } else {
                        $generated_connect = $generated_db_userpass."@".$instanceDetail->database_details_by_id->db_sid;
                    }

                    $generated_db_server = $instanceDetail->return_db_server_details($instanceDetail->database_details_id,'server_name')->get('0')." (".$instanceDetail->return_db_server_details($instanceDetail->database_details_id,'server_ip')->get('0').")";

                    $dbDetails = "";
                    // $dbDetails = "<small>";
                    $dbDetails .= "<i class=\"fas fa-server fa-sm\"  title=\"Server Name\"></i> <a href=".route('serverDetails.show', $instanceDetail->return_db_server_details($instanceDetail->database_details_id,'id')->get('0')).">".$generated_db_server."</a><br>";
                    $dbDetails .= "<i class=\"fas fa-database fa-sm\"  title=\"Database Type\"></i> ".$instanceDetail->return_db_type($instanceDetail->database_details_id,'db_short_name')->get('0')."<br>";
                    $dbDetails .= "<i class=\"fas fa-plug fa-sm\" title=\"Database Connection Details\"></i> ".$generated_connect."<br>";
                    // $dbDetails .= "</small>";
                } catch (\Throwable $th) {
                    Log::error('DB Server - Data for Server details (ID: '.$instanceDetail->server_details_id.') or Database Detail (ID: '.$instanceDetail->database_details_id.') is not available for  Instance ID ' .$instanceDetail->id.' hence setting show_on_site as False.');
                    if((Auth::guest() || Auth::user()->hasanyrole(['basic','zero']))) {
                        $show_on_site = False;
                    }
                    $generated_db_userpass = null;
                    // $dbDetails = "<strong>ERROR</strong>: Data Missing ".$instanceDetail->id;
                    $dbDetails = "<strong>ERROR</strong>: Data Missing, check <a href=\"".route('show.log')."\" target=\"_blank\">LOG</a> file for Instance ID ".$instanceDetail->id;
                }


                // APP SERVER DETAILS
                try {
                    $generated_app_server = $instanceDetail->server_details_by_id->server_name." (".$instanceDetail->server_details_by_id->server_ip.")";
                    // $appDetails = "<small>";
                    $appDetails = "";
                    $appDetails .= "<i class=\"fas fa-server fa-sm\" title=\"Server Name\"></i> <a href=".route('serverDetails.show', [$instanceDetail->server_details_id]).">".$generated_app_server."</a><br>";
                    $appDetails .="<i class=\"fas fa-folder-open fa-sm\" title=\"Installation Directory\"></i> ".$instanceDetail->instance_install_path."<br>";
                    $appDetails .="<i class=\"fas fa-folder-open fa-sm\" title=\"Logs Folder\"></i> ".$generated_log_dir."<br>";
                    // $appDetails .= "</small>";
                } catch (\Throwable $th) {
                    Log::error('App Server - Data for Server details (ID: '.$instanceDetail->server_details_id.') is not available for  Instance ID ' .$instanceDetail->id.' hence setting show_on_site as False.');
                    if((Auth::guest() || Auth::user()->hasanyrole(['basic','zero']))) {
                        $show_on_site = False;
                    }
                    $generated_app_server = null;
                    $appDetails = "<strong>ERROR</strong>: Data Missing, check <a href=\"".route('show.log')."\" target=\"_blank\">LOG</a> file for Instance ID ".$instanceDetail->id;
                }


                // INTELLICUS DETAILS
                $intellicus = null;
                $intellicus_version = null;
                if(!empty($instanceDetail->intellicus_details_id)) {

                    try {
                        $int_vid = ($instanceDetail->intellicus_details_by_id->intellicus_versions_id);
                        $intell_ver = $instanceDetail->return_intellicus_version_details($int_vid,'intellicus_version')->get('0');
                        $intell_patch = $instanceDetail->return_intellicus_version_details($int_vid,'intellicus_patch')->get('0');
                        $intell_userpass = $instanceDetail->intellicus_details_by_id->intellicus_login."/".$instanceDetail->intellicus_details_by_id->intellicus_pwd;
                        $intserv = $instanceDetail->intellicus_details_by_id->server_details_id;
                        $intelli_server = $instanceDetail->return_server_details_by_id(($instanceDetail->intellicus_details_by_id->server_details_id),'server_ip')->get('0');
                        // dd($intserv);
                        $intell_url = "http://".$intelli_server.":".$instanceDetail->intellicus_details_by_id->intellicus_port."/intellicus";

                        $intellicus = "<br><a href=\"".$intell_url."\" target=\"_blank\">";
                        $button = $string = str_replace(' ', '', $intell_ver);
                        if (! empty($intell_patch)){
                            $X1 = explode('Patch', $intell_patch);
                            $button .= "p".trim($X1[1]);
                        }

                        if (Auth::user() && ($user_has_rights)) {
                            $intellicus .= "<button type=\"button\" class=\"btn $intell_btn_type btn-xs xsmall\" title=\"Intellicus User/Pass: $intell_userpass\">$button</button></a>";
                        } else {
                            $intellicus .= "<button type=\"button\" class=\"btn $intell_btn_type btn-xs xsmall\" >$button</button></a>";
                        }

                        $intellicus_version = "Intellicus ".$intell_ver." ".$intell_patch;
                    } catch (\Throwable $th) {
                        //throw $th;
                        Log::debug('Intellicus details for intellicus_details_id '. $instanceDetail->intellicus_details_id .' missing for Instance '. $instanceDetail->instance_name .' (instance_id: '.$instanceDetail->id.')');
                        $intellicus = null;
                        $intellicus_version = null;
                    }
                }

                // HEAP SIZE DETAILS
                $ap_heapsize = "<small>";
                $ap_heapsize .= "<i class=\"fas fa-arrow-circle-down fa-sm\" Title=\"Minimum Heap Size\"></i> ".$instanceDetail->instance_ap_min_heap_size." ";
                $ap_heapsize .= "<i class=\"fas fa-arrow-circle-up fa-sm\" Title=\"Maximum Heap Size\"></i> ".$instanceDetail->instance_ap_max_heap_size."<br>";
                $ap_heapsize .= "</small>";

                $web_heapsize = "<small>";
                $web_heapsize .= "<i class=\"fas fa-arrow-circle-down fa-sm\" Title=\"Minimum Heap Size\"></i> ".$instanceDetail->instance_web_min_heap_size." ";
                $web_heapsize .= "<i class=\"fas fa-arrow-circle-up fa-sm\" Title=\"Maximum Heap Size\"></i> ".$instanceDetail->instance_web_max_heap_size."<br>";
                $web_heapsize .= "</small>";

                // ACTION HISTORY DETAILS
                $action_hist_record = $instanceDetail->return_action_history_details($instanceDetail->id);
                $status_icon = "";
                $show_warning = Null;
                $status_td = "<td>";

                if (empty($action_hist_record))
                {
                    $action_histories = "";
                } elseif (!empty($action_hist_record->deleted_at)) {
                    // Don't show record if it is marked for deletion
                    $action_histories = "";
                } else {
                    $username = $instanceDetail->get_username_by_id(trim($action_hist_record->users_id,'[]"'));
                    $status=trim($action_hist_record->status,'[]"');

                    $action_done = trim($action_hist_record->action,'[]"');
                    switch($action_done) {
                        case "StartAppServer":
                            $action_text = "Start Server";
                            break;
                        case "ShutDownAppServer":
                            $action_text = "Stop Server";
                            break;
                        case "Restart":
                            $action_text = "Restart Server";
                            break;
                        case "SPO_upgrade":
                            $action_text = "Build Update";
                            break;
                        case "BuildUpdate":
                            $action_text = "PAI+SPM Update";
                            break;
                        case "PAI_upgrade":
                            $action_text = "PAI Update";
                            break;
                        default:
                        $action_text = "Build Update";
                    }

                    $action_histories = "<small>";
                    // $action_histories = "";
                    $gen_jenkins_url = "<a href=\"".$instanceDetail->jenkins_url."/".$action_hist_record->jenkins_build_id."/console\" target=\"_blank\"> ";
                    if ($status == "Failed") {
                        // $gen_jenkins_url = "<a href=\"".$instanceDetail->jenkins_url."/".$action_hist_record->jenkins_build_id."/console\" target=\"_blank\"> ";
                        // $action_histories .= "<i class=\"fas fa-bolt fa-sm\" title=\"Last Action Performanced\"></i> ".$gen_jenkins_url.$action_text." ". $status_icon ."</a> <br>";
                        $action_histories .= "<i class=\"fas fa-bolt fa-sm\" title=\"Last Action Performanced\"></i> ".$gen_jenkins_url.$action_text."</a> ";
                    } else {
                        if (Auth::user()) {
                            $action_histories .= "<i class=\"fas fa-bolt fa-sm\" title=\"Last Action Performanced\"></i> ".$gen_jenkins_url.$action_text."</a> ";
                            if(Auth::user()->hasAnyRole(['advance', 'admin', 'superadmin'])) {
                                $show_warning = "Y"; //To check if warning message is to be shown or not
                            }
                        } else {
                            $action_histories .= "<i class=\"fas fa-bolt fa-sm\" title=\"Last Action Performanced\"></i> ".$action_text;
                        }
                    }

                    // Below going through different combinations of Status and running_jenkins_job
                    if (($status == "In Progress") && ($instanceDetail->running_jenkins_job == "Y" )) {
                        // if status is in progress and running_jenkins_job is y then it's shown as in progress
                        $action_histories .= "<i class=\"fas fa-sync fa-spin fa-sm\" title=\"Job in Progress\"></i><br>";
                        $action_histories .= "<i class=\"fas fa-clock fa-sm\" title=\"Start Time\"></i> ".trim($action_hist_record->start_time,'[]"')." IST<br>";
                    } elseif (($status == "In Progress") && ($instanceDetail->running_jenkins_job == "N" )) {
                        // if status is in progress and running_jenkins_job is n then it's shown as in progress but an exclamation mark is also shown as it means there is some problem
                        $action_histories .= "<br><i class=\"fas fa-exclamation-triangle fa-sm\" title=\"Status Mismatch\"></i> ";
                        if ($show_warning) {
                            $action_histories .= $status." / " .$instanceDetail->running_jenkins_job."<br>";
                        } else {
                            $action_histories .= "Mismatch Error<br>";
                        }
                        $status_td = "<td class=\"status_warning\">";
                    } elseif (($status == "Successful") && ($instanceDetail->running_jenkins_job == "Y" )) {
                        $action_histories .= "<br><i class=\"fas fa-exclamation-triangle fa-sm\" title=\"Status Mismatch\"></i> ";
                        if ($show_warning) {
                            $action_histories .= $status." / " .$instanceDetail->running_jenkins_job."<br>";
                        } else {
                            $action_histories .= "Mismatch Error<br>";
                        }
                        $status_td = "<td class=\"status_warning\">";
                    } elseif (($status == "Successful") && ($instanceDetail->running_jenkins_job == "N" )) {
                        $action_histories .= " <i class=\"far fa-check-circle fa-sm\" title=\"Successfull\"></i><br>";
                        $action_histories .= "<i class=\"fas fa-clock fa-sm\" title=\"Time\"></i> ".trim($action_hist_record->end_time,'[]"')." IST<br>";
                    } elseif ($status == "Failed") {
                        $action_histories .= "<i class=\"far fa-times-circle fa-sm\" title=\"Failed\"></i><br>";
                        $action_histories .= "<i class=\"fas fa-clock fa-sm\" title=\"Time\"></i> ".trim($action_hist_record->end_time,'[]"')." IST<br>";
                        $status_td = "<td class=\"status_failed\">";
                    } elseif ($status == "Scheduler")  {
                        // $action_histories .= "<br><i class=\"fas fa-exclamation-triangle fa-sm\" title=\"Status Mismatch\"></i> ";
                        $action_histories .= "<br><i class=\"fas fa-clock fa-sm\" title=\"Time\"></i> ".trim($action_hist_record->end_time,'[]"')." IST<br>";
                        $status_td = "<td class=\"status_warning\">";
                    }

                    $action_histories .= "<i class=\"fas fa-user fa-sm\" title=\"User\"></i> ".$username->name;
                    $action_histories .= "</small>";
                }

            ?>
            {{-- Below if block is to decide whether to show the data on site or not based on instance_show_on_site variable & roles --}}
            @if($instanceDetail->instance_show_on_site == "N")
                @if(Auth::guest())
                @php
                    $show_on_site = False
                @endphp
                @endif
                @hasanyrole('basic|zero')
                @php
                    $show_on_site = False
                @endphp
                @endhasanyrole
            @endif

        {{-- @endif --}}
            @if (!$show_on_site)
            {{-- Dont do anything --}}
            @else
                @if ($instanceDetail->in_use == "Y")
                    <tr class="inuse"> <!-- TR INUSE START -->
                @elseif ($instanceDetail->instance_is_active == "N")
                    @hasanyrole('advance|admin|superadmin')
                        <tr> <!-- TR START -->
                    @else
                        <tr class="disabled"> <!-- TR DISABLED START -->
                    @endhasanyrole
                @else
                    <tr> <!-- TR START -->
                @endif

                @hasanyrole('advance|admin|superadmin')
                    <td class="text-center">{!! $instanceDetail->id !!}</td> <!-- td-block INSTANCE ID -->
                @else
                    <td class="text-center">{!! $CX !!}</td> <!-- td-block INSTANCE # -->
                    @php
                    $CX++;
                    @endphp
                @endhasanyrole
                <td class="hidden"> <!-- start-td-block HIDDEN PRODUCT NAME -->
                    {!! $instanceDetail->product_names_by_id->product_short_name !!}
                </td> <!-- end-td-block HIDDEN PRODUCT NAME -->
                <td class="text-center"> <!-- start-td-block INSTANCE NAME LINK -->
                    <span class="instancce_name">
                        <a href="{!! route('instanceDetails.show', [$instanceDetail->id]) !!}">
                        {!! $instanceDetail->instance_name !!}
                    </a></span>
                    {!! $icon_list !!}
                    {{-- <span class="label label-default">PAI-Oracle</span>
                    <span class="label label-success">PAI-Hadoop</span> --}}
                </td> <!-- end-td-block INSTANCE NAME LINK -->

                <td class="text-center"> <!-- start-td-block RELEASE BUILD NUMBER -->
                    {{ trim($release_number,'[]"') }} {{ trim($build_number,'[]') }}
                    @if (!empty($release_number))
                        @if($is_rel_build == "Y")
                            <i class="fas fa-crown fa-xs" title="Release Build"></i>
                        @else
                        <br>
                        {{-- {{ $release_number }} {!! $build_number !!}<br> --}}
                            @if ($user_has_rights)
                                @can('upgrade_instanceDetails')
                                    @if($instanceDetail->show_jenkins_build == "Y")
                                        @if($instanceDetail->jenkins_url == "")
                                            <i class="fas fa-unlink" title="Jenkins URL missing"></i>
                                        @else
                                            @if($instanceDetail->running_jenkins_job == "Y" )
                                                <i class="fas fa-sync fa-spin" title="Job in Progress"></i>
                                            @elseif($instanceDetail->running_jenkins_job=='N' && $instanceDetail->instance_is_active == "Y")
                                                @if(strtotime($latest_build_date) > strtotime($existing_build_date))
                                                    {!! Form::open(['route' => ['instance.runjob','id' => $instanceDetail->id, 'action'=>'SPO_upgrade'], 'method' => 'post']) !!}
                                                    @csrf
                                                    {!! Form::button($update_text, ['type' => 'submit', 'class' => 'btn btn-primary btn-xs', 'onclick' => "return confirm('Are you sure you want to UPGRADE the BUILD ?')"])  !!}
                                                    {!! Form::close() !!}
                                                @else
                                                    <i class="fas fa-flag-checkered" title="Running latest build"></i>
                                                @endif
                                            @endif
                                        @endif
                                    @else
                                        @if($instanceDetail->running_jenkins_job == "Y" )
                                            <i class="fas fa-sync fa-spin" title="Restart in Progress"></i>
                                        @else
                                            @if(Auth::user())
                                                <i class="fas fa-ban" title="Build updates disabled"></i>
                                            @endif
                                        @endif
                                    @endif
                                @endcan
                            @endif
                        @endif
                    @endif
                </td> <!-- end-td-block RELEASE BUILD NUMBER -->
                <td class="hidden">{{ $intellicus_version }}</td> <!-- td-block HIDDEN INTELLICUS VERSION -->
                <td class="text-center"> <!-- start-td-block URL BUTTONS-->
                    <a href="{!! $generated_url !!}" title="{!! $generated_app_userpass !!}" target="_blank">{!! $link_icon !!}</a>
                    <small>{!! $intellicus !!}</small>
                </td> <!-- end-td-block URL BUTTONS -->

                <td> <!-- start-td-block APPLICATION SERVER DETAILS -->
                    @if ($instanceDetail->in_use == "Y")
                        <div style="color:blue;font-size:20px;font-weight:bold">Instance is in Use
                            {!! $instanceDetail->in_use_msg ?? '' !!}
                        </div>
                    @endif
                    {!! $appDetails !!}
                </td> <!-- end-td-block APPLICATION SERVER DETAILS -->
                <td> <!-- start-td-block DATABASE SERVER DETAILS -->
                    @if ($instanceDetail->in_use == "Y")
                        <div style="color:blue;font-size:20px;font-weight:bold">!! Dont Use It !!</div>
                    @endif
                    {!! $dbDetails !!}
                </td> <!-- end-td-block DATABASE SERVER DETAILS -->
                <td class="hidden">{!! $instanceDetail->jdk_type !!}</td> <!-- td-block HIDDEN JDK DETAILS -->
                <td>{!! $ap_heapsize !!} {!! $web_heapsize !!}</td> <!-- td-block HEAP SIZES -->
                <td> {!! $team_name !!} </td> <!-- td-block TEAM NAMES -->
                {!! $status_td !!}  <!-- start-td-block ACTION HISTORY -->
                {!! $action_histories !!}
                </td> <!-- end-td-block ACTION HISTORY -->

                <td class="hidden">{!! $instanceDetail->instance_note !!}</td> <!-- td-block HIDDEN NOTE -->

                @hasanyrole('advance|admin|superadmin')
                    <td class="text-center"> <!-- start-td-block TOMCAT SERVICE NAME -->
                        @empty($instanceDetail->tomcat_service_name || $instanceDetail->ap_service_name)
                        @else
                        <i class="far fa-check-circle" title="Service Name defined"></i>
                        @endempty
                    </td> <!-- end-td-block TOMCAT SERVICE NAME -->
                    {{-- <td class="text-center">{!! $instanceDetail->instance_jira !!} </td> --}}
                    @if($instanceDetail->instance_is_active == "Y")
                        <td class="text-center"> <!-- start-td-block INSTANCE IS ACTIVE YES -->
                            <i class="far fa-check-circle" title="YES"></i>
                    @else
                        <td class="danger text-center"> <!-- start-td-block INSTANCE IS ACTIVE NO -->
                            <i class="far fa-times-circle" title="NO"></i>
                    @endif
                    </td> <!-- end-td-block INSTANCE IS ACTIVE YES/NO -->
                    @if($instanceDetail->instance_show_on_site == "Y")
                        <td class="text-center"> <!-- start-td-block SHOW ON SITE YES-->
                            <i class="far fa-check-circle" title="YES"></i>
                    @else
                        <td class="danger text-center"> <!-- start-td-block SHOW ON SITE NO -->
                            <i class="far fa-times-circle" title="NO"></i>
                    @endif
                    </td> <!-- end-td-block SHOW ON SITE YES/NO -->
                @endhasanyrole
                @canany('restart_instanceDetails','edit_instanceDetails','delete_instanceDetails')
                <td class="text-center"> <!-- start-td-block ACTION ICONS -->
                    @if ($user_has_rights)
                        <div class="btn-group-vertical">
                            @can('edit_instanceDetails')
                                {!! Form::open(['route' => ['instanceDetails.edit', $instanceDetail->id], 'method' => 'get']) !!}
                                {!! Form::button('<i class="fas fa-pencil-alt" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-xs']) !!}
                                {!! Form::close() !!}
                            @endcan

                            @if ($instanceDetail->running_jenkins_job == "Y")
                            {{--If Jenkins URL is not present don't show start/stop button--}}
                            @else
                                @if(!empty($instanceDetail->jenkins_url))
                                    @if($instanceDetail->instance_is_active == "N")
                                    {{-- If instance is not active, then show button to start the instance --}}
                                        @can('start_instanceDetails')
                                            {!! Form::open(['route' => ['instance.runjob','id' => $instanceDetail->id, 'action'=>'StartAppServer'], 'method' => 'post']) !!}
                                            {!! Form::button('<i class="far fa-play-circle" title="Start Instance"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-xs', 'onclick' => "return confirm('You want to START the instance?')"])  !!}
                                            {!! Form::close() !!}
                                        @endcan
                                        @if($instanceDetail->instance_is_active == "Y")
                                            @can('stop_instanceDetails')
                                                {!! Form::open(['route' => ['instance.runjob','id' => $instanceDetail->id, 'action'=>'ShutDownAppServer'], 'method' => 'post']) !!}
                                                {!! Form::button('<i class="far fa-stop-circle" title="Stop Instance"></i>', ['type' => 'submit', 'class' => 'btn btn-warning btn-xs', 'onclick' => "return confirm('You want to STOP the instance?')"]) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        @endif
                                    @else
                                    {{-- If instance is active, then show button to stop the instance --}}
                                        @can('stop_instanceDetails')
                                            {!! Form::open(['route' => ['instance.runjob','id' => $instanceDetail->id, 'action'=>'ShutDownAppServer'], 'method' => 'post']) !!}
                                            {!! Form::button('<i class="far fa-stop-circle" title="Stop Instance"></i>', ['type' => 'submit', 'class' => 'btn btn-warning btn-xs', 'onclick' => "return confirm('You want to STOP the instance?')"]) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                        @can('restart_instanceDetails')
                                    {{--  @if ($instanceDetail->running_jenkins_job == "Y")--}}
                                        {{-- If any jenkins job is already running then don't show button to restart instance --}}
                                        {{-- @else--}}
                                            {!! Form::open(['route' => ['instance.runjob','id' => $instanceDetail->id, 'action'=>'Restart'], 'method' => 'post']) !!}
                                            {!! Form::button('<i class="fas fa-sync" title="Restart Instance"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-xs', 'onclick' => "return confirm('You want to RESTART the instance?')"  ]) !!}
                                            {!! Form::close() !!}
                                        {{-- @endif--}}
                                        @endcan
                                        @if($instanceDetail->instance_is_active == "N")
                                            {{-- If instance is not active, then show button to start the instance --}}
                                            @can('start_instanceDetails')
                                                {!! Form::open(['route' => ['instance.runjob','id' => $instanceDetail->id, 'action'=>'StartAppServer'], 'method' => 'post']) !!}
                                                {!! Form::button('<i class="far fa-play-circle" title="Start Instance"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-xs', 'onclick' => "return confirm('You want to START the instance?')"])  !!}
                                                {!! Form::close() !!}
                                            @endcan
                                        @endif
                                    @endif
                                    {{-- @can('delete_instanceDetails')
                                        {!! Form::open(['route' => ['instanceDetails.destroy', $instanceDetail->id], 'method' => 'delete']) !!}
                                        {!! Form::button('<i class="fas fa-trash" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to delete this instance details?')"]) !!}
                                        {!! Form::close() !!}
                                    @endcan --}}
                                @else
                                    {{-- @can('delete_instanceDetails')
                                        {!! Form::open(['route' => ['instanceDetails.destroy', $instanceDetail->id], 'method' => 'delete']) !!}
                                        {!! Form::button('<i class="fas fa-trash" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to delete this instance details?')"]) !!}
                                        {!! Form::close() !!}
                                    @endcan --}}
                                @endif
                            @endif
                        </div>
                    @endif
                </td> <!-- end-td-block ACTION ICONS -->
                @endcanany

            </tr>  <!-- TR END -->
            @endif
        @endforeach

        @endforeach
    @endif
    @php
        // fputcsv($f, $gurl_arr);
        // // header('Content-Type: text/csv');
        // // header('Content-Disposition: attachment; filename="' . $filename . '";');
        // fclose($f);
    @endphp
    </tbody>
</table>

