<!-- Sprint Number Field -->
<div class="form-group">
    {!! Form::label('sprint_number', 'Sprint Number:') !!}
    <p>{{ $sprintCalendar->sprint_number }}</p>
</div>

<!-- Sprint Start Date Field -->
<div class="form-group">
    {!! Form::label('sprint_start_date', 'Sprint Start Date:') !!}
    <p>{{ $sprintCalendar->sprint_start_date }}</p>
</div>

<!-- Sprint Start Date Field -->
<div class="form-group">
    {!! Form::label('sprint_end_date', 'Sprint End Date:') !!}
    <p>{{ $sprintCalendar->sprint_start_date }}</p>
</div>

<!-- Sprint End Date Same As Next Start Date Field -->
<div class="form-group">
    {!! Form::label('sprint_end_date_same_as_next_start_date', 'Sprint End Date Same As Next Start Date:') !!}
    <p>{{ $sprintCalendar->sprint_end_date_same_as_next_start_date }}</p>
</div>

