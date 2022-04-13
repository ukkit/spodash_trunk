<table class="table table-responsive table-striped table-condensed" id="productVersions-table">
    <thead>
        <tr>
            <th class="text-center id_column">ID</th>
            <th>PV_ID</th>
            <th>Version Number</th>
            <th>Build Numer</th>
            <th class="text-center">Release Build</th>
            <th>Instance Count</th>
            <th class="hidden">RB</th>
            @can('edit_productVersions')
            <th class="text-center icon_column"><i class="fas fa-tools" title="Actions"><i></th>
            @endcan
            <!-- <th colspan="3">Action</th> -->
        </tr>
    </thead>
    <tbody>
    @foreach($productVersions as $productVersion)
        @php
            $inst_count = count($productVersion->instance_list_by_pvid($productVersion->pv_id));
            if ($inst_count > 0) {
                $display = "<a href=\"" . route('productVersions.show', [$productVersion->id])."\"><strong> $inst_count </strong></a>";
            } else {
                $display = Null;
            }
        @endphp
        <tr>
            <td class="text-center">{!! $productVersion->id !!}</td>
            <td>{!! $productVersion->pv_id !!}</td>
            <td>{!! $productVersion->product_ver_number !!}</td>
            <td>{!! $productVersion->product_build_numer !!}</td>
            @if($productVersion->is_release_build == "Y")
                <td class="danger text-center"> Yes </td>
            @else
                <td class="text-center"> No </td>
            @endif
            <td>{!! $display !!}</td>
            <td class="hidden">
                @if($productVersion->is_release_build == "Y")
                    Release Build
                @endif
            </td>
            @can('edit_productVersions')
            <td class="text-center">
                {!! Form::open(['route' => ['productVersions.destroy', $productVersion->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('productVersions.edit', [$productVersion->id]) !!}" class='btn btn-info btn-xs'><i class="fas fa-pencil-alt"></i></a>
                </div>
                {!! Form::close() !!}
            </td>
            @endcan
        </tr>
    @endforeach
    </tbody>
</table>