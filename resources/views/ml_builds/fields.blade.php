<!-- Ml Version Field -->
<div class="form-group col-sm-4">
    {!! Form::label('ml_version', 'ML Version:') !!}
    {!! Form::text('ml_version', null, ['class' => 'form-control']) !!}
</div>

<!-- Ml Build Field -->
<div class="form-group col-sm-4">
    {!! Form::label('ml_build', 'Build Number:') !!}
    {!! Form::number('ml_build', null, ['class' => 'form-control']) !!}
</div>

<!-- Pv Id Field -->
{{-- <div class="form-group col-sm-2">
    {!! Form::label('pv_id', 'Pv Id:') !!}
    {!! Form::text('pv_id', null, ['class' => 'form-control']) !!}
</div> --}}

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

{{-- <!-- Is Release Build Field -->
<div class="form-group col-sm-4">
    {!! Form::label('is_release_build', 'Is Release Build:') !!}
    {!! Form::text('is_release_build', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('mlBuilds.index') }}" class="btn btn-default">Cancel</a>
</div>
