
<table class="table table-responsive table-condensed table-striped" id="dd-table">
    <thead>
        <tr>
            <td>Server Name</td>
            <td>Server IP</td>
            <td>DB Type</td>
            <td>DB Name/SID</td>
            <td>Username</td>
            <td>Password</td>
            <td>PORT</td>
        </tr>
    </thead>
    <tbody>
        @foreach ($databaseDetails as $databaseDetail)
        <tr>
            <td>{!! strtoupper($databaseDetail->server_details_by_id->server_name) !!}</td>
            <td>{!! $databaseDetail->server_details_by_id->server_ip !!}</td>
            <td>{!! $databaseDetail->database_types_by_id->db_short_name !!}</td>
            <td>{!! $databaseDetail->db_sid !!}</td>
            <td>{!! $databaseDetail->db_user !!}</td>
            <td>{!! $databaseDetail->db_pass !!}</td>
            <td>{!! $databaseDetail->db_port !!}</td>
        </tr>
        @endforeach
    </tbody>
</table>