<!-- Ml Version Field -->
<div class="form-group">
    {!! Form::label('ml_version', 'Ml Version:') !!}
    <p>{{ $mlBuild->ml_version }}</p>
</div>

<!-- Ml Build Field -->
<div class="form-group">
    {!! Form::label('ml_build', 'Ml Build:') !!}
    <p>{{ $mlBuild->ml_build }}</p>
</div>

<!-- Pv Id Field -->
<div class="form-group">
    {!! Form::label('pv_id', 'Pv Id:') !!}
    <p>{{ $mlBuild->pv_id }}</p>
</div>

<!-- Is Release Build Field -->
<div class="form-group">
    {!! Form::label('is_release_build', 'Is Release Build:') !!}
    <p>{{ $mlBuild->is_release_build }}</p>
</div>

