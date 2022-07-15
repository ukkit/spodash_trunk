<?php $CX=0; ?>
    <table class="table table-responsive table-condensed table-striped" id="mlDetails-table">
        <thead>
            <tr>
            @hasanyrole('advance|admin|superadmin')
                <th class="text-center id_column">ID</th>
            @else
                <th class="text-center id_column">#</th>
            @endhasanyrole
            <th  class="name_column">Name</th>
            <th  class="name_column">Server Name</th>
            <th>ML Build</th>
            <th class="text-left column_3pct">Port</th>
            <th  class="column_8pct">Login/PWD</th>
            {{-- <th>Password</th> --}}
            <th class="column_8pct">Intellicus</th>
            <th>Installed Path</th>
            <th>Notes</th>
            @can('edit_databaseDetails')
                <th class="text-center icon_column"><i class="fas fa-pencil-alt" title="Actions"></i></th> {{-- 16. Actions --}}
            @endcan
            @can('delete_databaseDetails')
                <th class="text-center icon_column"><i class="fas as fa-trash" title="Actions"></i></th> {{-- 16. Actions --}}
            @endcan
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

            try {
                $ml_build = $mlDetail->mlBuilds->ml_version . " " . $mlDetail->mlBuilds->ml_build;
                if ($mlDetail->mlBuilds->is_release_build == "Y") {
                    $ml_build .= " <i class=\"fas fa-crown fa-xs\" title=\"Release Build\"></i>";
                }
            } catch (\Throwable $th) {
                $ml_build = Null;
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
                <td> {!! $ml_build !!} </td>
                <td>{{ $mlDetail->zeppelin_port }}</td>
                <td>{{ $mlDetail->zeppelin_user }}/{{ $mlDetail->zeppelin_pwd }}</td>
                {{-- <td></td> --}}

                <td>{{ $intellicus_name }}</td>
                <td>{{ $mlDetail->installed_path }}</td>
                <td>{{ $mlDetail->notes }}</td>

                @can('edit_databaseDetails')
                <td class="text-center">
                    {!! Form::open(['class'=>'inline','route' => ['mlDetails.edit', $mlDetail->id], 'method' => 'get']) !!}
                    {!! Form::button('<i class="fas fa-pencil-alt" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-edit btn-xs']) !!}
                    {!! Form::close() !!}
                </td>
                @endcan
                @can('delete_databaseDetails')
                <td class="text-center">
                    {!! Form::open(['class'=>'inline','route' => ['mlDetails.destroy', $mlDetail->id], 'method' => 'delete']) !!}
                    {!! Form::button('<i class="fas fa-trash" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to DELETE this Machine Learning details?')"]) !!}
                    {!! Form::close() !!}
                </td>
                @endcan

            </tr>
        @endforeach
        </tbody>
    </table>
