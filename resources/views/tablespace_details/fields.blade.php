<!-- Database Details Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('database_details_id', 'Database Details Id:') !!}
    {!! Form::number('database_details_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Tablespace Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tablespace_name', 'Tablespace Name:') !!}
    {!! Form::text('tablespace_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Used Space Field -->
<div class="form-group col-sm-6">
    {!! Form::label('used_space', 'Used Space:') !!}
    {!! Form::number('used_space', null, ['class' => 'form-control']) !!}
</div>

<!-- Free Space Field -->
<div class="form-group col-sm-6">
    {!! Form::label('free_space', 'Free Space:') !!}
    {!! Form::number('free_space', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Space Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_space', 'Total Space:') !!}
    {!! Form::number('total_space', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('tablespaceDetails.index') }}" class="btn btn-default">Cancel</a>
</div>
