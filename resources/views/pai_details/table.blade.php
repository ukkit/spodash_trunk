{{-- <div class="table-responsive"> --}}
    {{-- <table class="table" id="paiDetails-table"> --}}
    <table class="table table-responsive table-condensed table-striped" id="paiDetails-table">

        <thead>
            <tr>
                <th class="text-center id_column">ID</th>
                <th>Server</th>
                <th>Ambari</th>
                <th>Type</th>
                <th>User</th>
                <th>Password</th>
                <th>Database</th>
                <th>Port No</th>
                <th>Tablespace Name</th>
                <th>Tabelsapce Used</th>
                @canany('edit_databaseDetails','delete_databaseDetails')
                <th class="text-center action_column"><i class="fas fa-tools" title="Actions"></i></th>
                @endcanany
            </tr>
        </thead>
        <tbody>
        @foreach($paiDetails as $paiDetail)
        @php
            $server_name = $paiDetail->serverDetails->server_name;
            if (!empty($paiDetail->ambari_details_id)) {
                $ambari_name = $paiDetail->ambariDetails->ambari_name;
            } else {
                $ambari_name = null;
            }

            try {
                $tablespace_name = $paiDetail->tablespace_details_by_id($paiDetail->id)->tablespace_name;
                $tablespace_used = $paiDetail->tablespace_details_by_id($paiDetail->id)->used_space;
                $tablespace_free = $paiDetail->tablespace_details_by_id($paiDetail->id)->free_space;
                $tablespace_total = $paiDetail->tablespace_details_by_id($paiDetail->id)->total_space;
                $percent_free = round((($tablespace_free/$tablespace_total)*100),2)."%";
                $percent_used = round((($tablespace_used/$tablespace_total)*100),2);
            } catch (\Throwable $th) {
                $tablespace_name = Null;
                $tablespace_used = Null;
                $percent_free = null;
                $percent_used = null;
            }
        @endphp
            <tr>
                <td class="text-center">{{ $paiDetail->id }}</td>
                <td><a href="{{ route('serverDetails.show', [$paiDetail->server_details_id]) }}"> {{ strtoupper($server_name) }} </a></td>
                <td>{{ $ambari_name }}</td>
                <td>{{ strtoupper($paiDetail->pai_type) }}</td>
                <td>{{ $paiDetail->pai_user }}</td>
                <td>{{ $paiDetail->pai_pwd }}</td>
                <td>{{ $paiDetail->pai_db }}</td>
                <td>{{ $paiDetail->pai_port }}</td>
                <td>{{ $tablespace_name }}</td>
                @if (is_null($tablespace_used))
                    <td></td>
                @else
                    <td>{{ number_format($tablespace_used) }} M/{{ $percent_used }}%</td>
                @endif

                <td class="text-center">
                    @canany('edit_databaseDetails','delete_databaseDetails')
                        <div class="btn-group" role="group" aria-label="...">
                            @can('edit_databaseDetails')
                                {!! Form::open(['class'=>'inline','route' => ['paiDetails.edit', $paiDetail->id], 'method' => 'get']) !!}
                                {!! Form::button('<i class="fas fa-pencil-alt" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-xs']) !!}
                                {!! Form::close() !!}
                            @endcan
                            @can('delete_databaseDetails')
                                {!! Form::open(['class'=>'inline','route' => ['paiDetails.destroy', $paiDetail->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="fas fa-trash" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to DELETE this PAI Entry?')"]) !!}
                                {!! Form::close() !!}
                            @endcan
                        </div>
                    @endcanany
                    {{-- {!! Form::open(['route' => ['paiDetails.destroy', $paiDetail->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('paiDetails.show', [$paiDetail->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('paiDetails.edit', [$paiDetail->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!} --}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
{{-- </div> --}}
