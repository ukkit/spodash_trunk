<table class="table table-responsive table-striped table-bordered table-condensed" id="serverUses-table">
    <thead>
        <tr>
            <!-- <th>Server Details Id</th> -->
            <th class="text-center id_column">ID</th>
            <th>Short Name</th>
            <th>Long Name</th>
            @can('edit_serverUses')
            <th class="text-center icon_column"><i class="fas fa-tools" title="Actions"><i></th>
            @endcan
            <!-- <th colspan="3">Action</th> -->
        </tr>
    </thead>
    <tbody>
    @foreach($serverUses as $serverUse)
        <tr>
            <td class="text-center">{!! $serverUse->id !!}</td>
            <td>{!! $serverUse->use_short_name !!}</td>
            <td>{!! $serverUse->use_long_name !!}</td>
            @can('edit_serverUses')
            <td class="text-center">
                {!! Form::open(['route' => ['serverUses.destroy', $serverUse->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('serverUses.edit', [$serverUse->id]) !!}" class='btn btn-info btn-xs'><i class="fas fa-pencil-alt"></i></a>
                </div>
                {!! Form::close() !!}
            </td>
            @endcan
        </tr>
    @endforeach
    </tbody>
</table>