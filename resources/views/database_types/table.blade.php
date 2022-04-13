<table class="table table-responsive table-condensed table-striped" id="databaseTypes-table">
    <thead>
        <tr>
        <th class="text-center id_column">ID</th>
        <th>Short Name</th>
        <th>Long Name</th>
        <th>Patchset Number</th>
        <th class="text-center">Active</th>
        @canany('edit_databaseTypes','delete_databaseTypes')
        <th class="text-center action_column"><i class="fas fa-tools" title="Actions"></i></th>
        @endcanany
        <!-- <th colspan="3">Action</th> -->
        </tr>
    </thead>
    <tbody>
    @foreach($databaseTypes as $databaseType)
        <tr>
            <td class="text-center">{!! $databaseType->id !!}</td>
            <td>{!! $databaseType->db_short_name !!}</td>
            <td>{!! $databaseType->db_long_name !!}</td>
            <td>{!! $databaseType->db_patchset !!}</td>
            <!-- <td class="text-center">{!! $databaseType->db_is_active !!}</td> -->
            @if($databaseType->db_is_active == "Y")
                <td class="text-center">
                    <i class="far fa-check-circle" title="YES"></i>
            @else
                <td class="danger text-center">
                    <i class="far fa-times-circle" title="NO"></i>
            @endif
            @canany('edit_databaseTypes','delete_databaseTypes')
                <td class="text-center">
                    <div class="btn-btn-group-justified">
                        @can('edit_databaseTypes')
                            {!! Form::open(['class'=>'inline','route' => ['databaseTypes.edit', $databaseType->id], 'method' => 'get']) !!}
                            {{-- {!! Form::button('<i class="far fa-edit" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-xs']) !!} --}}
                            {!! Form::button('<i class="fas fa-pencil-alt" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-xs']) !!}
                            {!! Form::close() !!}
                        @endcan
                        @can('delete_databaseTypes')
                            {!! Form::open(['class'=>'inline','route' => ['databaseTypes.destroy', $databaseType->id], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="fas fa-trash" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to delete this instance details?')"]) !!}
                            {!! Form::close() !!}
                        @endcan
                    </div>
                </td>
            @endcanany
            {{-- <td class="text-center">
                {!! Form::open(['route' => ['databaseTypes.destroy', $databaseType->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('databaseTypes.edit', [$databaseType->id]) !!}" class='btn btn-info btn-xs'><i class="far fa-edit" title="Edit"></i></a>
                </div>horizontal
                {!! Form::close() !!}
            </td> --}}
        </tr>
    @endforeach
    </tbody>
</table>