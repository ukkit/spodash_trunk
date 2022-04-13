<?php
$java_type_array = array("Oracle JDK","Amazon Corretto");
// $java_type_array = array("Oracle JDK","Amazon Corretto","OpenJDK");
?>
<div class="row">

    <!-- Intellicus Name Field -->
    {{-- <div class="form-group col-sm-2 col-sm-offset-2 "> --}}
    <div class="form-group col-sm-2">
        {!! Form::label('intellicus_name', 'Name:') !!}
        {!! Form::text('intellicus_name', null, ['class' => 'form-control',  'required']) !!}
    </div>

    <!-- Server Details Id Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('server_details_id', 'Server:') !!}
        <select name="server_details_id" class="form-control select-server-name">
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

    <!-- Intellicus Versions Id Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('intellicus_versions_id', 'Version:') !!}
        <select name="intellicus_versions_id" class="form-control select-server-name">
            <option value="">Select .... </option>
            @foreach($intellicus_version as $ivn)
                @if($this_is_edit)
                <option value="{{ $ivn->id }}" @if($ivn->id==$record->intellicus_versions_id) selected='selected' @endif >{{ $ivn->intellicus_version }} {{ $ivn->intellicus_patch }}</option>
                @else
                    <option value="{{ $ivn->id }}">{{ $ivn->intellicus_version }} {{ $ivn->intellicus_patch }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <!-- Database Details Id Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('database_details_id', 'Repository:') !!}
        <select name="database_details_id" class="form-control select-server-name">
            <option value="">Select .... </option>
                @foreach($db_detail as $dbd)
                    @if($this_is_edit)
                    <option value="{{ $dbd->id }}" @if($dbd->id==$record->database_details_id) selected='selected' @endif >{{ $dbd->db_user }} &#64;{{ $dbd->db_sid }} ({{ $dbd->server_name }})</option>
                    @else
                    <option value="{{ $dbd->id }}">{{ $dbd->db_user }} &#64;{{ $dbd->db_sid }} ({{ $dbd->server_name }})</option>
                    @endif
                @endforeach
        </select>
    </div>

    <!-- Intellicus Login Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('intellicus_login', 'Login:') !!}
        {!! Form::text('intellicus_login', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Intellicus Pwd Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('intellicus_pwd', 'Password:') !!}
        {!! Form::text('intellicus_pwd', null, ['class' => 'form-control', 'required']) !!}
    </div>

</div>
<div class="row">

    <!-- Intellicus Port Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('intellicus_port', 'Port:') !!}
        {!! Form::number('intellicus_port', null, ['class' => 'form-control',  'required']) !!}
    </div>

    <!-- Intellicus Port Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('intellicus_memory', 'Memory (GB):') !!}
        {!! Form::number('intellicus_memory', null, ['class' => 'form-control',  'required']) !!}
    </div>

    <!-- IS_HTTPS field -->
    <div class="form-group col-sm-2">
        {!! Form::label('is_https', 'HTTPS Enabled?') !!}
        <div class="form-control disabled">
            <label class="radio-inline">
                @if($this_is_edit)
                    <input type="radio" name="is_https" value= "Y" @if($record->is_https == "Y")  checked @endif> Yes
                @else
                    <input type="radio" name="is_https" value="Y"> Yes
                @endif
            </label>
            <label class="radio-inline">
                @if($this_is_edit)
                    <input type="radio" name="is_https" value= "N" @if($record->is_https == "N")  checked @endif> No
                @else
                    <input type="radio" name="is_https" value="N" checked> No
                @endif
            </label>
        </div>
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



</div>

<div class="row">

    @if($this_is_edit)
    <div class="form-group col-sm-5 col-sm-offset-1">
    @else
    <div class="form-group col-sm-8 col-sm-offset-1">
    @endif
    <!-- Intellicus Install Path Field -->
    {{-- <div class="form-group col-sm-4 col-sm-offset-4"> --}}
        {!! Form::label('intellicus_install_path', 'Intellicus Install Path:') !!}
        {!! Form::text('intellicus_install_path', null, ['class' => 'form-control', 'placeholder' => 'only shared directory name, ip will be added automatically']) !!}
    </div>

    @if($this_is_edit)
    <div class="form-group col-sm-2">
        {!! Form::label('is_active', 'Intellicus Active?') !!}
        <div class="form-control">
                <label class="radio-inline">
                <input type="radio" name="is_active" value="Y" checked> Yes
            </label>
            <label class="radio-inline">
                <input type="radio" name="is_active" value= "N" @if($record->is_active == "N")  checked @endif> No
            </label>
        </div>
    </div>

    <div class="form-group col-sm-2">
        {!! Form::label('check_fail_count', 'Check Fail Threshold:') !!}
        {!! Form::number('check_fail_count', null, ['class' => 'form-control',  'required']) !!}
    </div>
    @endif

</div>

</div> {{-- THIS DIV CLOSED IS OF BOX-BODY FROM CREATE --}}


<div class="box-footer">
<!-- Submit Field -->
<div class="form-group col-sm-12">
        <div class="text-center">
        {!! Form::submit('Save', ['class' => 'btn btn100px btn-primary']) !!}
        <a href="{!! route('intellicusDetails.index') !!}" class="btn btn100px btn-default">Cancel</a>
    </div>
</div>

{{-- <hr>
<!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('intellicusDetails.index') }}" class="btn btn-default">Cancel</a>
    </div> --}}
