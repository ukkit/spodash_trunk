<!-- Sf Pai Version Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sf_pai_version', 'Sf Pai Version:') !!}
    {!! Form::text('sf_pai_version', null, ['class' => 'form-control']) !!}
</div>

<!-- Sf Pai Build Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sf_pai_build', 'Sf Pai Build:') !!}
    {!! Form::number('sf_pai_build', null, ['class' => 'form-control']) !!}
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
    <a href="{{ route('sfBuilds.index') }}" class="btn btn-default">Cancel</a>
</div>
