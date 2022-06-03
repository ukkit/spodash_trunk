{{-- <div class="table-responsive"> --}}
    <table class="table table-responsive table-condensed table-striped " id="intellicusVersions-table">
        <thead>
            <tr>
                <th>Version Number</th>
                <th>Patch Number</th>
                <th>Release Date</th>
                <th>Release Is Active</th>
                <th>Count</th>
                @canany('edit_databaseDetails','delete_databaseDetails')
                    <th class="text-center action_column"><i class="fas fa-tools" title="Actions"></i></th>
                @endcanany
            </tr>
        </thead>
        <tbody>
        @foreach($intellicusVersions as $intellicusVersion)
            <tr>
                <td>{{ $intellicusVersion->intellicus_version }}</td>
                <td>{{ $intellicusVersion->intellicus_patch }}</td>
                <td>
                    @if (is_null($intellicusVersion->release_date))
                    {{-- Don't display anything --}}
                    @else
                    {{ date('m/d/Y', strtotime($intellicusVersion->release_date)) }}
                    @endif

                </td>
                <td>
                    @if ($intellicusVersion->is_active == "N")
                        NO
                    @else
                        YES
                    @endif
                    {{-- {{ $intellicusVersion->is_active }} --}}
                </td>
                <td>
                    @php
                        $result = $intellicusVersion->get_intellicus_details_by_id($intellicusVersion->id);
                        $count = (count($result));
                        if ($count > 0 ) {
                            echo $count;
                        }
                    @endphp
                </td>
                @canany('edit_databaseDetails','delete_databaseDetails')
                <td class="text-center">
                    <div class="btn-group" role="group" aria-label="...">
                        @can('edit_databaseDetails')
                            {!! Form::open(['class'=>'inline','route' => ['intellicusVersions.edit', $intellicusVersion->id], 'method' => 'get']) !!}
                            {!! Form::button('<i class="fas fa-pencil-alt" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-xs']) !!}
                            {!! Form::close() !!}
                        @endcan
                        @can('delete_databaseDetails')
                            {!! Form::open(['class'=>'inline','route' => ['intellicusVersions.destroy', $intellicusVersion->id], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="fas fa-trash" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to DELETE this Intellicus details?')"]) !!}
                            {!! Form::close() !!}
                        @endcan
                    </div>
                </td>
                @endcanany
            </tr>
        @endforeach
        </tbody>
    </table>
{{-- </div> --}}
