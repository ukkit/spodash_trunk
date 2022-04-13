    <?php
        $CX=1;
        // $filename = "instances_" . date('YmdHis') . ".csv";
        // // $f = fopen($filename, 'w');
        // $f = fopen('php://output', 'w');
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
                <th class="text-center column_6pct">Build</th>
                <th class="hidden">Intellicus</th>
                <th class="text-center column_7pct">Login</th>
                <th class="details_column">App Details</th>
                <th class="details_column">DB Details</th>
                <th class="hidden">JDK Type</th>
                <th class="column_6pct">Heapsize (MB)</th>
                {{-- <th class="">Heapsize (MB)</th> --}}
                <th class="column_6pct">Used By</th>
                <th class="column_10pct">User Actions</th>
                <th class="hidden">Switches</th> <!-- DEFINING SNOWFLAKE OR CONTRAST OR OTHER SWITCHES -->
                <th class="hidden">Notes</th>
                @hasanyrole('advance|admin|superadmin')
                    <th class="text-center width_15px"><i class="fas fa-cog" title="Tomcat/Autopilot Service Name defined"></i></th>
                    {{-- <th class="text-center"><i class="fab fa-jira" title="JIRA Number(s)"></i></th> --}}
                    <th class="text-center width_15px"><i class="fas fa-heartbeat" title="Instance is Active"></i></th>
                    <th class="text-center width_15px"><i class="fas fa-tachometer-alt" title="Show on Dashboard"></i></th>
                @endhasanyrole
                @canany('restart_instanceDetails','edit_instanceDetails')
                    <th class="text-center icon_column"><i class="fas fa-tools" title="User Actions"></i></th>
                @endcanany
                @can('delete_instanceDetails')
                    <th class="text-center icon_column"><i class="fas fa-user-cog" title="Admin Actions"></i></th>
                @endcan
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
                    $show_on_site = True;
                    $hidden_figures = "";
                    $current_pai = null;
                    $has_snowflake = False;
                    $spm_build_display = "";
                    $paisf_build_display = "<div class=\"paisf_build_display\">";
                    $user = Auth::user();
                    $do_continue = True;
                    $show_spm_upgrade_btn = False;
                    $show_paisf_upgrade_btn = False;
                    $show_both_upgrade_btn = False;
                    $some_text = "";
                    $sf_pv_id = null;
                    $pai_pv_id = null;
                    $both_action_name = null;
                    $both_update_text = null;
                    $both_title_text = null;
                    // $is_pai_rel_build = "N";
                    // $is_spm_rel_build = "N";

                    try {
                        $server_ip = $instanceDetail->server_details_by_id->server_ip;
                        $server_name = $instanceDetail->server_details_by_id->server_name;
                    } catch (\Throwable $th) {
                        Log::error("Unable to get server details for server_id ".$instanceDetail->server_details_id." for instance_details_id ".$instanceDetail->id);
                        $server_ip = null;
                        $server_name = null;
                    }
                    $generated_log_dir = "\\\\" . $server_ip . "\\" . $instanceDetail->instance_shared_dir;

                    // Get product short name
                    $product_short_name = $instanceDetail->product_names_by_id->product_short_name;

                    // Check if PAI repository is defined, this will be used to sow pai-oracle
                    try {
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

                    if($instanceDetail->jdk_type == "Amazon Corretto") {
                        $icon_list .= "<i class=\"fab fa-amazon\" title=\"Amazon Corretto JDK\"></i> ";
                        $hidden_figures .= "Amazon Corretto ";
                    } elseif($instanceDetail->jdk_type == "Oracle JDK") {
                        $icon_list .= " <i class=\"fab fa-java\" title=\"Oracle JDK\"></i> ";
                        $hidden_figures .= "Oracle-JDK ";
                    }
                    if($instanceDetail->is_insight_enabled == "Y") {
                        $icon_list .= " <i class=\"fas fa-info\" title=\"Insight Configured\"></i> ";
                        $hidden_figures .= "Insight ";
                    }

                    if (!empty($instanceDetail->sf_pv_id)){
                        // $icon_list .= " <i class=\"far fa-snowflake\" title=\"Snowflake Configured\"></i> ";
                        $icon_list .= "<span class=\"snow small\">snowflake</span> ";
                        $hidden_figures .= "Snowflake ";
                    } elseif (!empty($instanceDetail->ml_details_id)) {
                        $icon_list .= "<span class=\"foundation small\">Machine-Learning</span> ";
                        $hidden_figures .= "ML ";
                        $hidden_figures .= "Machine Learning ";
                    } else {
                        if(($pai_type == "pai" && $pai_db_type == "oracle")) {
                            $icon_list .= "<span class=\"grey small\">PAI-Oracle</span> ";
                            $hidden_figures .= "PAI-Oracle ";
                        } elseif(($pai_type == "pai" && $pai_db_type == "hadoop")) {
                            $icon_list .= "<span class=\"grey small\">PAI-Hadoop</span> ";
                            $hidden_figures .= "Hadoop ";
                        } elseif ($instanceDetail->pai_foundation == "Y") {
                            $icon_list .= "<span class=\"foundation small\">PAI-Foundation</span> ";
                            $hidden_figures .= "PAI-Foundation ";
                        }
                    }
                    if($instanceDetail->is_contrast_configured == "Y") {
                        $icon_list .= " <i class=\"fas fa-shield-alt\" title=\"Contrast Configured\"></i> ";
                        $hidden_figures .= "Contrast ";
                    }
                    if($instanceDetail->check_fail_count > 0) {
                        $icon_list .= " <i class=\"fas fa-stethoscope\" title=\"CFT - $instanceDetail->check_fail_count\"></i> ";
                        $hidden_figures .= "CFT ";
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
                                if ($tna == "All") {
                                    $team_name .= "Everyone";
                                    $for_everyone = True;
                                } else {
                                    $team_name .= $tna;
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
                        Log::error($th);
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
                        $ml_btn_type = "btn-disabled";
                    } elseif ($instanceDetail->in_use == "Y") {
                        $app_btn_type = "btn-instance-inuse";
                        $intell_btn_type = "btn-intellicus-inuse";
                        $ml_btn_type = "btn-ml-inuse";
                    } else {
                        $app_btn_type = "btn-instance";
                        $intell_btn_type = "btn-intellicus";
                        $ml_btn_type = "btn-ml";
                    }

                    if($instanceDetail->is_https == "Y") {
                        $http_tag = "https";
                        $http_icon = "<button type=\"button\" class=\"btn $app_btn_type btn-xs xsmall\" title=\"$generated_app_userpass\"> ".strtoupper($product_short_name)."</button>";
                        // $http_icon = "<button type=\"button\" class=\"btn $app_btn_type btn-xs xsmall\" title=\"$generated_app_userpass\"><i class=\"fas fa-lock fs-sm\" ></i> ".strtoupper($product_short_name)."</button>";
                    } else {
                        $http_tag = "http";
                        $http_icon = "<button type=\"button\" class=\"btn $app_btn_type btn-xs xsmall\" title=\"$generated_app_userpass\"> ".strtoupper($product_short_name)."</button>";
                        // $http_icon = "<button type=\"button\" class=\"btn $app_btn_type btn-xs xsmall\" title=\"$generated_app_userpass\"><i class=\"fas fa-lock-open fa-sm\" ></i> ".strtoupper($product_short_name)."</button>";
                    }

                    if ($for_everyone)  {
                        $show_userpass = True;
                    } elseif (($instanceDetail->enable_instance_auto_login == "Y") && ($user_has_rights))  {
                        $show_userpass = True;
                    }
                    if ($instanceDetail->in_use == "Y") {
                        $show_userpass = NULL;
                        $generated_app_userpass = "";
                    }

                    $spmspp_btn = "";
                    if (is_null($server_name)) {
                        $spmspp_btn .= "<i class=\"fas fa-exclamation-triangle\"></i>";
                    } else {
                        $generated_url = $http_tag."://" . $server_name .":".$instanceDetail->instance_tomcat_port ."/WebUI/";
                        $gen_title = "";
                        if ($show_userpass) {
                            $generated_url .= "?txtUsername=".$instanceDetail->instance_login."&txtPassword=".$instanceDetail->instance_pwd;
                            $gen_title = "Username/Password: ".$instanceDetail->instance_login."/ ".$instanceDetail->instance_pwd;
                        }
                        $spmspp_btn .= "<a href=\"". $generated_url ."\" title=\"".$generated_app_userpass."\" target=\"_blank\">";
                        $spmspp_btn .= "<button type=\"button\" class=\"btn $app_btn_type btn-xs xsmall\" title=\"".$gen_title."\">".strtoupper($product_short_name)."</button></a>";
                    }

                    // SPM BUILD AND RELEASE NUMBERS
                    try {
                        $spm_build = $instanceDetail->product_versions_by_pvid($instanceDetail->pv_id);
                        $current_spm_release = $spm_build->product_ver_number;

                        $current_spm_build = $spm_build->product_build_numer;
                        // dd($spm_build->pv_id);
                        $current_spm_date = $spm_build->created_at;

                        $newest_spm_build = $instanceDetail->latest_build_number_by_version($current_spm_release)->product_build_numer;
                        $newest_spm_date = $instanceDetail->return_build_creation_date($current_spm_release,$newest_spm_build)->created_at;

                        $spm_update_text = "<i class=\"fas fa-level-up-alt\" title=\"Upgrade to SPO ". $current_spm_release ." Build  ". $newest_spm_build ."\"></i> ".$newest_spm_build;

                        $is_spm_rel_build = $spm_build->is_release_build;
                        $spm_rl_build_id = $spm_build->id;
                    } catch (\Throwable $th) {
                        //throw $th;
                        Log::debug('Build details (pv_id '.$instanceDetail->pv_id.') are not available for Instance '. $instanceDetail->instance_name .' (instance_id: '.$instanceDetail->id.')');
                        $current_spm_release = null;
                        $current_spm_build = null;
                        $spm_rl_build_id = null;
                        $is_spm_rel_build = "N";
                    }

                    if (!empty($current_spm_release)) {
                        $spm_build_display .= $current_spm_release ." <strong>". $current_spm_build."</strong>";
                        if($is_spm_rel_build == "Y") {
                            if (Auth::check() && $user->hasanyrole('advance|admin|superadmin')) {
                                $spm_build_display .= "<a href=\"".route('productVersions.show', [$spm_rl_build_id])."\"> <i class=\"fas fa-crown fa-xs\" title=\"Release Build\"></i></a>";
                            } else {
                                $spm_build_display .= " <i class=\"fas fa-crown fa-xs\" title=\"Release Build\"></i>";
                            }
                        } else {
                            if (($user_has_rights && $user->can('upgrade_instanceDetails'))) {
                                if($instanceDetail->show_jenkins_build == "Y") {
                                    if($instanceDetail->jenkins_url == "") {
                                        $spm_build_display .= "<i class=\"fas fa-unlink\" title=\"Jenkins URL missing\"></i>";
                                    } else {
                                        if($instanceDetail->running_jenkins_job=='Y') {
                                            $spm_build_display .= " <i class=\"fas fa-sync fa-spin\" title=\"Job in Progress\"></i>";
                                        } elseif  ($instanceDetail->running_jenkins_job=='N' && $instanceDetail->instance_is_active == "Y") {
                                            if(strtotime($newest_spm_date) > strtotime($current_spm_date)) {
                                                $show_spm_upgrade_btn = True;
                                                $show_both_upgrade_btn = True;
                                            } else {
                                                $spm_build_display .= " <i class=\"fas fa-flag-checkered\" title=\"Latest SPM build deployed\"></i>";
                                            }
                                        }
                                    }
                                } else {
                                    if($instanceDetail->running_jenkins_job == "Y" ) {
                                        $spm_build_display .= " <i class=\"fas fa-sync fa-spin\" title=\"Job in Progress\"></i>";
                                    } else {
                                        if(Auth::user()) {
                                            $spm_build_display .= " <i class=\"fas fa-ban\" title=\"Build updates disabled\"></i>";
                                        }
                                    }
                                }
                            }
                        }
                    }

                    // GENERATING SNOWFLAKE BUILD NUMBER DETAILS
                    $sf_pv_id = $instanceDetail->sf_pv_id;
                    $pai_pv_id = $instanceDetail->pai_pv_id;
                    if (!isNullOrEmpty($sf_pv_id)) {
                        try {
                            $sf_build = $instanceDetail->sf_builds_by_pvid($sf_pv_id);
                            $current_sf_release = $sf_build->sf_pai_version;
                            $current_sf_build = $sf_build->sf_pai_build;
                            $current_sf_date = $sf_build->created_at;
                            $is_sf_rel_build = $sf_build->is_release_build;

                            $newest_sf = $instanceDetail->latest_sf_build_number_by_version($current_sf_release);
                            $newest_sf_build = $newest_sf->sf_pai_build;
                            $newest_sf_date = $newest_sf->created_at;
                            $has_snowflake = True;

                            $sf_update_text = "<i class=\"fas fa-level-up-alt\" title=\"Upgrade Snowflake to ". $current_sf_release ." Build ". $newest_sf_build ."\"></i> ".$newest_sf_build;
                            $sf_title_text = "Upgrade SnowFlake to ".$current_sf_release . " Build ".$newest_sf_build;
                        } catch (\Throwable $th) {
                            Log::error("Error getting data for SF_PV_ID " . $sf_pv_id, [$th]);
                            $sf_build = null;
                            $current_sf_release = null;
                            $current_sf_build = null;
                            $current_sf_date = null;
                            $newest_sf = null;
                            $newest_sf_build = null;
                            $newest_sf_date = null;
                            $sf_title_text = null;
                            $is_sf_rel_build = "N";
                        }
                    } elseif (!isNullOrEmpty($pai_pv_id)) {
                        try {
                            $pai_build = $instanceDetail->pai_versions_by_pvid($pai_pv_id);
                            $current_pai_release = $pai_build->pai_version;
                            $current_pai_build = $pai_build->pai_build;
                            $current_pai_date = $pai_build->created_at;
                            $is_pai_rel_build = $pai_build->is_release_build;

                            $newest_pai = $instanceDetail->latest_pai_build_number_by_version($current_pai_release);
                            $newest_pai_build = $newest_pai->pai_build;
                            $newest_pai_date = $newest_pai->created_at;

                            $pai_update_text = "<i class=\"fas fa-level-up-alt\" title=\"Upgrade to PAI ". $current_pai_release ." Build ". $newest_pai_build ."\"></i> ".$newest_pai_build;
                            $pai_title_text = "Upgrade PAI to ".$current_pai_release . " Build ".$newest_pai_build;
                            $has_snowflake = False;
                        } catch (\Throwable $th) {
                            Log::error("[$instanceDetail->id] Error getting data for  PAI_PV_ID " . $pai_pv_id, [$th]);
                            $current_pai_release = null;
                            $current_pai_build = null;
                            $newest_pai_build = null;
                            $newest_pai_date = null;
                            $current_pai_date = null;
                            $pai_update_text = null;
                            $pai_title_text = null;
                            $is_pai_rel_build = "N";
                        }
                    }

                    // PAI/SNOWFLAKE UPGRADE DETAILS HERE

                    if ($has_snowflake) {
                        // $paisf_build_display .= "<br>".$current_sf_release." <strong>".$current_sf_build."</strong>";
                        $paisf_build_display .= $current_sf_release." <strong>".$current_sf_build."</strong>";
                        if ($is_sf_rel_build == "Y") {
                            $paisf_build_display .= " <i class=\"fas fa-crown fa-xs\" title=\"Release Build\"></i>";
                            $do_continue = False;
                            $show_both_upgrade_btn = False;
                        } else {
                            // $paisf_build_display .= "<br>";
                            if (strtotime($newest_sf_date) > strtotime($current_sf_date)) {
                                $action_name = "SF_upgrade";
                                $update_text = $sf_update_text;
                                $onclick = "return confirm(\'Are you sure you want to UPGRADE Snowflake build?\')";
                                $title_text = $sf_title_text;
                                if ($show_both_upgrade_btn) {
                                    $both_action_name = "SPM_SF_upgrade";
                                    $both_onclick = "return confirm(\'Are you sure you want to UPGRADE SPM and Snowflake both?\')";
                                    $both_title_text = "Upgrade SPM and Snowflake both";
                                    $both_update_text = " <i class=\"fas fa-level-up-alt\" title=\"Upgrade SPM and Snowflake builds\"></i> BOTH";
                                }
                            } else {
                                $paisf_build_display .= " <i class=\"fas fa-flag-checkered\" title=\"Latest Snowflake build deployed\"></i>";
                                $do_continue = False;
                                $show_both_upgrade_btn = False;
                            }
                        }
                    } else { // SHOW PAI DETAILS
                        if (empty($current_pai_release)) {
                            $do_continue = False;
                            $show_both_upgrade_btn = False;
                        } else {
                            // $paisf_build_display .= "<br>".$current_pai_release." <strong>".$current_pai_build."</strong>";
                            $paisf_build_display .= $current_pai_release." <strong>".$current_pai_build."</strong>";
                            if ($is_pai_rel_build == "Y") {
                                $paisf_build_display .= " <i class=\"fas fa-crown fa-xs\" title=\"Release Build\"></i><br>";
                                $do_continue = False;
                                $show_both_upgrade_btn = False;
                            } else {
                                // $paisf_build_display .= "<br>";
                                if (strtotime($newest_pai_date) > strtotime($current_pai_date)) {
                                    $action_name = "PAI_upgrade";
                                    $onclick = "return confirm";
                                    $title_text = $pai_title_text;
                                    $update_text = $pai_update_text;
                                    if ($show_both_upgrade_btn) {
                                        $both_action_name = "SPM_PAI_upgrade";
                                        $both_onclick = "return confirm(\'Are you sure you want to UPGRADE SPM and PAI both?\')";
                                        $both_title_text = "Upgrade SPM and PAI both";
                                        $both_update_text = " <i class=\"fas fa-level-up-alt\" title=\"Upgrade SPM and PAI builds\"></i> BOTH";
                                    }
                                } else {
                                    $paisf_build_display .= " <i class=\"fas fa-flag-checkered\" title=\"Latest PAI build deployed\"></i>";
                                    $do_continue = False;
                                    $show_both_upgrade_btn = False;
                                }
                            }
                        }
                    }

                    // dd($paisf_build_display);
                    if ($do_continue) {
                        if (($user_has_rights && $user->can('upgrade_instanceDetails'))) {
                            if($instanceDetail->show_jenkins_build == "Y") {
                                if($instanceDetail->jenkins_url == "") {
                                    $paisf_build_display .= "<i class=\"fas fa-unlink\" title=\"Jenkins URL missing\"></i>";
                                } else {
                                    if($instanceDetail->running_jenkins_job=='Y') {
                                        $paisf_build_display .= "<i class=\"fas fa-unlink\" title=\"Jenkins URL missing\"></i>";
                                    } elseif($instanceDetail->running_jenkins_job=='N' && $instanceDetail->instance_is_active == "Y") {
                                        $show_paisf_upgrade_btn = True;
                                    }
                                }
                            } else {
                                if($instanceDetail->running_jenkins_job == "Y" ) {
                                    $paisf_build_display .= " <i class=\"fas fa-sync fa-spin\" title=\"Job in Progress\"></i>";
                                } else {
                                    if(Auth::user()) {
                                        $paisf_build_display .= " <i class=\"fas fa-ban\" title=\"Build updates disabled\"></i>";
                                    }
                                }
                            }
                        }
                    }

                    $paisf_build_display .= "</div>";

                    // DB SERVER DETAILS
                    try {
                        $dbServerDetails = $instanceDetail->return_db_server_details($instanceDetail->database_details_id);
                        $generated_db_userpass = $instanceDetail->database_details_by_id->db_user."/".$instanceDetail->database_details_by_id->db_pass;

                        if ($instanceDetail->database_details_by_id->db_user == $instanceDetail->database_details_by_id->db_pass ) {
                            $generated_connect = $instanceDetail->database_details_by_id->db_user."@".$instanceDetail->database_details_by_id->db_sid;
                        } else {
                            $generated_connect = $generated_db_userpass."@".$instanceDetail->database_details_by_id->db_sid;
                        }

                        $generated_db_server = $dbServerDetails->server_name." (".$dbServerDetails->server_ip.")";

                        $dbDetails = "";
                        // $dbDetails = "<small>";
                        $dbDetails .= "<i class=\"fas fa-server fa-sm\"  title=\"Server Name\"></i> <a href=".route('serverDetails.show', $dbServerDetails->id).">".$generated_db_server."</a><br>";
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
                        $generated_app_server = $instanceDetail->server_details_by_id->server_name." (".$server_ip.")";
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

                    // ML DETAILS
                    $ml_details = "";
                    if(!empty($instanceDetail->ml_details_id)) {
                        try {
                            $ml_server_name = $instanceDetail->return_server_details_by_id($instanceDetail->mlDetail->server_details_id,'server_name')->get('0');
                            $ml_server_ip = $instanceDetail->return_server_details_by_id($instanceDetail->mlDetail->server_details_id,'server_ip')->get('0');
                            // $ml_details = $ml_server_name;
                            $ml_url = "http://".$ml_server_ip.":".$instanceDetail->mlDetail->zeppelin_port."/";
                            $ml_details = "<a href=\"".$ml_url."\" target=\"_blank\">";
                            $ml_details .= "<button type=\"button\" class=\"btn $ml_btn_type btn-xs xsmall\">".$instanceDetail->mlDetail->ml_name."</button></a>";

                        } catch (\Throwable $th) {
                            $ml_server_name = null;
                        }
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

                            $intellicus = "<a href=\"".$intell_url."\" target=\"_blank\">";

                            $button = $string = str_replace(' ', '', $intell_ver);
                            if (! empty($intell_patch)){
                                $X1 = explode('Patch', $intell_patch);
                                $button .= "p".trim($X1[1]);
                            }

                            $intell_is_https = $instanceDetail->intellicus_details_by_id->is_https;
                            // if ($intell_is_https == "Y") {
                            //     $intell_icon = "<i class=\"fas fa-lock fa-sm\" ></i>";
                            // } else {
                            //     $intell_icon = "<i class=\"fas fa-lock-open fa-sm\" ></i>";
                            // }

                            if (Auth::user() && ($user_has_rights)) {
                                $intellicus .= "<button type=\"button\" class=\"btn $intell_btn_type btn-xs xsmall\" title=\"Intellicus User/Pass: $intell_userpass\"> $button</button></a>";
                            } else {
                                $intellicus .= "<button type=\"button\" class=\"btn $intell_btn_type btn-xs xsmall\" > $button</button></a>";
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
                        $action_text = get_action_text($action_done);

                        $action_histories = "<small>";
                        // $action_histories = "";
                        $gen_jenkins_url = "<a href=\"".$instanceDetail->jenkins_url."/".$action_hist_record->jenkins_build_id."/console\" target=\"_blank\"> ";
                        if ($status == "Failed") {
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
                    @unlessrole('advance|admin|superadmin')
                    @php
                        $show_on_site = False
                    @endphp
                    @endunlessrole
                @endif {{-- @endif --}}


                @if (!$show_on_site)
                {{-- Dont do anything --}}
                @else

                    @if ($instanceDetail->instance_is_active == "N")
                        @hasanyrole('advance|admin|superadmin')
                            <tr> <!-- TR START -->
                        @else
                            <tr class="disabled"> <!-- TR DISABLED START -->
                        @endhasanyrole
                    @else
                        @if ($instanceDetail->in_use == "Y")
                            <tr class="inuse"> <!-- TR INUSE START -->
                        @else
                            <tr> <!-- TR START -->
                        @endif
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
                        {!! strtoupper($product_short_name) !!}
                    </td> <!-- end-td-block HIDDEN PRODUCT NAME -->

                    <td class="text-center"> <!-- start-td-block INSTANCE NAME LINK -->
                        <span class="instancce_name">
                            <a href="{!! route('instanceDetails.show', [$instanceDetail->id]) !!}">
                            {!! $instanceDetail->instance_name !!}
                        </a></span>
                        {!! $icon_list !!}
                    </td> <!-- end-td-block INSTANCE NAME LINK -->

                    <td class="text-center"> <!-- start-td-block RELEASE BUILD NUMBER -->
                        {{-- SPM Build Number and upgrade button --}}
                        {!! $spm_build_display !!}
                        @if($show_spm_upgrade_btn)
                            {!! Form::open(['route' => ['instance.runjob','id' => $instanceDetail->id, 'action'=>'SPO_upgrade'], 'method' => 'post']) !!}
                            @csrf
                            {!! Form::button($spm_update_text, ['type' => 'submit', 'class' => 'btn btn-primary btn-xs btn-upgrade-top', 'onclick' => "return confirm('Are you sure you want to UPGRADE SPM BUILD ?')", 'title' => 'upgrade SPM build'])  !!}
                            {!! Form::close() !!}
                        @endif

                        {{-- PAI BUILD NUMBER AND UPGRADE BUTTON --}}
                        {!! $paisf_build_display !!}
                        @if ($show_paisf_upgrade_btn)
                            {!! Form::open(['route' => ['instance.runjob','id' => $instanceDetail->id, 'action'=>$action_name], 'method' => 'post']) !!}
                            @csrf
                            @if ($has_snowflake)
                                {!! Form::button($update_text, ['type' => 'submit', 'class' => 'btn btn-warning btn-xs btn-upgrade-other', 'onclick' => "return confirm('Are you sure you want to UPGRADE Snowflake build?')", 'title' => $title_text])  !!}
                            @else
                                {!! Form::button($update_text, ['type' => 'submit', 'class' => 'btn btn-warning btn-xs btn-upgrade-other', 'onclick' => "return confirm('Are you sure you want to UPGRADE PAI build?')", 'title' => $title_text])  !!}
                            @endif
                            {!! Form::close() !!}
                        @endif

                        @if($show_both_upgrade_btn)
                            {!! Form::open(['route' => ['instance.runjob','id' => $instanceDetail->id, 'action'=>$both_action_name], 'method' => 'post']) !!}
                            @csrf
                            @if ($has_snowflake)
                                {!! Form::button($both_update_text, ['type' => 'submit', 'class' => 'btn btn-success btn-xs btn-upgrade-other', 'onclick' => "return confirm('Are you sure you want to UPGRADE SPM and Snowflake both?')", 'title' => $both_title_text])  !!}
                            @else
                                {!! Form::button($both_update_text, ['type' => 'submit', 'class' => 'btn btn-success btn-xs btn-upgrade-other', 'onclick' => "return confirm('Are you sure you want to UPGRADE SPM and PAI both?')", 'title' => $both_title_text])  !!}
                            @endif
                            {!! Form::close() !!}
                        @endif

                    </td> <!-- end-td-block RELEASE BUILD NUMBER -->

                    <td class="hidden">{{ $intellicus_version }}</td> <!-- td-block HIDDEN INTELLICUS VERSION -->

                    <td class="text-center"> <!-- start-td-block URL BUTTONS-->
                        {{-- @if(is_null($generated_url))
                            <i class="fas fa-exclamation-triangle"></i>
                        @else
                            <a href="{!! $generated_url !!}" title="{!! $generated_app_userpass !!}" target="_blank">{!! $link_icon !!}</a>
                        @endif --}}
                        <small>{!! $spmspp_btn !!}</small>
                        <small>{!! $intellicus !!}</small>
                        <small>{!! $ml_details !!}</small>
                    </td> <!-- end-td-block URL BUTTONS -->

                    <td> <!-- start-td-block APPLICATION SERVER DETAILS -->
                        {!! $appDetails !!}
                        @if ($instanceDetail->in_use == "Y")
                        <div class="for-demo text-center">
                            {!! strtoupper($instanceDetail->in_use_msg) ?? '' !!}
                        </div>
                        @endif
                    </td> <!-- end-td-block APPLICATION SERVER DETAILS -->
                    <td> <!-- start-td-block DATABASE SERVER DETAILS -->
                        {{-- @if ($instanceDetail->in_use == "Y")
                            <div style="color:blue;font-size:20px;font-weight:bold">!! Dont Use It !!</div>
                        @endif --}}
                        {!! $dbDetails !!}
                    </td> <!-- end-td-block DATABASE SERVER DETAILS -->
                    <td class="hidden">{!! $instanceDetail->jdk_type !!}</td> <!-- td-block HIDDEN JDK DETAILS -->
                    <td>{!! $ap_heapsize !!} {!! $web_heapsize !!}</td> <!-- td-block HEAP SIZES -->
                    <td> {!! $team_name !!} </td> <!-- td-block TEAM NAMES -->
                    {!! $status_td !!}  <!-- start-td-block ACTION HISTORY -->
                    {!! $action_histories !!}
                    </td> <!-- end-td-block ACTION HISTORY -->

                    <td class="hidden">{!! $hidden_figures !!}</td> <!-- td-block HIDDEN NOTE -->
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
                                @if ($instanceDetail->running_jenkins_job == "Y")
                                {{--If Jenkins URL is not present don't show start/stop button--}}
                                @else
                                    @if(!empty($instanceDetail->jenkins_url))
                                        @if($instanceDetail->instance_is_active == "N")
                                        {{-- If instance is not active, then show button to start the instance --}}
                                            @can('start_instanceDetails')
                                                {!! Form::open(['route' => ['instance.runjob','id' => $instanceDetail->id, 'action'=>'StartAppServer'], 'method' => 'post']) !!}
                                                {!! Form::button('<i class="far fa-play-circle" title="Start Instance"></i>', ['type' => 'submit', 'class' => 'btn btn-start btn-xs', 'onclick' => "return confirm('You want to START the instance?')"])  !!}
                                                {!! Form::close() !!}
                                            @endcan
                                            @if($instanceDetail->instance_is_active == "Y")
                                                @can('stop_instanceDetails')
                                                    {!! Form::open(['route' => ['instance.runjob','id' => $instanceDetail->id, 'action'=>'ShutDownAppServer'], 'method' => 'post']) !!}
                                                    {!! Form::button('<i class="far fa-stop-circle" title="Stop Instance"></i>', ['type' => 'submit', 'class' => 'btn btn-stop btn-xs', 'onclick' => "return confirm('You want to STOP the instance?')"]) !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            @endif
                                        @else
                                        {{-- If instance is active, then show button to stop the instance --}}
                                            @can('stop_instanceDetails')
                                                {!! Form::open(['route' => ['instance.runjob','id' => $instanceDetail->id, 'action'=>'ShutDownAppServer'], 'method' => 'post']) !!}
                                                {!! Form::button('<i class="far fa-stop-circle" title="Stop Instance"></i>', ['type' => 'submit', 'class' => 'btn btn-stop btn-xs', 'onclick' => "return confirm('You want to STOP the instance?')"]) !!}
                                                {!! Form::close() !!}
                                            @endcan
                                            @can('restart_instanceDetails')
                                        {{--  @if ($instanceDetail->running_jenkins_job == "Y")--}}
                                            {{-- If any jenkins job is already running then don't show button to restart instance --}}
                                            {{-- @else--}}
                                                {!! Form::open(['route' => ['instance.runjob','id' => $instanceDetail->id, 'action'=>'Restart'], 'method' => 'post']) !!}
                                                {!! Form::button('<i class="fas fa-sync" title="Restart Instance"></i>', ['type' => 'submit', 'class' => 'btn btn-restart btn-xs', 'onclick' => "return confirm('You want to RESTART the instance?')"  ]) !!}
                                                {!! Form::close() !!}
                                            {{-- @endif--}}
                                            @endcan
                                            @if($instanceDetail->instance_is_active == "N")
                                                {{-- If instance is not active, then show button to start the instance --}}
                                                @can('start_instanceDetails')
                                                    {!! Form::open(['route' => ['instance.runjob','id' => $instanceDetail->id, 'action'=>'StartAppServer'], 'method' => 'post']) !!}
                                                    {!! Form::button('<i class="far fa-play-circle" title="Start Instance"></i>', ['type' => 'submit', 'class' => 'btn btn-start btn-xs', 'onclick' => "return confirm('You want to START the instance?')"])  !!}
                                                    {!! Form::close() !!}
                                                @endcan
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            </div>
                        @endif
                    </td> <!-- end-td-block ACTION ICONS -->
                    @endcanany
                    @canany('edit_instanceDetails','delete_instanceDetails')
                    <td class="text-center">
                        {!! Form::open(['route' => ['instanceDetails.edit', $instanceDetail->id], 'method' => 'get']) !!}
                        {!! Form::button('<i class="fas fa-pencil-alt" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-edit btn-xs']) !!}
                        {!! Form::close() !!}

                        {!! Form::open(['route' => ['instanceDetails.destroy', $instanceDetail->id], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="fas fa-trash-alt" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-delete btn-xs', 'onclick' => "return confirm('Are you sure you want to delete this instance details?')"]) !!}
                        {!! Form::close() !!}
                    </td>
                    @endcanany

                </td>  <!-- TR END -->
                @endif <!-- $show_on_site -->
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

