<!-- Database Details Id Field -->
<div class="form-group">
    {!! Form::label('database_details_id', 'Database Details Id:') !!}
    <p>{{ $tablespaceDetail->database_details_id }}</p>
</div>

<!-- Tablespace Name Field -->
<div class="form-group">
    {!! Form::label('tablespace_name', 'Tablespace Name:') !!}
    <p>{{ $tablespaceDetail->tablespace_name }}</p>
</div>

<!-- Used Space Field -->
<div class="form-group">
    {!! Form::label('used_space', 'Used Space:') !!}
    <p>{{ $tablespaceDetail->used_space }}</p>
</div>

<!-- Free Space Field -->
<div class="form-group">
    {!! Form::label('free_space', 'Free Space:') !!}
    <p>{{ $tablespaceDetail->free_space }}</p>
</div>

<!-- Total Space Field -->
<div class="form-group">
    {!! Form::label('total_space', 'Total Space:') !!}
    <p>{{ $tablespaceDetail->total_space }}</p>
</div>

