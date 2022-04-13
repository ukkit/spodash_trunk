<div class="table-responsive">
    <table class="table table-responsive table-striped table-bordered table-condensed" id="teams-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Team Name</th>
                <th>Team Email</th>
                @can('edit_serverUses')
                <th class="text-center"><i class="fas fa-tools" title="Actions"><i></th>
                @endcan
            </tr>
        </thead>
        <tbody>
        @foreach($teams as $team)
            <tr>
                <td>{!! $team->id !!}</td>
                <td>{!! $team->team_name !!}</td>
                <td>{!! $team->team_email !!}</td>
                @can('edit_serverUses')
                <td class="text-center">
                    {!! Form::open(['class'=>'inline','route' => ['teams.edit', $team->id], 'method' => 'get']) !!}
                    {!! Form::button('<i class="fas fa-pencil-alt" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-xs']) !!}
                    {!! Form::close() !!}
                </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
