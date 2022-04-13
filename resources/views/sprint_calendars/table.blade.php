<div class="table-responsive">
    <table class="table table-condensed table-striped table-responsive" id="sprintCalendars-table">
        <thead>
            <tr>
                <th>Sprint Number</th>
                <th>Sprint Start Date</th>
                <th>Sprint End Date</th>
                {{-- <th>Sprint End Date Same As Next Start Date</th> --}}
                {{-- <th colspan="3">Action</th> --}}
            </tr>
        </thead>
        <tbody>
            @php
            $sprint = null;
            $sprint = \App\Models\Sprint_calendar::current_sprint();
            @endphp
        @foreach($sprintCalendars as $sprintCalendar)
            <tr>

                <td>
                    {{ $sprintCalendar->sprint_number }}
                    @if( $sprintCalendar->sprint_number == $sprint)
                    &nbsp;&nbsp;<i class="fas fa-bolt" title="Active Sprint"></i>
                    @endif
                </td>
                {{-- <td>{{ $sprintCalendar->sprint__date }}</td> --}}
                {{-- <td> {!! Carbon\Carbon::parse($sprintCalendar->sprint_start_date)->toDateString() !!} </td> --}}
                <td> {!! Carbon\Carbon::parse($sprintCalendar->sprint_start_date)->format('d-M-Y') !!} </td>
                {{-- <td> {!! Carbon\Carbon::parse($sprintCalendar->sprint_end_date)->toDateString() !!} </td> --}}
                <td> {!! Carbon\Carbon::parse($sprintCalendar->sprint_end_date)->format('d-M-Y') !!} </td>


                {{-- <td>{{ $sprintCalendar->sprint_end_date_same_as_next_start_date }}</td> --}}
                {{-- <td>
                    {!! Form::open(['route' => ['sprintCalendars.destroy', $sprintCalendar->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('sprintCalendars.show', [$sprintCalendar->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('sprintCalendars.edit', [$sprintCalendar->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td> --}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
