<!-- Pai Version Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pai_version', 'Pai Version:') !!}
    {!! Form::text('pai_version', null, ['class' => 'form-control']) !!}
</div>

<!-- Pai Build Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pai_build', 'Pai Build:') !!}
    {!! Form::number('pai_build', null, ['class' => 'form-control']) !!}
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
    <a href="{{ route('paiBuilds.index') }}" class="btn btn-default">Cancel</a>
</div>
