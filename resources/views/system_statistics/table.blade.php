<div class="table-responsive">
    <table class="table" id="systemStatistics-table">
        <thead>
            <tr>
                <th class="upright_text">Total Instances</th>
                <th class="upright_text">Active Instances</th>
                <th class="upright_text">Removed Instances</th>
                <th class="upright_text">AutoUpgrade Enabled</th>

                <th class="upright_text">Total Servers</th>
                <th class="upright_text">Active Servers</th>
                <th class="upright_text">Removed Servers</th>

                <th class="upright_text">Total DB Details</th>
                <th class="upright_text">Active DB Details</th>
                <th class="upright_text">Removed DB Details</th>

                <th class="upright_text">Total Intellicus</th>

                <th class="upright_text">Total PAI Details</th>
                <th class="upright_text">Removed PAI Details</th>

                <th class="upright_text">Total Builds</th>
                <th class="upright_text">Removed Builds</th>
                <th class="upright_text">Release Builds</th>

                <th class="upright_text">Total Teams</th>

                <th class="upright_text">Total Action History</th>
                <th class="upright_text">Removed Action History</th>

                <th class="upright_text">Total Intellicus</th>

                <th class="upright_text">Avengers</th>
                <th class="upright_text">Dragons</th>
                <th class="upright_text">Justice League</th>
                <th class="upright_text">Seekers</th>
                <th class="upright_text">Guardians</th>
                <th class="upright_text">Transformers</th>
                <th class="upright_text">Product Managers</th>
                <th class="upright_text">Incredibles</th>
                <th class="upright_text">Total Users</th>
                <th>Date Time</th>
                {{-- <th colspan="3">Action</th> --}}
            </tr>
        </thead>
        <tbody>
        @foreach($systemStatistics as $systemStatistic)
            <tr>
                <td>{{ $systemStatistic->total_instance_details }}</td>
            <td>{{ $systemStatistic->active_instance_details }}</td>
            <td>{{ $systemStatistic->deleted_instance_details }}</td>
            <td>{{ $systemStatistic->auto_upgrade_enabled_instances }}</td>
            <td>{{ $systemStatistic->total_server_details }}</td>
            <td>{{ $systemStatistic->active_server_details }}</td>
            <td>{{ $systemStatistic->deleted_server_details }}</td>
            <td>{{ $systemStatistic->total_database_details }}</td>
            <td>{{ $systemStatistic->active_database_details }}</td>
            <td>{{ $systemStatistic->deleted_database_details }}</td>

            <td>{{ $systemStatistic->total_intellicus_details }}</td>
            {{-- <td>{{ $systemStatistic->deleted_intellicus_details }}</td> --}}
            <td>{{ $systemStatistic->total_pai_details }}</td>
            <td>{{ $systemStatistic->deleted_pai_details }}</td>
            <td>{{ $systemStatistic->total_product_versions }}</td>
            <td>{{ $systemStatistic->deleted_product_versions }}</td>
            <td>{{ $systemStatistic->total_release_builds }}</td>

            <td>{{ $systemStatistic->total_teams }}</td>
            {{-- <td>{{ $systemStatistic->deleted_teams }}</td> --}}
            <td>{{ $systemStatistic->total_action_histories }}</td>
            <td>{{ $systemStatistic->deleted_action_histories }}</td>
            <td>{{ $systemStatistic->total_intellicus_versions }}</td>
            {{-- <td>{{ $systemStatistic->deleted_intellicus_versions }}</td> --}}

            <td>{{ $systemStatistic->avengers_instances }}</td>
            <td>{{ $systemStatistic->dragons_instances }}</td>
            <td>{{ $systemStatistic->jl_instances }}</td>
            <td>{{ $systemStatistic->seekers_instances }}</td>
            <td>{{ $systemStatistic->guardians_instances }}</td>
            <td>{{ $systemStatistic->transformers_instances }}</td>
            <td>{{ $systemStatistic->pm_instances }}</td>
            <td>{{ $systemStatistic->incredibles_instances }}</td>

            <td>{{ $systemStatistic->total_users }}</td>
            <td>{{ $systemStatistic->created_at }}</td>
            {{-- <td>
                {!! Form::open(['route' => ['systemStatistics.destroy', $systemStatistic->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{{ route('systemStatistics.show', [$systemStatistic->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{{ route('systemStatistics.edit', [$systemStatistic->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td> --}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
