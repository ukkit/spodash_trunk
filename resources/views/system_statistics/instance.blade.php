
<div class="table-responsive">
    <table class="table table-responsive table-condensed table-striped" id="instance-stats-table">
        <thead>
            <th>Active</th>
            <th>InActive</th>
            <th>Removed</th>
            <th>Total</th>
            <th>Avengers</th>
            <th>Dragons</th>
            <th>Justice League</th>
            <th>Seekers</th>
            <th>Guardians</th>
            <th>Transformers</th>
            <th>Incredibles</th>
            <th>Product Managers</th>
            <th>Date/Time</th>
            {{-- <th>Avengers</th> --}}
        </thead>
        <tbody>
            @foreach($systemStatistics as $systemStatistic)
            <tr>
                <td>{{ $systemStatistic->active_instance_details }}</td>
                <td>{!! (($systemStatistic->total_instance_details - $systemStatistic->deleted_instance_details) - $systemStatistic->active_instance_details) !!}</td>
                <td>{{ $systemStatistic->deleted_instance_details }}</td>
                <td>{{ $systemStatistic->total_instance_details }}</td>
                <td>{{ $systemStatistic->avengers_instances }}</td>
                <td>{{ $systemStatistic->dragons_instances }}</td>
                <td>{{ $systemStatistic->jl_instances }}</td>
                <td>{{ $systemStatistic->seekers_instances }}</td>
                <td>{{ $systemStatistic->guardians_instances }}</td>
                <td>{{ $systemStatistic->transformers_instances }}</td>
                <td>{{ $systemStatistic->pm_instances }}</td>
                <td>{{ $systemStatistic->incredibles_instances }}</td>
                <td>{{ $systemStatistic->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>