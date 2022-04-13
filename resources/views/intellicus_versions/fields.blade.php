<div class="row">

    <!-- Intellicus Version Field -->
    <div class="form-group col-sm-2 col-sm-offset-2">
        {!! Form::label('intellicus_version', 'Version Number:') !!}
        {!! Form::text('intellicus_version', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Intellicus Patch Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('intellicus_patch', 'Patch Number:') !!}
        {!! Form::text('intellicus_patch', null, ['class' => 'form-control', 'placeholder' => 'optional']) !!}
    </div>

    <!-- Release Date Field -->
    <div class="form-group col-sm-2">
        {!! Form::label('release_date', 'Release Date:') !!}
        {!! Form::date('release_date', null, ['class' => 'form-control','id'=>'release_date']) !!}
    </div>

    @push('scripts')
        <script type="text/javascript">
            $('#release_date').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                useCurrent: false
            })
        </script>
    @endpush

    <!-- Is Active Field -->
    {{-- <div class="form-group col-sm-2">
        {!! Form::label('is_active', 'Release Is Active:') !!}
        {!! Form::text('is_active', null, ['class' => 'form-control']) !!}
    </div> --}}
    @if($show_is_active)
    <div class="form-group col-md-2">
        {!! Form::label('is_active', 'Release is Active?') !!}
        <div class="form-control">
                <label class="radio-inline">
                <input type="radio" name="is_active" value="Y" checked> Yes
            </label>
            <label class="radio-inline">
                <input type="radio" name="is_active" value= "N" @if($record->is_active == "N")  checked @endif> No
            </label>
        </div>
    </div>
    @endif

</div>

<hr>
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('intellicusVersions.index') }}" class="btn btn-default">Cancel</a>
    </div>
