{{-- <div class="table-responsive"> --}}
    {{-- <table class="table" id="ambariDetails-table"> --}}
        <table class="table table-responsive table-condensed table-striped" id="ambariDetails-table">
        <thead>
            <tr>
                <th class="text-center id_column">ID</th>
                <th>Name</th>
                <th>Ambari URL</th>
                <th>User Name</th>
                <th>Password</th>
                @canany('edit_databaseDetails','delete_databaseDetails')
                    <th class="text-center action_column"><i class="fas fa-tools" title="Actions"></i></th>
                @endcanany
            </tr>
        </thead>
        <tbody>
        @foreach($ambariDetails as $ambariDetail)
            <tr>
                <td class="text-center">{{ $ambariDetail->id }}</td>
                <td>{{ $ambariDetail->ambari_name }}</td>
                <td>{{ $ambariDetail->ambari_url }}</td>
                <td>{{ $ambariDetail->ambari_user }}</td>
                <td>{{ $ambariDetail->ambari_pwd }}</td>
                @canany('edit_databaseDetails','delete_databaseDetails')
                <td class="text-center">
                    <div class="btn-group" role="group" aria-label="...">
                        @can('edit_databaseDetails')
                            {!! Form::open(['class'=>'inline','route' => ['ambariDetails.edit', $ambariDetail->id], 'method' => 'get']) !!}
                            {!! Form::button('<i class="fas fa-pencil-alt" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-xs']) !!}
                            {!! Form::close() !!}
                        @endcan
                        @can('delete_databaseDetails')
                            {!! Form::open(['class'=>'inline','route' => ['ambariDetails.destroy', $ambariDetail->id], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="fas fa-trash" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to DELETE this Ambari Entry?')"]) !!}
                            {!! Form::close() !!}
                        @endcan
                    </div>
                </td>
                @endcanany
                    {{-- {!! Form::open(['route' => ['ambariDetails.destroy', $ambariDetail->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('ambariDetails.show', [$ambariDetail->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('ambariDetails.edit', [$ambariDetail->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!} --}}
                {{-- </td> --}}
            </tr>
        @endforeach
        </tbody>
    </table>
{{-- </div> --}}
