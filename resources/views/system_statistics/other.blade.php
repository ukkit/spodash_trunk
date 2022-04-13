<div class="table-responsive">
    <table class="table table-responsive table-condensed table-striped" id="other-stats-table">
        <thead>
            <tr>
                <th>Total Action History</th>
                <th>Removed Action History</th>
                <th>Intellicus</th>
                <th>PAI Details</th>
                <th>Builds</th>
                <th>Release Builds</th>
                <th>Total Users</th>
                <th>Team Count</th>
                <th>Date/Time</th>
            </tr>
        </thead>
        <tbody>
        @foreach($systemStatistics as $systemStatistic)
            <tr>
                <td>{{ $systemStatistic->total_action_histories }}</td>
                <td>{{ $systemStatistic->deleted_action_histories }}</td>
                <td>{{ $systemStatistic->total_intellicus_versions }}</td>
                <td>{{ $systemStatistic->total_pai_details }}</td>
                <td>{{ $systemStatistic->total_product_versions }}</td>
                <td>{{ $systemStatistic->total_release_builds }}</td>
                <td>{{ $systemStatistic->total_users }}</td>
                <td>{{ $systemStatistic->total_teams }}</td>
                <td>{{ $systemStatistic->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
