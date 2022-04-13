<table class="table table-responsive table-condensed table-striped" id="osTypes-table">
    <thead>
        <tr>
        <th class="text-center id_column">ID</th>
        <th>Short Name</th>
        <th>Long Name</th>
        <th>Patch Number</th>
        <th class="text-center">Active</th>
        @canany('edit_osTypes','delete_osTypes')
        <th class="text-center icon_column"><i class="fas fa-tools" title="Actions"></i></th>
        @endcanany
        </tr>
    </thead>
    <tbody>
    @foreach($osTypes as $osType)
        <tr>
            <td class="text-center">{!! $osType->id !!}</td>
            <td>{!! $osType->os_short_name !!}</td>
            <td>{!! $osType->os_long_name !!}</td>
            <td>{!! $osType->os_patchset !!}</td>
            <!-- <td class="text-center">{!! $osType->os_is_active !!}</td> -->
            @if($osType->os_is_active == "Y")
                <td class="text-center">
                Yes
            @else
                <td class="danger text-center">
                No
            @endif
            @canany('edit_osTypes','delete_osTypes')
            <td class="text-center">
                {!! Form::open(['route' => ['osTypes.destroy', $osType->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('osTypes.edit', [$osType->id]) !!}" class='btn btn-info btn-xs'><i class="fas fa-pencil-alt" title="Edit"></i></a>
                </div>
                {!! Form::close() !!}
            </td>
            @endcanany
        </tr>
    @endforeach
    </tbody>
</table>