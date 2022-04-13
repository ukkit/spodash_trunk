<table class="table table-responsive table-condensed table-striped" id="id-table">
    <thead>
        <tr>
            <th>Server Name</th>
            <th>Server IP</th>
            <th>Intellicus Version</th>
            <th>Intellicus Port Port</th>
        </tr>
    </thead>
    <tbody>
        @foreach($intellicusDetails as $intellicusDetail)
            @php
                $server_name = $intellicusDetail->serverDetails->server_name;
                $server_ip = $intellicusDetail->serverDetails->server_ip;
                // $server_ip = $instanceDetail->server_details_by_id->server_ip;
                $int_ver_return = $intellicusDetail->getIntellicusVersionbyID($intellicusDetail->intellicus_versions_id);
            if(count($int_ver_return)) {
                $int_version = $int_ver_return[0]->intellicus_version;
                // $int_version .=  " ".$int_ver_return[0]->intellicus_patch;
            }
            @endphp
            <tr>
                <td>{{ strtoupper($server_name) }}</td>
                <td>{{ $server_ip }}</td>
                <td>{{ $int_version }}</td>
                <td>{{ $intellicusDetail->intellicus_port }}</td>
                {{-- <td>{{ $instanceDetail->instance_web_port }}</td> --}}
            </tr>
        @endforeach
    </tbody>
</table>