
<div class="table-responsive">
    <table class="table table-responsive table-condensed table-striped" id="dbaDetails-table">
        <thead>
            <tr>
                <th class="id_column"><i class="fas fa-portrait" title="ID"></i></th>
                <th><i class="fas fa-server" title="Server Name"></i></th>
                <th><i class="fas fa-user-tie" title="DBA Username"></i></th>
                <th><i class="fas fa-key" title="DBA Password"></i></th>
                <th>SID</th>
                @canany('edit_databaseDetails','delete_databaseDetails')
                <th class="text-center"><i class="fas fa-tools" title="Actions"></i></th> {{-- 16. Actions --}}
            @endcanany
            </tr>
        </thead>
        <tbody>
        @foreach($dbaDetails as $dbaDetail)
            <?php
            try {
                $server_name = strtoupper($dbaDetail->server_details_by_id->server_name);
                $server_ip = $dbaDetail->server_details_by_id->server_ip;
            } catch (\Throwable $th) {
                Log::debug("Unable to get server name/ip for server_details_id ".$dbaDetail->server_details_id);
                $server_name = Null;
                $server_ip = Null;
            }
            ?>
            <tr>
                <td>{{ $dbaDetail->id }}</td>
                {{-- <td>{{ $dbaDetail->server_details_id }}</td> --}}
                <td> {{-- Server Name --}}
                    <a href="{!! route('serverDetails.show', [$dbaDetail->server_details_by_id]) !!}">
                    {!! $server_name !!}</a>
                     {{-- {!! $server_ip !!} --}}
                </td>
                <td>{{ $dbaDetail->dba_user }}</td>
                <td>{{ $dbaDetail->dba_password }}</td>
                <td>{{ $dbaDetail->db_sid }}</td>

                @canany('edit_serverDetails','delete_serverDetails')
                    <td class="text-center">
                        <div class="btn-group" role="group" aria-label="...">
                            @can('edit_serverDetails')
                                {!! Form::open(['class'=>'inline','route' => ['dbaDetails.edit', $dbaDetail->id], 'method' => 'get']) !!}
                                {!! Form::button('<i class="fas fa-pencil-alt" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-group-xs btn-info btn-xs']) !!}
                                {!! Form::close() !!}
                            @endcan
                            @can('delete_serverDetails')
                                {!! Form::open(['class'=>'inline','route' => ['dbaDetails.destroy', $dbaDetail->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="fas fa-trash" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-group-xs btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to delete this DBA Details!')"]) !!}
                                {!! Form::close() !!}
                            @endcan
                        </div>
                    </td>
                @endcanany
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
