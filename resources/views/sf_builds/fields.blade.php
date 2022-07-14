<!-- Sf Pai Version Field -->
<div class="form-group col-sm-4">
    {!! Form::label('sf_pai_version', 'Snowflake Version:') !!}
    {!! Form::text('sf_pai_version', null, ['class' => 'form-control']) !!}
</div>

<!-- Sf Pai Build Field -->
<div class="form-group col-sm-4">
    {!! Form::label('sf_pai_build', 'Build Number:') !!}
    {!! Form::number('sf_pai_build', null, ['class' => 'form-control']) !!}
</div>

@if($this_is_edit)
<!-- Server Show On Site Field -->
<div class="form-group col-sm-4">
    {!! Form::label('is_release_build', 'This is Release Build?') !!}
    <div class="form-control">
            <label class="radio-inline">
            <input type="radio" name="is_release_build" value="Y" @if($record->is_release_build == "N")  checked @endif> Yes
        </label>
        <label class="radio-inline">
            <input type="radio" name="is_release_build" value= "N" checked> No
        </label>
    </div>
</div>
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('sfBuilds.index') }}" class="btn btn-default">Cancel</a>
</div>
