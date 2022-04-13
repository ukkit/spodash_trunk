<?php
$is_active_array = array("Y","N");
?>
<!-- Db Short Name Field -->
<div class="form-group col-sm-2">
    {!! Form::label('db_short_name', 'Short Name:') !!}
    {!! Form::text('db_short_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Db Long Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('db_long_name', 'Long Name:') !!}
    {!! Form::text('db_long_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Db Patchset Field -->
<div class="form-group col-sm-2">
    {!! Form::label('db_patchset', 'Patchset Number:') !!}
    {!! Form::text('db_patchset', null, ['class' => 'form-control', 'placeholder' => 'Optional']) !!}
</div>


<!-- <div class="form-group col-sm-2">
    {!! Form::label('db_is_active', 'Active:') !!}
    {!! Form::text('db_is_active', null, ['class' => 'form-control']) !!}
</div> -->

@if($show_is_active)
<!-- Db Is Active Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('db_is_active', 'DB Type is Active?') !!}
        <div class="form-control">
                <label class="radio-inline">
                <input type="radio" name="db_is_active" value="Y" checked> Yes
            </label>
            <label class="radio-inline">
                <input type="radio" name="db_is_active" value= "N" @if($record->db_is_active == "N")  checked @endif> No
            </label>
        </div>
    </div>
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('databaseTypes.index') !!}" class="btn btn-default">Cancel</a>
</div>
