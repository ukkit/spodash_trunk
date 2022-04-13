<!-- Server Details Id Field -->
<div class="form-group">
    {!! Form::label('server_details_id', 'Server Details Id:') !!}
    <p>{{ $mlDetail->server_details_id }}</p>
</div>

<!-- Instance Details Id Field -->
<div class="form-group">
    {!! Form::label('instance_details_id', 'Instance Details Id:') !!}
    <p>{{ $mlDetail->instance_details_id }}</p>
</div>

<!-- Intellicus Details Id Field -->
<div class="form-group">
    {!! Form::label('intellicus_details_id', 'Intellicus Details Id:') !!}
    <p>{{ $mlDetail->intellicus_details_id }}</p>
</div>

<!-- Database Details Id Field -->
<div class="form-group">
    {!! Form::label('database_details_id', 'Database Details Id:') !!}
    <p>{{ $mlDetail->database_details_id }}</p>
</div>

<!-- Ml Name Field -->
<div class="form-group">
    {!! Form::label('ml_name', 'Ml Name:') !!}
    <p>{{ $mlDetail->ml_name }}</p>
</div>

<!-- Zeppelin Port Field -->
<div class="form-group">
    {!! Form::label('zeppelin_port', 'Zeppelin Port:') !!}
    <p>{{ $mlDetail->zeppelin_port }}</p>
</div>

<!-- Zeppelin User Field -->
<div class="form-group">
    {!! Form::label('zeppelin_user', 'Zeppelin User:') !!}
    <p>{{ $mlDetail->zeppelin_user }}</p>
</div>

<!-- Zeppelin Pwd Field -->
<div class="form-group">
    {!! Form::label('zeppelin_pwd', 'Zeppelin Pwd:') !!}
    <p>{{ $mlDetail->zeppelin_pwd }}</p>
</div>

<!-- Installed Path Field -->
<div class="form-group">
    {!! Form::label('installed_path', 'Installed Path:') !!}
    <p>{{ $mlDetail->installed_path }}</p>
</div>

<!-- Notes Field -->
<div class="form-group">
    {!! Form::label('notes', 'Notes:') !!}
    <p>{{ $mlDetail->notes }}</p>
</div>

