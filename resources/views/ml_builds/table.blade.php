<div class="table-responsive">
    <table class="table table-responsive table-striped table-condensed"  id="mlBuilds-table">
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th>PV_ID</th>
                <th>Version Number</th>
                <th>Build Number</th>
                <th class="text-center">Release Build</th>
                {{-- <th>Instance Count</th> --}}
                {{-- <th class="hidden">RB</th> --}}
                @can('edit_productVersions')
                <th class="text-center icon_column"><i class="fas fa-tools" title="Actions"><i></th>
                @endcan
            </tr>
        </thead>
        <tbody>
        @foreach($mlBuilds as $mlBuild)
            <tr>
                <td class="text-center">{{ $mlBuild->id }}</td>
                <td>{{ $mlBuild->pv_id }}</td>
                <td>{{ $mlBuild->ml_version }}</td>
                <td>{{ $mlBuild->ml_build }}</td>
                @if($mlBuild->is_release_build == "Y")
                    <td class="danger text-center"> Yes </td>
                @else
                    <td class="text-center"> No </td>
                @endif
                {{-- <td>{{ $mlBuild->is_release_build }}</td> --}}
                @can('edit_productVersions')
                <td class="text-center">
                    {!! Form::open(['route' => ['mlBuilds.destroy', $mlBuild->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('mlBuilds.edit', [$mlBuild->id]) !!}" class='btn btn-info btn-xs'><i class="fas fa-pencil-alt"></i></a>
                    </div>
                    {!! Form::close() !!}
                </td>
                @endcan
                    {{-- {!! Form::open(['route' => ['mlBuilds.destroy', $mlBuild->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('mlBuilds.show', [$mlBuild->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('mlBuilds.edit', [$mlBuild->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!} --}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
