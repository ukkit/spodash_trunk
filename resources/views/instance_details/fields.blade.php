<?php
$java_type_array = array("Oracle JDK","Amazon Corretto");
// $java_type_array = array("Oracle JDK","Amazon Corretto","OpenJDK");
$jenkins_token_array = array(array("US Jenknis Server (andcsv-svgcjk01)","11d0c46e4f38bf0a2a4ea82ef9d5266294"),array("Pune Jenkins Server 1 (10.192.110.23)","f92871a081a7d7ec3353d538bdac9b5f"),array("Pune Jenkins Server 2 (ppumsv-svgjk01d)","113b0a8f28346617b9065b1677a240e14d"));
// $pai_type_array = array("Hadoop","Oracle");
$escm_type_array = array("Production","Sandbox");
?>

    {{-- FIRST BLOCK STARTS HERE --}}
    <div class="row">
        <!-- Instance Name Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('instance_name', 'Instance/Customer Name:') !!}
            @if($this_is_edit)
                @hasanyrole('admin|superadmin')
                    {!! Form::text('instance_name', null, ['class' => 'form-control']) !!}
                @else
                    {!! Form::text('instance_name', null, ['class' => 'form-control', 'disabled']) !!}
                @endhasanyrole
            @else
                {!! Form::text('instance_name', null, ['class' => 'form-control', 'required']) !!}
            @endif
        </div>

        <!-- Product Names Id Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('product_names_id', 'Product:') !!}
            <!-- {!! Form::number('product_names_id', null, ['class' => 'form-control']) !!} -->
            <select name="product_names_id" class="form-control">
                <option value="">Select .... </option>
                @foreach($product_name as $sda)
                    @if($this_is_edit)
                    <option value="{{ $sda->id }}" @if($sda->id==$record->product_names_id) selected='selected' @endif >{{ $sda->product_short_name }}</option>
                    @else
                        <option value="{{ $sda->id }}">{{ $sda->product_short_name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- SPM Versions Id Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('pv_id', 'SPM Version:') !!}
            <select name="pv_id" class="form-control select-version">
                <option value="">Select .... </option>
                @foreach($product_version as $prv)
                    @if($this_is_edit)
                        @if($prv->is_release_build == "Y")
                            <option value="{{ $prv->pv_id }}" @if($prv->pv_id==$record->pv_id) selected='selected' @endif >{{ $prv->product_ver_number }} Build {{ $prv->product_build_numer }} #</option>
                        @else
                            <option value="{{ $prv->pv_id }}" @if($prv->pv_id==$record->pv_id) selected='selected' @endif >{{ $prv->product_ver_number }} Build {{ $prv->product_build_numer }}</option>
                        @endif
                    @else
                        @if($prv->is_release_build == "Y")
                            <option value="{{ $prv->pv_id }}">{{ $prv->product_ver_number }} Build {{ $prv->product_build_numer }}</option>
                        @else
                            <option value="{{ $prv->pv_id }}">{{ $prv->product_ver_number }} Build {{ $prv->product_build_numer }}</option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>

        <!-- Database Details Id Field -->
        <div class="form-group col-sm-2">
        {{-- @php dd($database_detail); @endphp --}}

            {!! Form::label('database_details_id', 'Database:') !!}
            <!-- {!! Form::number('server_details_id', null, ['class' => 'form-control']) !!} -->
            <select name="database_details_id" class="form-control select-dbdetails">
                <option value="">Select .... </option>
                @foreach($database_detail as $dda)
                    @if($this_is_edit)
                    <option value="{{ $dda->id }}" @if($dda->id==$record->database_details_id) selected='selected' @endif >{{ $dda->db_user }} @ {{ $dda->db_sid }}</option>
                    @else
                        <option value="{{ $dda->id }}">{{ $dda->db_user }}&#64;{{ $dda->db_sid }} ({{ $dda->server_details_by_id->server_name }}/{{ $dda->server_details_by_id->server_ip }})</option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- Server Details Id Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('server_details_id', 'App Server:') !!}
            <!-- {!! Form::number('server_details_id', null, ['class' => 'form-control']) !!} -->
            <select name="server_details_id" class="form-control select-app-server">
                <option value="">Select .... </option>
                @foreach($server_detail as $sda)
                    @if($this_is_edit)
                    <option value="{{ $sda->id }}" @if($sda->id==$record->server_details_id) selected='selected' @endif >{{ $sda->server_name }} ({{ $sda->server_ip }})</option>
                    @else
                        <option value="{{ $sda->id }}">{{ $sda->server_name }} ({{ $sda->server_ip }})</option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- Intellicus Details Id Field -->


        <div class="form-group col-sm-2">
            {!! Form::label('intellicus_details_id  ', 'Intellicus:') !!}
            <!-- {!! Form::number('intellicus_details_id', null, ['class' => 'form-control']) !!} -->
            <select name="intellicus_details_id" class="form-control select-app-server">
                <option value="">Select .... </option>
                @foreach($intellicus_detail as $ida)
                @php
                    $server_ip = $ida->server_details_by_id->server_ip;
                    $server_name = $ida->server_details_by_id->server_name;
                    $intell_ver = $ida->return_intellicus_version_details($ida->intellicus_versions_id, 'intellicus_version')->get('0');
                    $intell_patch = $ida->return_intellicus_version_details($ida->intellicus_versions_id, 'intellicus_patch')->get('0');
                    $is_https = $ida->is_https;
                    if ($is_https == "Y") {
                        $http_icon = "#";
                    } else {
                        $http_icon = "";
                    }
                @endphp
                    @if($this_is_edit)
                    <option value="{{ $ida->id }}" @if($ida->id==$record->intellicus_details_id) selected='selected' @endif >{{ $ida->intellicus_name }} ({{ $server_name }}/{{ $server_ip }}:{{ ($ida->intellicus_port) }} ) ver {{ $intell_ver }} {{ $intell_patch }} {{ $http_icon }}</option>
                    @else
                        <option value="{{ $ida->id }}">{{ $ida->intellicus_name }} ({{ $server_name }}/{{ $server_ip }}:{{ ($ida->intellicus_port) }} ) ver {{ $intell_ver }} {{ $intell_patch }}  {{ $http_icon }}</option>
                    @endif
                @endforeach
            </select>
        </div>



    </div>
    {{-- FIRST BLOCK ENDS HERE --}}

    {{-- SECOND BLOCK STARTS HERE --}}
    <div class="row">

        <!-- Instance Login Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('instance_login', 'Instance Login:') !!}
            {!! Form::text('instance_login', null, ['class' => 'form-control','placeholder' => 'super', 'required']) !!}
        </div>

        <!-- Instance Pwd Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('instance_pwd', 'Instance Password:') !!}
            {!! Form::text('instance_pwd', null, ['class' => 'form-control','placeholder' => 'super', 'required']) !!}
        </div>

        <!-- Instance Tomcat Port Field -->
        <div class="form-group col-sm-1">
            {!! Form::label('instance_tomcat_port', 'Web Port:') !!}
            {!! Form::text('instance_tomcat_port', null, ['class' => 'form-control','placeholder' => '8100', 'required']) !!}
        </div>

        <!-- Instance AP Port Number -->
        <div class="form-group col-sm-1">
            {!! Form::label('instance_ap_port', 'AP Port:') !!}
            {!! Form::text('instance_ap_port', null, ['class' => 'form-control','placeholder' => 'Optional']) !!}
        </div>

        <!-- Instance Install Path Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('instance_install_path', 'Instance Installation Path:') !!}
            {!! Form::text('instance_install_path', null, ['class' => 'form-control', 'placeholder' => 'c:\servigistics\SPM','required']) !!}
        </div>

        <!-- Instance Shared Dir Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('instance_shared_dir', 'Logs Shared Dir:') !!}
            {!! Form::text('instance_shared_dir', null, ['class' => 'form-control', 'placeholder' => 'only shared directory name, ip will be added automatically','required']) !!}
        </div>

    </div>
    {{-- SECOND BLOCK ENDS HERE --}}

    {{-- THIRD BLOCK STARTS HERE --}}
    <div class="row">
        <!-- Instance AP Min Heapsize -->
        <div class="form-group col-sm-2">
            {!! Form::label('instance_ap_min_heap_size', 'Autopilot Min HeapSize (MB):') !!}
            {!! Form::number('instance_ap_min_heap_size', null, ['class' => 'form-control','placeholder' => '1024', 'required']) !!}
        </div>

        <!-- Instance AP Max Heapsize -->
        <div class="form-group col-sm-2">
            {!! Form::label('instance_ap_max_heap_size', 'Autopilot Max HeapSize (MB):') !!}
            {!! Form::number('instance_ap_max_heap_size', null, ['class' => 'form-control','placeholder' => '4096','required']) !!}
        </div>

        <!-- Instance Web Min Heapsize -->
        <div class="form-group col-sm-2">
            {!! Form::label('instance_web_min_heap_size', 'Web Min HeapSize (MB):') !!}
            {!! Form::number('instance_web_min_heap_size', null, ['class' => 'form-control','placeholder' => '512','required']) !!}
        </div>

        <!-- Instance Web Max Heapsize -->
        <div class="form-group col-sm-2">
            {!! Form::label('instance_web_max_heap_size', 'Web Max HeapSize (MB):') !!}
            {!! Form::number('instance_web_max_heap_size', null, ['class' => 'form-control','placeholder' => '1024','required']) !!}
        </div>

        <!-- Tomcat Service Name Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('tomcat_service_name', 'Tomcat Service:') !!}
            {!! Form::text('tomcat_service_name', null, ['class' => 'form-control','placeholder' => 'Optional']) !!}
        </div>

        <!-- Autopilot Service Name Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('ap_service_name', 'Autopilot Service:') !!}
            {!! Form::text('ap_service_name', null, ['class' => 'form-control','placeholder' => 'Optional']) !!}
        </div>
    </div>
    {{-- THIRD BLOCK ENDS HERE --}}

    {{-- NOTES AND JENKINS URL BLOCK STARTS --}}
    <div class="row">

        <!-- Snowflake Build Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('sf_pv_id', 'Snowflake Version:') !!}
            <select name="sf_pv_id" class="form-control select-sf-version">
                <option value="">Select .... </option>
                @foreach($sf_build as $sfb)
                    @if($this_is_edit)
                        <option value="{{ $sfb->pv_id }}" @if($sfb->pv_id==$record->sf_pv_id) selected='selected' @endif >{{ $sfb->sf_pai_version }} Build {{ $sfb->sf_pai_build }} </option>
                    @else
                        <option value="{{ $sfb->pv_id }}">{{ $sfb->sf_pai_version }} Build {{ $sfb->sf_pai_build }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- PAI Versions Id Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('pai_pv_id', 'PAI Version:') !!}
            <select name="pai_pv_id" class="form-control select-version">
                <option value="">Select .... </option>
                @foreach($pai_version as $pav)
                    @if($this_is_edit)
                        @if($pav->is_release_build == "Y")
                            <option value="{{ $pav->pv_id }}" @if($pav->pv_id==$record->pai_pv_id) selected='selected' @endif >{{ $pav->pai_version }} {{ $pav->pai_build }} # </option>
                        @else
                            <option value="{{ $pav->pv_id }}" @if($pav->pv_id==$record->pai_pv_id) selected='selected' @endif >{{ $pav->pai_version }} {{ $pav->pai_build }}</option>
                        @endif
                    @else
                        @if($pav->is_release_build == "Y")
                            <option value="{{ $pav->pv_id }}">{{ $pav->pai_version }} {{ $pav->pai_build }} #</option>
                        @else
                            <option value="{{ $pav->pv_id }}">{{ $pav->pai_version }} {{ $pav->pai_build }}</option>
                        @endif

                    @endif
                @endforeach
            </select>
        </div>


        {{-- PAI Details field  --}}
        <div class="form-group col-sm-2">
            {!! Form::label('pai_details_id', 'PAI Details:') !!}
            {{-- @php dd($pai_detail); @endphp --}}
            <!-- {!! Form::number('server_details_id', null, ['class' => 'form-control']) !!} -->
            <select name="pai_details_id" class="form-control select-dbdetails">
                <option value="">Select .... </option>

                @foreach($pai_detail as $pda)
                    @if($this_is_edit)
                        <option value="{{ $pda->id }}" @if($pda->id==$record->pai_details_id) selected='selected' @endif >{{ $pda->db_user }} &#64;{{ $pda->db_sid }} ({{ $pda->server_name }})</option>
                    @else
                        <option value="{{ $pda->id }}">{{ $pda->db_user }} &#64;{{ $pda->db_sid }} ({{ $pda->server_name }})</option>
                        {{-- <option value="{{ $pda->id }}">{{ $pda->db_user }}&#64;{{ $pda->db_sid }} ({{ $pda->server_details_by_id->server_name }}/{{ $pda->server_details_by_id->server_ip }})</option> --}}
                    @endif
                @endforeach
            </select>
        </div>

        <!-- JDK type Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('jdk_type', 'JDK Type:') !!}
            <select name="jdk_type" class="form-control">
                <option value="">Select .... </option>
                @foreach($java_type_array as $jta)
                    @if($this_is_edit)
                    <option value="{{ $jta }}" @if($jta==$record->jdk_type) selected='selected' @endif >{{ $jta }}</option>
                    @else
                        <option value="{{ $jta }}">{{ $jta }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- JDK version Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('jdk_version', 'JDK Version:') !!}
            {!! Form::text('jdk_version', null, ['class' => 'form-control','placeholder' => 'optional']) !!}
        </div>

        <!-- ML Details Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('ml_details_id', 'ML Instance:') !!}
            <select name="ml_details_id" class="form-control select-ml-details">
                <option value="">Select .... </option>
                @foreach($ml_detail as $mld)
                    @if($this_is_edit)
                        <option value="{{ $mld->id }}" @if($mld->id==$record->ml_details_id) selected='selected' @endif >{{ $mld->ml_name }} </option>
                    @else
                        <option value="{{ $mld->id }}">{{ $mld->ml_name }} </option>
                    @endif
                @endforeach
            </select>
        </div>

    </div>
    {{-- THIRD BLOCK ENDS HERE --}}


    <div class="row">
        <!-- Jenkins URL Field -->
        @if($show_is_active)
        <div class="form-group col-sm-2">
        @else
        <div class="form-group col-sm-4 col-lg-4">
        @endif
            {!! Form::label('jenkins_url', 'Jenkins URL:') !!}
            {!! Form::text('jenkins_url', null, ['class' => 'form-control', 'placeholder' => 'Optional']) !!}
        </div>
        <!-- Jenkins User Name Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('jenkins_uname', 'Jenkins User Name:') !!}
            {!! Form::text('jenkins_uname', null, ['class' => 'form-control', 'placeholder' => 'Optional']) !!}
        </div>
        <!-- Jenkins Token Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('jenkins_token', 'Jenkins Token:') !!}
            <select name="jenkins_token" class="form-control">
                <option value="">Select .... </option>

                @for($r=0;$r<count($jenkins_token_array);$r++)
                    @if($this_is_edit)
                        <option value="{{ $jenkins_token_array[$r][1] }}" @if($jenkins_token_array[$r][1]==$record->jenkins_token) selected='selected' @endif >{{ $jenkins_token_array[$r][0] }}</option>
                    @else
                        <option value="{{ $jenkins_token_array[$r][1] }}">{{ $jenkins_token_array[$r][0] }}</option>
                    @endif
                @endfor
            </select>
        </div>

        <!-- WebServer Version Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('webserver_version', 'Tomcat Version:') !!}
            {!! Form::text('webserver_version', null, ['class' => 'form-control','placeholder' => 'optional']) !!}
        </div>

        @if($show_is_active)

        @if(($record->product_names_id == "1" || $record->product_names_id == "2" || $record->product_names_id == "3"))
        <!-- ESCM type Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('escm_type', 'ESCM Type:') !!}
            <select name="escm_type" class="form-control">
                <option value="">Select .... </option>
                @foreach($escm_type_array as $jta)
                    @if($this_is_edit)
                    <option value="{{ $jta }}" @if($jta==$record->escm_type) selected='selected' @endif >{{ $jta }}</option>
                    @else
                        <option value="{{ $jta }}">{{ $jta }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        @endif


        <!-- Check Fail Threshold -->
        <div class="form-group col-sm-2">
            {!! Form::label('check_fail_count', 'Check Fail Threshold:') !!}
            {!! Form::text('check_fail_count', null, ['class' => 'form-control', 'required']) !!}
        </div>
        @endif

    </div>
    {{-- FOURTH BLOCK - ALL SWITCHES - STARTS HERE --}}
    @if($show_is_active)
    <hr>

    <div class="row">
    <!-- Instance Is Active Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('instance_is_active', 'Instance Active?') !!}
            <div class="form-control">
                    <label class="radio-inline">
                    <input type="radio" name="instance_is_active" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="instance_is_active" value= "N" @if($record->instance_is_active == "N")  checked @endif> No
                </label>
            </div>
        </div>

        <!-- Instance Show On Site Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('instance_show_on_site', 'Show on Dashboard?') !!}
            <div class="form-control">
                    <label class="radio-inline">
                    <input type="radio" name="instance_show_on_site" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="instance_show_on_site" value= "N" @if($record->instance_show_on_site == "N")  checked @endif> No
                </label>
            </div>
        </div>

        <!-- Instance Is HTTPS Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('is_https', 'HTTPS Enabled?') !!}
            <div class="form-control disabled">
                <label class="radio-inline">
                    <input type="radio" name="is_https" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="is_https" value= "N" @if($record->is_https == "N")  checked @endif> No
                </label>
            </div>
        </div>

        <!-- Build Updates Enabled Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('show_jenkins_build', 'Build Updates Enabled?') !!}
            <div class="form-control">
                <label class="radio-inline">
                    <input type="radio" name="show_jenkins_build" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="show_jenkins_build" value= "N" @if($record->show_jenkins_build == "N")  checked @endif> No
                </label>
            </div>
        </div>

        <!-- QA Disabled Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('qa_intentionally_disabled', 'QA Disabled?') !!}
            <div class="form-control">
                <label class="radio-inline">
                    <input type="radio" name="qa_intentionally_disabled" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="qa_intentionally_disabled" value= "N" @if($record->qa_intentionally_disabled == "N")  checked @endif> No
                </label>
            </div>
        </div>

        <!-- Snowflake Configured-->
        {{-- <div class="form-group col-sm-2">
            {!! Form::label('snowflake_configured', 'Snowflake Configured?') !!}
            <div class="form-control">
                <label class="radio-inline">
                    <input type="radio" name="snowflake_configured" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="snowflake_configured" value= "N" @if($record->snowflake_configured == "N")  checked @endif> No
                </label>
            </div>
        </div> --}}

        <!-- Contrast Configured Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('is_contrast_configured', 'Contrast Configured?') !!}
            <div class="form-control">
                <label class="radio-inline">
                    <input type="radio" name="is_contrast_configured" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="is_contrast_configured" value= "N" @if($record->is_contrast_configured == "N")  checked @endif> No
                </label>
            </div>
        </div>

        <!-- Instance Is Auto Upgraded Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('instance_is_auto_upgraded', 'Instance Auto-Upgraded?') !!}
            <div class="form-control disabled">
                <label class="radio-inline">
                    <input type="radio" name="instance_is_auto_upgraded" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="instance_is_auto_upgraded" value= "N" @if($record->instance_is_auto_upgraded == "N")  checked @endif> No
                </label>
            </div>
        </div>

        <!-- Show Instance Login Password details Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('show_instance_login', 'Show Login Details?') !!}
            <div class="form-control disabled">
                <label class="radio-inline">
                    <input type="radio" name="show_instance_login" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="show_instance_login" value= "N" @if($record->show_instance_login == "N")  checked @endif> No
                </label>
            </div>
        </div>

        <!-- Enable Auto Login for Instance Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('enable_instance_auto_login', 'Enable Auto-Login?') !!}
            <div class="form-control disabled">
                <label class="radio-inline">
                    <input type="radio" name="enable_instance_auto_login" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="enable_instance_auto_login" value= "N" @if($record->enable_instance_auto_login == "N")  checked @endif> No
                </label>
            </div>
        </div>


        {{-- @role('superadmin') --}}
            <!-- Running Jenkins Job Field -->
            <div class="form-group col-sm-2">
                {!! Form::label('running_jenkins_job', 'Running Jenkins Job?') !!}
                <div class="form-control disabled">
                    <label class="radio-inline">
                        <input type="radio" name="running_jenkins_job" value="Y" checked> Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="running_jenkins_job" value= "N" @if($record->running_jenkins_job == "N")  checked @endif> No
                    </label>
                </div>
            </div>
        {{-- @endrole --}}

        {{-- Enable instance db backup enabled field --}}
        <div class="form-group col-sm-2">
            {!! Form::label('db_backup_enabled', 'DB Backup Enabled?') !!}
            <div class="form-control disabled">
                <label class="radio-inline">
                    <input type="radio" name="db_backup_enabled" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="db_backup_enabled" value= "N" @if($record->db_backup_enabled == "N")  checked @endif> No
                </label>
            </div>
        </div>

        {{-- PAI Advance configured --}}
        <div class="form-group col-sm-2">
            {!! Form::label('pai_foundation', 'PAI Foundation Configured?') !!}
            <div class="form-control disabled">
                <label class="radio-inline">
                    <input type="radio" name="pai_foundation" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="pai_foundation" value= "N" @if($record->pai_foundation == "N")  checked @endif> No
                </label>
            </div>
        </div>

       {{-- Enable instance in use field --}}
        <div class="form-group col-sm-2">
            {!! Form::label('in_use', 'Instance in use for demo?') !!}
            <div class="form-control disabled">
                <label class="radio-inline">
                    <input type="radio" name="in_use" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="in_use" value= "N" @if($record->in_use == "N")  checked @endif> No
                </label>
            </div>
        </div>
        <!-- In_Use_Msg -->
        <div class="form-group col-sm-3">
            {!! Form::label('in_use_msg', 'In Use Message:') !!}
            {!! Form::text('in_use_msg', null, ['class' => 'form-control', 'required']) !!}
        </div>


    </div>
    {{-- FOURTH BLOCK ENDS HERE --}}
    <hr>
    {{-- NOTES BLOCK --}}
    <div class="row">
        <div class="form-group col-lg-12">
            {!! Form::label('instance_note', 'Notes:') !!}
            {!! Form::textarea('instance_note', null, ['class' => 'form-control', 'rows' => 2, 'placeholder' => 'Optional']) !!}
        </div>
    </div>
    <hr>
    {{-- TEAMS BLOCK STARTS HERE --}}
    <div class="row">
        <div class="form-group col-lg-12">
            {{-- {!! Form::label('teams', 'Select Teams:') !!} --}}

            @foreach($teams as $tm)
            <div class="col-sm-2">
                <label>
                    <input type="checkbox" class="minimal" id="{{$tm->team_name}}" name="teamName[]" value="{{$tm->id}}"
                    @foreach($teams_arr as $tr)
                        @if($tm->id == $tr->team_id) checked @endif
                    @endforeach/>
                    @if ($tm->team_name == "All")
                        Everyone
                    @else
                        {{$tm->team_name}}
                    @endif
                </label>
            </div>
            @endforeach
        </div>
    </div>
    {{-- TEAMS BLOCK ENDS HERE --}}

    @endif
</div>

<div class="box-footer">
    <div class="form-group col-sm-12">
        <div class="text-center">
        {!! Form::submit('Save', ['class' => 'btn btn100px btn-primary']) !!}
        <a href="{!! url()->previous() !!}" class="btn btn100px bg-olive">Back</a>
    </div>
</div>
