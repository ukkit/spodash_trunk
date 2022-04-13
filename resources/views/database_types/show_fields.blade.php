<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $databaseType->id !!}</p>
</div>

<!-- Db Short Name Field -->
<div class="form-group">
    {!! Form::label('db_short_name', 'Db Short Name:') !!}
    <p>{!! $databaseType->db_short_name !!}</p>
</div>

<!-- Db Long Name Field -->
<div class="form-group">
    {!! Form::label('db_long_name', 'Db Long Name:') !!}
    <p>{!! $databaseType->db_long_name !!}</p>
</div>

<!-- Db Patchset Field -->
<div class="form-group">
    {!! Form::label('db_patchset', 'Db Patchset:') !!}
    <p>{!! $databaseType->db_patchset !!}</p>
</div>

<!-- Db Is Active Field -->
<div class="form-group">
    {!! Form::label('db_is_active', 'Db Is Active:') !!}
    <p>{!! $databaseType->db_is_active !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $databaseType->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $databaseType->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $databaseType->deleted_at !!}</p>
</div>

