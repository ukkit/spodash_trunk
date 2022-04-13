<div class="table-responsive">
    <table class="table table-responsive table-striped table-condensed" id="paiBuilds-table">
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
        @foreach($paiBuilds as $paiBuild)
            @php
                $inst_count = count($paiBuild->instance_list_by_pvid($paiBuild->pv_id));
                if ($inst_count > 0) {
                    // $display = "<strong> $inst_count </strong>";
                    $display = "<a href=\"" . route('paiBuilds.show', [$paiBuild->id])."\"><strong> $inst_count </strong></a>";
                } else {
                    $display = Null;
                }
            @endphp
            <tr>
                <td class="text-center">{!! $paiBuild->id !!}</td>
                <td>{{ $paiBuild->pv_id }}</td>
                <td>{{ $paiBuild->pai_version }}</td>
                <td>{{ $paiBuild->pai_build }}</td>
                @if($paiBuild->is_release_build == "Y")
                    <td class="danger text-center"> Yes </td>
                @else
                    <td class="text-center"> No </td>
                @endif
            <td>{!! $display !!}</td>
            <td class="hidden">
                @if($paiBuild->is_release_build == "Y")
                    Release Build
                @endif
            </td>
            @can('edit_productVersions')
                <td class="text-center">
                    {!! Form::open(['route' => ['paiBuilds.destroy', $paiBuild->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('paiBuilds.edit', [$paiBuild->id]) !!}" class='btn btn-info btn-xs'><i class="fas fa-pencil-alt"></i></a>
                    </div>
                    {!! Form::close() !!}
                </td>
            @endcan

            </tr>
        @endforeach
        </tbody>
    </table>
</div>
