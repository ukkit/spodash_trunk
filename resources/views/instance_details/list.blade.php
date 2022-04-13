<table class="table table-responsive table-condensed table-striped" id="id-table">
    <thead>
        <tr>
            <th>Server Name</th>
            <th>Server IP</th>
            <th>Tomcat Port</th>
            <th>Autopilot Port</th>
            <th>Web Port</th>
        </tr>
    </thead>
    <tbody>
        @foreach($instanceDetails as $instanceDetail)
            @php
                $server_name = $instanceDetail->server_details_by_id->server_name;
                $server_ip = $instanceDetail->server_details_by_id->server_ip;
            @endphp
            <tr>
                <td>{{ strtoupper($server_name) }}</td>
                <td>{{ $server_ip }}</td>
                <td>{{ $instanceDetail->instance_tomcat_port }}</td>
                <td>{{ $instanceDetail->instance_ap_port }}</td>
                <td>{{ $instanceDetail->instance_web_port }}</td>
            </tr>
        @endforeach
    </tbody>
</table>