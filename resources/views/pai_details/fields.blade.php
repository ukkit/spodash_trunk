<?php
$pai_type_array = array("pai-hadoop","pai-oracle");
?>
    <div class="row">

        <!-- Server Details Id Field -->
        {{-- <div class="form-group col-sm-3">
            {!! Form::label('server_details_id', 'Server Details Id:') !!}
            {!! Form::number('server_details_id', null, ['class' => 'form-control']) !!}
        </div> --}}
        <!-- Server Details Id Field -->
        <div class="form-group col-sm-2 col-sm-offset-2">
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

        <!-- PAI Details Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('pai_type', 'PAI Type:') !!}
            <select name="pai_type" class="form-control">
                <option value="">Select .... </option>
                @foreach($pai_type_array as $pta)
                    @if($this_is_edit)
                    <option value="{{ $pta }}" @if($pta==$record->pai_type) selected='selected' @endif >{{ $pta }}</option>
                    @else
                        <option value="{{ $pta }}">{{ $pta }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        {{-- <div class="form-group col-sm-3">
            {!! Form::label('ambari_details_id', 'Ambari Details Id:') !!}
            {!! Form::number('ambari_details_id', null, ['class' => 'form-control']) !!}
        </div> --}}
    </div>
    <div class="row">
        <!-- pai User Field -->
        <div class="form-group col-sm-2 col-sm-offset-2">
            {!! Form::label('pai_user', 'Username:') !!}
            {!! Form::text('pai_user', null, ['class' => 'form-control']) !!}
        </div>

        <!-- pai Pwd Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('pai_pwd', 'Password:') !!}
            {!! Form::text('pai_pwd', null, ['class' => 'form-control']) !!}
        </div>

        <!-- pai Db Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('pai_db', 'Database:') !!}
            {!! Form::text('pai_db', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Oracle Port Field -->
        <div class="form-group col-sm-1">
            {!! Form::label('pai_port', 'Port No:') !!}
            {!! Form::text('pai_port', null, ['class' => 'form-control', 'placeholder' => 'Optional']) !!}
        </div>
    </div>
</div>

<div class="box-footer">
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
            <div class="text-center">
            {!! Form::submit('Save', ['class' => 'btn btn100px btn-primary']) !!}
            <a href="{!! route('paiDetails.index') !!}" class="btn btn100px btn-default">Cancel</a>
        </div>
    </div>

<!-- Submit Field -->
{{-- <div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('paiDetails.index') }}" class="btn btn-default">Cancel</a>
</div> --}}
