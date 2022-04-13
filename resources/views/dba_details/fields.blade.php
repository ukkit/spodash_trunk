
    {{-- <div class="row"> --}}
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

        <!-- Dba User Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('dba_user', 'Dba User:') !!}
            {!! Form::text('dba_user', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Dba Password Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('dba_password', 'Dba Password:') !!}
            {!! Form::text('dba_password', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Db Sid Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('db_sid', 'Db Sid:') !!}
            {!! Form::text('db_sid', null, ['class' => 'form-control']) !!}
        </div>
    {{-- </div>
</div> --}}

<div class="box-footer">
<!-- Submit Field -->
    <div class="form-group col-sm-12">
        <div class="text-center">
        {!! Form::submit('Save', ['class' => 'btn btn100px btn-primary']) !!}
        <a href="{!! route('dbaDetails.index') !!}" class="btn btn100px btn-default">Cancel</a>
    </div>
</div>

<!-- Server Details Id Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('server_details_id', 'Server Details Id:') !!}
    {!! Form::number('server_details_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Dba User Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dba_user', 'Dba User:') !!}
    {!! Form::text('dba_user', null, ['class' => 'form-control']) !!}
</div>

<!-- Dba Password Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('dba_password', 'Dba Password:') !!}
    {!! Form::textarea('dba_password', null, ['class' => 'form-control']) !!}
</div>

<!-- Db Sid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('db_sid', 'Db Sid:') !!}
    {!! Form::text('db_sid', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('dbaDetails.index') }}" class="btn btn-default">Cancel</a>
</div> --}}
