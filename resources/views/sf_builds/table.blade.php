<div class="table-responsive">
    <table class="table table-responsive table-striped table-condensed"  id="sfBuilds-table">
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th>PV_ID</th>
                <th>Version Number</th>
                <th>Build Number</th>
                <th class="text-center">Release Build</th>
                <th>Instance Count</th>
                <th class="hidden">RB</th>
                @can('edit_productVersions')
                <th class="text-center icon_column"><i class="fas fa-tools" title="Actions"><i></th>
                @endcan
            </tr>
        </thead>
        <tbody>
        @foreach($sfBuilds as $sfBuild)
            @php
                $inst_count = count($sfBuild->instance_list_by_pvid($sfBuild->pv_id));
                if ($inst_count > 0) {
                    $display = "<strong> $inst_count </strong>";
                } else {
                    $display = Null;
                }
            @endphp
            <tr>
                <td class="text-center">{!! $sfBuild->id !!}</td>
                <td>{{ $sfBuild->pv_id }}</td>
                <td>{{ $sfBuild->sf_pai_version }}</td>
                <td>{{ $sfBuild->sf_pai_build }}</td>
                @if($sfBuild->is_release_build == "Y")
                    <td class="danger text-center"> Yes </td>
                @else
                    <td class="text-center"> No </td>
                @endif
                <td>{!! $display !!}</td>
                <td class="hidden">
                    @if($sfBuild->is_release_build == "Y")
                        Release Build
                    @endif
                </td>
                @can('edit_productVersions')
                <td class="text-center">
                    {!! Form::open(['route' => ['sfBuilds.destroy', $sfBuild->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('sfBuilds.edit', [$sfBuild->id]) !!}" class='btn btn-info btn-xs'><i class="fas fa-pencil-alt"></i></a>
                    </div>
                    {!! Form::close() !!}
                </td>
                @endcan

                {{-- <td>
                    {!! Form::open(['route' => ['sfBuilds.destroy', $sfBuild->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('sfBuilds.show', [$sfBuild->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('sfBuilds.edit', [$sfBuild->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td> --}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
