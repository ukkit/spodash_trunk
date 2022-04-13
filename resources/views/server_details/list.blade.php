<?php

$dbdetails = $serverDetail->database_details_by_id($serverDetail->id);
$dbcount = count($dbdetails);

$indetails = $serverDetail->instance_details_by_server_id($serverDetail->id);
$inscount = count($indetails);

$mldetails = $serverDetail->ml_details_by_server_id($serverDetail->id);
$mlcount = count($mldetails);
?>

@if ($dbcount > 0)
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="pull-left"><i class="fas fa-database fa-fw"></i> Database List </span>
                <div class="clearfix"></div> <!-- clearfix -->
            </div> <!-- panel-heading -->
            <div class="panel-body">
                <table id="db_list_table" class="table table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th class="id_column">ID</th>
                            <th name="name_column">USER</th>
                            @if(Auth::user())
                                <th class="name_column">PASSWORD</th>
                            @endif
                            <th>SID/NAME</th>
                            <th class="text-center">PORT #</th>
                            <th class="text-right">DB SIZE</th>
                            <th class="text-right">TEMP SIZE</th>
                            <th class="text-right">TABLESPACE NAME</th>
                            <th class="text-right">TABLESPACE USED</th>
                            <th class="text-right">TEMP TABLESPACE</th>
                            <th class="text-right">TEMP TABLESPACE USED</th>
                            <th class="text-right">DB CREATED</th>
                            <th class="text-right">DB ACCESSED</th>
                            <th class="text-right">DATA UPDATED</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dbdetails as $dbd)

                        <?php
                        // dd($dbd);
                            $icons = Null;
                            $db_last_accessed = Null;
                            $db_size = Null;
                            $db_temp_size = null;
                            $db_creation_date = Null;
                            $db_data_updated = Null;
                            $tblspc_name = null;
                            $tblspc_used = null;
                            $tblspc_free = null;
                            $tblspc_total = null;
                            $tblspc_free_percent = null;
                            $tblspc_used_percent = null;

                            $temp_tblspc_name = null;
                            $temp_tblspc_used = null;
                            $temp_tblspc_free = null;
                            $temp_tblspc_total = null;
                            $temp_tblspc_free_percent = null;
                            $temp_tblspc_used_percent = null;

                            if ($dbd->repository_type == "PAI") {
                                $icons .="<i class=\"fab fa-product-hunt\" title=\"PAI Repository\">";
                            } elseif ($dbd->repository_type == "Intellicus") {
                                $icons .="<i class=\"fas fa-info-circle\" title=\"Intellicus Repository\">";
                            }

                            try {
                                $dbsize_data = $serverDetail->db_size_by_id($dbd->id);
                            } catch (\Throwable $th) {
                                $dbsize_data = null;
                            }

                            if(!empty($dbsize_data)) {

                                $db_size = $dbsize_data->db_size;
                                $db_temp_size = $dbsize_data->db_temp_size;

                                $tblspc_name = $dbsize_data->tablespace_name;
                                $tblspc_used = $dbsize_data->tablespace_used;
                                $tblspc_free = $dbsize_data->tablespace_free;
                                $tblspc_total = $tblspc_used + $tblspc_free;

                                if($tblspc_total > 0 ) {
                                    $tblspc_free_percent = round((($tblspc_free/$tblspc_total)*100),2)."%";
                                    $tblspc_used_percent = round((($tblspc_used/$tblspc_total)*100),2)."%";
                                }


                                $temp_tblspc_name = $dbsize_data->temp_tablespace_name;
                                $temp_tblspc_used = $dbsize_data->temp_tablespace_used;
                                $temp_tblspc_free = $dbsize_data->temp_tablespace_free;
                                $temp_tblspc_total = $temp_tblspc_used + $temp_tblspc_free;

                                if($temp_tblspc_total > 0 ){
                                    $temp_tblspc_free_percent = round((($temp_tblspc_free/$temp_tblspc_total)*100),2)."%";
                                    $temp_tblspc_used_percent = round((($temp_tblspc_used/$temp_tblspc_total)*100),2)."%";
                                }

                                if (!empty($dbsize_data->db_access_datetime)) {
                                    $db_last_accessed = date('Y-m-d', strtotime($dbsize_data->db_access_datetime));
                                }

                                if (!empty($dbsize_data->db_creation_date)) {
                                    $db_creation_date = date('Y-m-d', strtotime($dbsize_data->db_creation_date));
                                }

                                if (!empty($dbsize_data->created_at)) {
                                    $db_data_updated = date('Y-m-d', strtotime($dbsize_data->created_at));
                                }
                            }


                        ?>
                            @if ($dbd->db_is_active == "N")
                                <tr class="disabled">
                            @else
                                <tr>
                            @endif
                                <td>{{ $dbd->id }}</td>
                                <td>{{ $dbd->db_user }} {!! $icons !!}</td>
                                @if(Auth::user())
                                <td>{{ $dbd->db_pass }}</td>
                                @endif
                                <td>{{ $dbd->db_sid }}</td>
                                <td class="text-center">{{ $dbd->db_port }}</td>
                                @if (is_null($db_size))
                                <td></td>
                                @else
                                <td class="text-right">{{ number_format($db_size) }} M</td>
                                @endif
                                @if (is_null($db_temp_size))
                                <td></td>
                                @else
                                <td class="text-right">{{ number_format($db_temp_size) }} M</td>
                                @endif
                                <td class="text-right">{{ $tblspc_name }}</td>
                                @if (is_null($tblspc_used))
                                <td></td>
                                @else
                                <td class="text-right">
                                    {{ number_format($tblspc_used) }} M/{{ $tblspc_used_percent }}
                                </td>
                                @endif
                                <td class="text-right">{{ $temp_tblspc_name }}</td>
                                @if (is_null($temp_tblspc_used))
                                <td></td>
                                @else
                                <td class="text-right">
                                    {{ number_format($temp_tblspc_used) }} M/{{ $temp_tblspc_used_percent }}
                                </td>
                                @endif
                                <td class="text-right">{{ $db_creation_date }}</td>
                                <td class="text-right">{{ $db_last_accessed }}</td>
                                <td class="text-right">{{ $db_data_updated }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- panel-body -->
        </div> <!-- panel panel-heading -->
    </div>
@endif

@if ($inscount > 0)
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="pull-left"><i class="fas fa-file-alt fa-fw"></i> Instances List </span>
                <div class="clearfix"></div> <!-- clearfix -->
            </div> <!-- panel-heading -->
            <div class="panel-body">
                <table id="db_list_table" class="table table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            {{-- <th>PROD</th> --}}
                            <th class="text-center">BUILD</th>
                            <th class="text-center">URL</th>
                            <th class="text-center">USERNAME</th>
                            <th class="text-center">PASSOWRD</th>
                            <th class="text-center">USED BY</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($indetails as $ind)
                            <?php
                            $generated_app_userpass = "";
                            $auto_login = NULL;
                            if ($ind->enable_instance_auto_login == "Y") {
                                $auto_login = True;
                            }
                            if ($ind->show_instance_login == "Y") {
                                $generated_app_userpass = "User/Pass: ".$ind->instance_login."/ ".$ind->instance_pwd;
                            }
                            if ($ind->in_use == "Y") {
                                $generated_app_userpass = "";
                                $auto_login = NULL;
                            }

                            $prod_name = $serverDetail->product_name_by_id($ind->product_names_id, 'product_short_name');
                            $appServerIP = trim($serverDetail->server_ip,'[]"');
                            if ($ind->instance_is_active == "N") {
                                $app_btn_type = "btn-disabled";
                                $intell_btn_type = "btn-disabled";
                            } else {
                                $app_btn_type = "btn-info";
                                $intell_btn_type = "btn-default";
                            }
                            if($ind->is_https == "Y") {
                                $http_tag = "https";
                                $link_icon = "<button type=\"button\" class=\"btn $app_btn_type btn-xs\" title=\"$generated_app_userpass\"><i class=\"fas fa-lock fs-sm\" ></i> ".$prod_name."</button>";
                            } else {
                                $http_tag = "http";
                                $link_icon = "<button type=\"button\" class=\"btn $app_btn_type btn-xs\" title=\"$generated_app_userpass\"><i class=\"fas fa-lock-open fa-sm\" ></i> ".$prod_name."</button>";
                            }

                            $generated_url = $http_tag."://" . $appServerIP .":".$ind->instance_tomcat_port ."/WebUI/";
                            if ($auto_login) {
                                $generated_url .= "?txtUsername=".$ind->instance_login."&txtPassword=".$ind->instance_pwd;
                            }

                            $release_num = $serverDetail->product_version_by_pvid($ind->pv_id,'product_ver_number');
                            $build_num = $serverDetail->product_version_by_pvid($ind->pv_id,'product_build_numer');

                            $version = trim($release_num) . " ". trim($build_num);

                            $team_name_array = $serverDetail->return_team_names($ind->id);

                            ?>
                        @if ($ind->in_use == "Y")
                            <tr class="inuse">
                        @elseif ($ind->instance_is_active == "Y")
                            <tr>
                        @else
                            <tr class="disabled">
                        @endif
                        <td>{{ $ind->id }}</td>
                        <td>{{ $ind->instance_name }}</td>
                        <td class="text-center">{!! $version !!}</td>
                        <td class="text-center">
                            <a href="{!! $generated_url !!}" title="{!! $generated_app_userpass !!}" target="_blank">{!! $link_icon !!}</a>
                        </td>
                        <td class="text-center">{{ $ind->instance_login }}</td>
                        <td class="text-center">{{ $ind->instance_pwd }}</td>
                        <td class="text-center">
                            @php
                            if (count($team_name_array) == 1 ) {
                                foreach ($team_name_array as $tna) {
                                    if ($tna == "All")
                                    {
                                        echo "Everyone";
                                    } else {
                                        echo $tna;
                                    }
                                }
                            } elseif (count($team_name_array) >= 2) {
                                foreach ($team_name_array as $tna) {
                                    if ($tna == "All") {
                                        echo "Everyone <br>";
                                    } else {
                                        echo $tna . "<br>";
                                    }
                                }
                            }
                        @endphp
                        </td>
                        {{-- <td class="text-center">{{ $ind->instance_owner }}</td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- panel-body -->
        </div> <!-- panel panel-heading -->
    </div>
@endif

@if ($mlcount > 0)
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="pull-left"><i class="fab fa-leanpub fa-fw"></i> Machine Learning Instace </span>
                <div class="clearfix"></div> <!-- clearfix -->
            </div> <!-- panel-heading -->
            <div class="panel-body">
                <table id="ml_list_table" class="table table-bordered table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>ZEPPELIN USER</th>
                            <th>ZEPPELIN PASSWORD</th>
                            <th>ZEPPELIN PORT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mldetails as $mld)
                        <tr>
                            <td>{{ $mld->id }}</td>
                            <td>{{ $mld->ml_name }}</td>
                            <td>{{ $mld->zeppelin_user }}</td>
                            <td>{!! Crypt::decryptString($mld->zeppelin_pwd) !!}</td>
                            <td>{{ $mld->zeppelin_port }}</td>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- panel-body -->
        </div> <!-- panel panel-heading -->
    </div>
@endif