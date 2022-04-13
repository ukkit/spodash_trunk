<?php $CX=0; ?>
    <table class="table table-responsive table-condensed table-striped" id="mlDetails-table">
        <thead>
            <tr>
            @hasanyrole('advance|admin|superadmin')
                <th class="text-center id_column">ID</th>
            @else
                <th class="text-center id_column">#</th>
            @endhasanyrole
                <th>Name</th>
                <th>Server</th>
                <th>User</th>
                <th>Password</th>
                <th>Port</th>
                <th>Intellicus</th>
                <th>Installed Path</th>
                <th>Notes</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($mlDetails as $mlDetail)
        @php
            try {
                $server_name = $mlDetail->serverDetails->server_name;
                $server_ip = $mlDetail->serverDetails->server_ip;
            } catch (\Throwable $th) {
                $server_name = Null;
                $server_ip = Null;
            }

            try {
                $intellicus_name = $mlDetail->intellicusDetails->intellicus_name;
            } catch (\Throwable $th) {
                $intellicus_name = Null;
            }

            $URL = "http://".$server_ip.":".$mlDetail->zeppelin_port."/";
            $server_url = route('serverDetails.show', [$mlDetail->server_details_id]);
            $CX++;
        @endphp

            <tr>
                @hasanyrole('advance|admin|superadmin')
                    <td class="text-center">{!! $mlDetail->id !!}</td>
                @else
                    <td class="text-center">{!! $CX !!}</td>
                @endhasanyrole
                <td><a href="{{ $URL }}" target="_blank"> <strong>{{ strtoupper($mlDetail->ml_name) }} </strong></a></td>
                <td><a href="{{ $server_url }}" target="_blank"> {{strtoupper($server_name) }} </a></td>
                <td>{{ $mlDetail->zeppelin_user }}</td>
                <td>{{ $mlDetail->zeppelin_pwd }}</td>
                <td>{{ $mlDetail->zeppelin_port }}</td>
                <td>{{ $intellicus_name }}</td>
                <td>{{ $mlDetail->installed_path }}</td>
                <td>{{ $mlDetail->notes }}</td>

                <td class="text-center">
                @canany('edit_databaseDetails','delete_databaseDetails')

                    <div class="btn-group" role="group" aria-label="...">
                        @can('edit_databaseDetails')
                            {!! Form::open(['class'=>'inline','route' => ['mlDetails.edit', $mlDetail->id], 'method' => 'get']) !!}
                            {!! Form::button('<i class="fas fa-pencil-alt" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-xs']) !!}
                            {!! Form::close() !!}
                        @endcan
                        @can('delete_databaseDetails')
                            {!! Form::open(['class'=>'inline','route' => ['mlDetails.destroy', $mlDetail->id], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="fas fa-trash" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to DELETE this Machine Learning details?')"]) !!}
                            {!! Form::close() !!}
                        @endcan
                    </div>
                @endcanany
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
