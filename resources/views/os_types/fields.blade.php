<?php
$os_family_array = array("microsoft","red-hat","centos","suse");
?>

<!-- Os Short Name Field -->
<div class="form-group col-sm-2">
    {!! Form::label('os_family', 'OS Family:') !!}
    {{-- <select name="server_class" class="form-control select-server-type"> --}}
    <select name="os_family" class="form-control">
        <option value="">Select .... </option>
        @foreach($os_family_array as $sca)
            @if($this_is_edit)
            <option value="{{ $sca }}" @if($sca==$record->os_family) selected='selected' @endif >{{ $sca }}</option>
            @else
                <option value="{{ $sca }}">{{ $sca }}</option>
            @endif
        @endforeach
    </select>
</div>

<!-- Os Short Name Field -->
<div class="form-group col-sm-2">
    {!! Form::label('os_short_name', 'Short Name:') !!}
    {!! Form::text('os_short_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Os Long Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('os_long_name', 'Long Name:') !!}
    {!! Form::text('os_long_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Os Patchset Field -->
<div class="form-group col-sm-2">
    {!! Form::label('os_patchset', 'Patch Number:') !!}
    {!! Form::text('os_patchset', null, ['class' => 'form-control', 'placeholder' => 'Optional']) !!}
</div>

<!-- Os Is Active Field -->
@if($show_is_active)
    <div class="form-group col-sm-2">
        {!! Form::label('os_is_active', 'OS is Active?') !!}
        <div class="form-control">
                <label class="radio-inline">
                <input type="radio" name="os_is_active" value="Y" checked> Yes
            </label>
            <label class="radio-inline">
                <input type="radio" name="os_is_active" value= "N" @if($record->os_is_active == "N")  checked @endif> No
            </label>
        </div>
    </div>
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('osTypes.index') !!}" class="btn btn-default">Cancel</a>
</div>
