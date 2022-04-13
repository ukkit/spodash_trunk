<!-- Intellicus Version Field -->
<div class="form-group">
    {!! Form::label('intellicus_version', 'Intellicus Version:') !!}
    <p>{{ $intellicusVersion->intellicus_version }}</p>
</div>

<!-- Intellicus Patch Field -->
<div class="form-group">
    {!! Form::label('intellicus_patch', 'Intellicus Patch:') !!}
    <p>{{ $intellicusVersion->intellicus_patch }}</p>
</div>

<!-- Release Date Field -->
<div class="form-group">
    {!! Form::label('release_date', 'Release Date:') !!}
    <p>{{ $intellicusVersion->release_date }}</p>
</div>

<!-- Is Active Field -->
<div class="form-group">
    {!! Form::label('is_active', 'Is Active:') !!}
    <p>{{ $intellicusVersion->is_active }}</p>
</div>

