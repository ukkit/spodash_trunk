<?php
$server_class_array = ["VM","AWS","AZURE","PHYSICAL"];
?>

<div class="row">
    <!-- Server Name Field -->
    <div class="form-group col-md-3">
        {!! Form::label('server_name', 'Name:') !!}
        @if($this_is_edit)
            {!! Form::text('server_name', null, ['class' => 'form-control', 'disabled']) !!}
        @else
            {!! Form::text('server_name', null, ['class' => 'form-control', 'required']) !!}
        @endif
    </div>

    <!-- Server Ip Field -->
    <div class="form-group col-md-3">
        {!! Form::label('server_ip', 'IP Address:') !!}
        {!! Form::text('server_ip', null, ['class' => 'form-control', 'required', 'data-inputmask' => '\'alias\' : \'ip\'', 'data-mask']) !!}
    </div>

    <!-- Server Login Field -->
    <div class="form-group col-md-3">
        {!! Form::label('server_user', 'Server Login:') !!}
        {!! Form::text('server_user', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Server Password Field -->
    <div class="form-group col-md-3">
        {!! Form::label('server_password', 'Server Password:') !!}
        {!! Form::text('server_password', null, ['class' => 'form-control', 'required']) !!}
    </div>
</div>

<div class="row">
    <!-- Server Class Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('server_class', 'Server Type:') !!}
        {{-- <select name="server_class" class="form-control select-server-type"> --}}
        <select name="server_class" class="form-control">
            <option value="">Select .... </option>
            @foreach($server_class_array as $sca)
                @if($this_is_edit)
                <option value="{{ $sca }}" @if($sca==$record->server_class) selected='selected' @endif >{{ $sca }}</option>
                @else
                    <option value="{{ $sca }}">{{ $sca }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <!-- Server Purpose Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('server_uses_id', 'Purpose:') !!}
        <!-- {!! Form::text('server_purpose', null, ['class' => 'form-control', 'placeholder' => 'App Server / DB Server / Engine Automation']) !!} -->
        <select name="server_uses_id" class="form-control">
            <option value="">Select .... </option>
            @foreach($server_uses as $suse)
                @if($this_is_edit)
                    <option value="{{ $suse->id }}" @if($suse->id==$record->server_uses_id) selected='selected' @endif > {{ $suse->use_long_name }}</option>
                @else
                    <option value="{{ $suse->id }}">{{ $suse->use_long_name }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <!-- OS Type Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('os_types_id', 'Operating System:') !!}
        <select name="os_types_id" class="form-control">
            <option value="">Select .... </option>
            @foreach($os_types as $ost)
                @if($this_is_edit)
                <option value="{{ $ost->id }}" @if($ost->id==$record->os_types_id) selected='selected' @endif > {{ $ost->os_long_name }}</option>
                @else
                    <option value="{{ $ost->id }}">{{ $ost->os_long_name }}</option>
                @endif
            @endforeach
        </select>
    </div>

    <!-- Database Types Id Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('database_types_id', 'Database Type:') !!}
        <!-- {!! Form::number('database_types_id', null, ['class' => 'form-control']) !!} -->
        <select name="database_types_id" class="form-control">
            <option value="">Select .... </option>
            @foreach($database_types as $dbt)
                @if($this_is_edit)
                    <option value="{{ $dbt->id }}" @if($dbt->id==$record->database_types_id) selected='selected' @endif > {{ $dbt->db_long_name }}</option>
                @else
                    <option value="{{ $dbt->id }}">{{ $dbt->db_long_name }}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>

<div class="row">
    <!-- Server Ram Gb Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('server_ram_gb', 'RAM (in GB):') !!}
        {!! Form::number('server_ram_gb', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Server Hdd Gb Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('server_hdd_gb', 'Disk Space (in GB):') !!}
        {!! Form::number('server_hdd_gb', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <!-- Server CPU Cores Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('server_cpu_cores', 'CPU Cores Count:') !!}
        {!! Form::number('server_cpu_cores', null, ['class' => 'form-control', 'required']) !!}
    </div>
    <!-- Server Owner Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('server_owner', 'Owner:') !!}
        {!! Form::text('server_owner', null, ['class' => 'form-control', 'placeholder' => 'Optional']) !!}
    </div>

    <!-- Server Location Field -->
    <div class="form-group col-sm-3">
        {!! Form::label('server_location', 'Location:') !!}
        {!! Form::text('server_location', null, ['class' => 'form-control', 'placeholder' => 'Optional']) !!}
    </div>
</div>

<div class="row">
    @if($show_is_active)
        <!-- Server Is Active Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('server_is_active', 'Server is Active?') !!}
            <div class="form-control">
                    <label class="radio-inline">
                    <input type="radio" name="server_is_active" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="server_is_active" value= "N" @if($record->server_is_active == "N")  checked @endif> No
                </label>
            </div>
        </div>

        <!-- Server Show On Site Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('server_show_on_site', 'Show on Dashboard?') !!}
            <div class="form-control">
                    <label class="radio-inline">
                    <input type="radio" name="server_show_on_site" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="server_show_on_site" value= "N" @if($record->server_show_on_site == "N")  checked @endif> No
                </label>
            </div>
        </div>

        <!-- Server Note Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('server_note', 'Note:') !!}
            {!! Form::textarea('server_note', null, ['class' => 'form-control', 'rows' => 2 ,'placeholder' => 'Optional']) !!}
        </div>
    @else
        <!-- Server Note Field -->
        <div class="form-group col-sm-12">
            {!! Form::label('server_note', 'Note:') !!}
            {!! Form::textarea('server_note', null, ['class' => 'form-control', 'rows' => 2 ,'placeholder' => 'Optional']) !!}
        </div>
    @endif
</div>

@if(Auth::user() && Auth::user()->role_id >= 29 )
    <div class="row">
        <!-- Admin Login Field -->
        <div class="form-group col-md-3 col-md-offset-3">
            {!! Form::label('admin_user', 'Administrator Login:') !!}
            {!! Form::text('admin_user', null, ['class' => 'form-control', 'placeholder' => 'Optional']) !!}
        </div>

        <!-- Admin Password Field -->
        <div class="form-group col-md-3">
            {!! Form::label('admin_password', 'Administrator Password:') !!}
            {!! Form::text('admin_password', null, ['class' => 'form-control', 'placeholder' => 'Optional']) !!}
        </div>
    </div>
@endif
</div>
<div class="box-footer">
<!-- Submit Field -->
<div class="form-group col-sm-12">
        <div class="text-center">
        {{-- <div class="col-md-2 col-md-offset-4 text-center"> --}}
        {!! Form::submit('Save', ['class' => 'btn btn100px btn-primary']) !!}
        {{-- <a href="{!! route('serverDetails.index') !!}" class="btn btn-default">Cancel</a> --}}
    {{-- </div>
    <div class="col-md-2 text-center"> --}}
        {{-- {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!} --}}
        <a href="{!! route('serverDetails.index') !!}" class="btn btn100px btn-default">Cancel</a>
    </div>
</div>

