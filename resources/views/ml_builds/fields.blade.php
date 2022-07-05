<!-- Ml Version Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ml_version', 'Ml Version:') !!}
    {!! Form::text('ml_version', null, ['class' => 'form-control']) !!}
</div>

<!-- Ml Build Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ml_build', 'Ml Build:') !!}
    {!! Form::number('ml_build', null, ['class' => 'form-control']) !!}
</div>

<!-- Pv Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pv_id', 'Pv Id:') !!}
    {!! Form::text('pv_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Release Build Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_release_build', 'Is Release Build:') !!}
    {!! Form::text('is_release_build', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('mlBuilds.index') }}" class="btn btn-default">Cancel</a>
</div>
