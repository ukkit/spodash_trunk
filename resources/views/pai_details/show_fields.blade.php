<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $paiDetail->name }}</p>
</div>

<!-- Server Details Id Field -->
<div class="form-group">
    {!! Form::label('server_details_id', 'Server Details Id:') !!}
    <p>{{ $paiDetail->server_details_id }}</p>
</div>

<!-- Ambari Details Id Field -->
<div class="form-group">
    {!! Form::label('ambari_details_id', 'Ambari Details Id:') !!}
    <p>{{ $paiDetail->ambari_details_id }}</p>
</div>

<!-- Hive User Field -->
<div class="form-group">
    {!! Form::label('hive_user', 'Hive User:') !!}
    <p>{{ $paiDetail->hive_user }}</p>
</div>

<!-- Hive Pwd Field -->
<div class="form-group">
    {!! Form::label('hive_pwd', 'Hive Pwd:') !!}
    <p>{{ $paiDetail->hive_pwd }}</p>
</div>

<!-- Hive Db Field -->
<div class="form-group">
    {!! Form::label('hive_db', 'Hive Db:') !!}
    <p>{{ $paiDetail->hive_db }}</p>
</div>

<!-- Oracle User Field -->
<div class="form-group">
    {!! Form::label('oracle_user', 'Oracle User:') !!}
    <p>{{ $paiDetail->oracle_user }}</p>
</div>

<!-- Oracle Pwd Field -->
<div class="form-group">
    {!! Form::label('oracle_pwd', 'Oracle Pwd:') !!}
    <p>{{ $paiDetail->oracle_pwd }}</p>
</div>

<!-- Oracle Sid Field -->
<div class="form-group">
    {!! Form::label('oracle_sid', 'Oracle Sid:') !!}
    <p>{{ $paiDetail->oracle_sid }}</p>
</div>

<!-- Oracle Port Field -->
<div class="form-group">
    {!! Form::label('oracle_port', 'Oracle Port:') !!}
    <p>{{ $paiDetail->oracle_port }}</p>
</div>

