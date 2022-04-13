<!-- Server Details Id Field -->
<div class="form-group">
    {!! Form::label('server_details_id', 'Server Details Id:') !!}
    <p>{{ $dbaDetail->server_details_id }}</p>
</div>

<!-- Dba User Field -->
<div class="form-group">
    {!! Form::label('dba_user', 'Dba User:') !!}
    <p>{{ $dbaDetail->dba_user }}</p>
</div>

<!-- Dba Password Field -->
<div class="form-group">
    {!! Form::label('dba_password', 'Dba Password:') !!}
    <p>{{ $dbaDetail->dba_password }}</p>
</div>

<!-- Db Sid Field -->
<div class="form-group">
    {!! Form::label('db_sid', 'Db Sid:') !!}
    <p>{{ $dbaDetail->db_sid }}</p>
</div>

