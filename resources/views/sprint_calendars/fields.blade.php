<!-- Sprint Number Field -->
<div class="form-group col-sm-4">
    {!! Form::label('sprint_number', 'Sprint Number:') !!}
    {!! Form::number('sprint_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Sprint Start Date Field -->
<div class="form-group col-sm-4">
    {!! Form::label('sprint_start_date', 'Sprint Start Date:') !!}
    {!! Form::date('sprint_start_date', null, ['class' => 'form-control','id'=>'sprint_start_date']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#sprint_start_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush

<!-- Sprint Start Date Field -->
<div class="form-group col-sm-4">
    {!! Form::label('sprint_end_date', 'Sprint End Date:') !!}
    {!! Form::date('sprint_end_date', null, ['class' => 'form-control','id'=>'sprint_end_date']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#sprint_end_date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush

<!-- Sprint End Date Same As Next Start Date Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('sprint_end_date_same_as_next_start_date', 'Sprint End Date Same As Next Start Date:') !!}
    {!! Form::text('sprint_end_date_same_as_next_start_date', null, ['class' => 'form-control']) !!}
</div> --}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('sprintCalendars.index') }}" class="btn btn-default">Cancel</a>
</div>
