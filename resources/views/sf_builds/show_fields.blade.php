<!-- Sf Pai Version Field -->
<div class="form-group">
    {!! Form::label('sf_pai_version', 'Sf Pai Version:') !!}
    <p>{{ $sfBuild->sf_pai_version }}</p>
</div>

<!-- Sf Pai Build Field -->
<div class="form-group">
    {!! Form::label('sf_pai_build', 'Sf Pai Build:') !!}
    <p>{{ $sfBuild->sf_pai_build }}</p>
</div>

<!-- Pv Id Field -->
<div class="form-group">
    {!! Form::label('pv_id', 'Pv Id:') !!}
    <p>{{ $sfBuild->pv_id }}</p>
</div>

<!-- Is Release Build Field -->
<div class="form-group">
    {!! Form::label('is_release_build', 'Is Release Build:') !!}
    <p>{{ $sfBuild->is_release_build }}</p>
</div>

