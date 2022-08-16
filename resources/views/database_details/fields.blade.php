<?php
$repo_array = ["SPO","PAI","Intellicus"];
?>
    <div class="row">
        <!-- Server Name Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('server_details_id', 'Server:') !!}
            <!-- {!! Form::number('server_details_id', null, ['class' => 'form-control']) !!} -->
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

        <!-- Database Types Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('database_types_id', 'Database:') !!}
            <!-- {!! Form::number('database_types_id', null, ['class' => 'form-control']) !!} -->
            <select name="database_types_id" class="form-control select-db-type">
                <option value="">Select .... </option>
                @foreach($database_type as $dbt)
                    @if($this_is_edit)
                        <option value="{{ $dbt->id }}" @if($dbt->id==$record->database_types_id) selected='selected' @endif > {{ $dbt->db_long_name }}</option>
                    @else
                        <option value="{{ $dbt->id }}">{{ $dbt->db_long_name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- Db User Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('db_user', 'DB User:') !!}
            {!! Form::text('db_user', null, ['class' => 'form-control','required']) !!}
        </div>

        <!-- Db Pass Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('db_pass', 'DB Password:') !!}
            {!! Form::text('db_pass', null, ['class' => 'form-control','required']) !!}
        </div>

        <!-- Db Sid Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('db_sid', 'DB SID/Name:') !!}
            {!! Form::text('db_sid', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>

    <div class="row">
        <!-- Db Port Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('db_port', 'DB Port Number:') !!}
            {!! Form::number('db_port', null, ['class' => 'form-control', 'placeholder' => '1521 / 1433', 'required']) !!}
        </div>

        <!-- Repository Type Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('repository_type', 'Repository:') !!}
            <select name="repository_type" class="form-control">
                <option value="">Select .... </option>
                @foreach($repo_array as $jta)
                    @if($this_is_edit)
                    <option value="{{ $jta }}" @if($jta==$record->repository_type) selected='selected' @endif >{{ $jta }}</option>
                    @else
                        <option value="{{ $jta }}">{{ $jta }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- Ambari Details Id Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('ambari_details_id', 'Ambari:') !!}
            <select name="ambari_details_id" class="form-control select-server-name">
                <option value="">Select .... </option>
                @foreach($ambari_detail as $ada)
                    @if($this_is_edit)
                        <option value="{{ $ada->id }}" @if($ada->id==$record->ambari_details_id) selected='selected' @endif >{{ $ada->ambari_name }}</option>
                    @else
                        <option value="{{ $ada->id }}">{{ $ada->ambari_name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- JIRA Number Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('jira_number', 'JIRA Number:') !!}
            {!! Form::text('jira_number', null, ['class' => 'form-control', 'placeholder' => 'Optional / SPM-1234']) !!}
        </div>

        <!-- Db Notes Field -->
        <div class="form-group col-sm-4 col-lg-4">
            {!! Form::label('db_notes', 'Notes:') !!}
            {!! Form::textarea('db_notes', null, ['class' => 'form-control', 'rows' => 1, 'placeholder' => 'Optional']) !!}
        </div>
    </div>

    @if($show_is_active)
    <div class="row">

        <!-- Server Is Active Field -->
        <div class="form-group col-md-2 col-md-offset-4">
            {!! Form::label('db_is_active', 'Database is Active?') !!}
            <div class="form-control">
                    <label class="radio-inline">
                    <input type="radio" name="db_is_active" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="db_is_active" value= "N" @if($record->db_is_active == "N")  checked @endif> No
                </label>
            </div>
        </div>

        <!-- Is DBA Field -->
        <div class="form-group col-md-2">
            {!! Form::label('is_dba', 'User is DBA?') !!}
            <div class="form-control">
                    <label class="radio-inline">
                    <input type="radio" name="is_dba" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="is_dba" value= "N" @if($record->is_dba == "N")  checked @endif> No
                </label>
            </div>
        </div>

        <!-- Is DBA Field -->
        {{-- <div class="form-group col-md-2">
            {!! Form::label('is_intellicus_repository', 'Intellicus Repository') !!}
            <div class="form-control">
                    <label class="radio-inline">
                    <input type="radio" name="is_intellicus_repository" value="Y" checked> Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="is_intellicus_repository" value= "N" @if($record->is_intellicus_repository == "N")  checked @endif> No
                </label>
            </div>
        </div> --}}
    </div>

    @endif
</div>
<div class="box-footer">
<!-- Submit Field -->
<div class="form-group col-sm-12">
        <div class="text-center">
        {!! Form::submit('Save', ['class' => 'btn btn100px btn-primary']) !!}
        <a href="{!! route('databaseDetails.index') !!}" class="btn btn100px btn-default">Cancel</a>
    </div>
</div>