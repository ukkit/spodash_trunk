<?php
    $CX=1;
?>
<table class="table table-responsive table-condensed table-striped" id="serverDetails-table">
{{-- <table id="serverDetails-table" class="table table-responsive table-condensed table-striped" > --}}
    <thead>
        <tr>

            @hasanyrole('advance|admin|superadmin')
                <th class="text-center id_column"><i class="fas fa-portrait" title="ID"></i></th>
                @if (env('SHOW_GENERATED_SERVER_DETAILS_ID') == True)
                    <th class="text-center"><i class="fas fa-id-card" title="Generated ID"></i></th>
                @endif
                <th class="text-left name_column"><i class="fas fa-server" title="Server Name"></i></th>
            @else
                <th class="text-center id_column">#</th>
                <th class="name_column">Name</th>
            @endhasanyrole
            <th class="text-center ip_column"><i class="fas fa-network-wired" title="IP Address"></i></th>
            <th class="text-center column_5pct">Type</th>
            @hasanyrole('advance|admin|superadmin')
                <th class="text-center icon_column"><i class="fas fa-list-ol" title="Number of Instances/Databases"></i></th>
            @endhasanyrole
            @hasanyrole('advance|admin|superadmin')
                <th class="text-left"><i class="fas fa-database" title="Database"></i></th>
                <th class="text-left"><i class="fab fa-windows" title="Operating System"></i></th>
                <th class="text-right icon_column"><i class="fas fa-memory" title="RAM (GB)"></i></th>
                <th class="text-right column_3pct"><i class="fas fa-hdd" title="Disk Space (GB)"></i></th>
                <th class="text-right icon_column"><i class="fas fa-microchip" title="CPU Cores"></i></th>
                <th class="text-center column_5pct"><i class="fas fa-sign" title="Purpose"></i></th>
                <th class="hidden">Purpose</th>
            @else
                <th>Database</th>
                <th>OS</th>
                <th class="text-center column_5pct">RAM (GB)</th>
                <th class="text-center column_5pct">HDD (GB)</th>
                <th class="text-center column_5pct">Cores</th>
                <th class="text-center">Purpose</th>
            @endhasanyrole
            <th class="hidden">Note</th>
            @hasanyrole('advance|admin|superadmin')
                <th class="text-center"><i class="fas fa-user-tie" title="User & Password"></i></th>
                <th class="text-center"><i class="fas fa-users" title="Owners"></i></th>
                <th class="text-center width_15px""><i class="fas fa-user-md" title="DBA Details Record exists"></i></th>
                <th class="text-center width_15px"><i class="fas fa-heartbeat" title="Server is Active"></i></th>
                <th class="text-center width_15px"><i class="fas fa-tachometer-alt" title="Show on Dashboard"></i></th>
                @can('edit_serverDetails')
                    <th class="text-center icon_column"><i class="fas fa-pencil-alt" title="Edit"></i></th>
                @endcan
                @can('delete_serverDetails')
                    <th class="text-center icon_column"><i class="fas fa-tools" title="Actions"></i></th>
                @endcan
            @endhasanyrole

        </tr>
    </thead>
    <tbody>
    @foreach($serverDetails as $serverDetail)

        @if($serverDetail->server_is_active !== "Y" && (Auth::guest()))
            <!-- Don't print anything in case server is not active and user is not logged-in -->
        @else

        <?php
        // Getting number of instances and databased hosted on the server
        $hosted_db_count = count($serverDetail->database_details_by_id($serverDetail->id));
        $instance_count = count($serverDetail->instance_details_by_server_id($serverDetail->id));
        $ml_count = count($serverDetail->ml_details_by_server_id($serverDetail->id));

        // BEGIN-CODE for $showIcons
        $showIcons = "<span class=\"pull-right\">";
        // if ($serverDetail->server_use_by_id->use_short_name == "DB") {
        if ($serverDetail->count_database_details_by_server_id($serverDetail->id) > 0)
        {
            $showIcons .= " <i class=\"fas fa-database\" title=\" ".$serverDetail->database_types_by_id->db_long_name."\"></i>";
        }

        // Show webserver icon only when there are active instances for the server
        if ($serverDetail->count_instance_details_by_server_id($serverDetail->id) > 0) {
            $showIcons .= " <i class=\"far fa-file-alt\" title=\"Webserver\"></i>";
        }

        if($serverDetail->server_note != "") {
            $showIcons .= " <i class=\"far fa-sticky-note\" title=\"$serverDetail->server_note\"></i>";
        }

        $osFamily = $serverDetail->os_types_by_id->os_family;
        $osLongName = $serverDetail->os_types_by_id->os_long_name;
        switch($osFamily) {
            case "microsoft":
                $showIcons .= " <i class=\"fab fa-windows\" title=\"$osLongName\"></i>";
                break;
            case "red-hat":
                $showIcons .= " <i class=\"fab fa-redhat\" title=\"$osLongName\"></i>";
                break;
            case "centos":
                $showIcons .= " <i class=\"fab fa-centos\" title=\"$osLongName\"></i>";
                break;
            case "suse":
                $showIcons .= " <i class=\"fab fa-suse\" title=\"$osLongName\"></i>";
                break;
        }
        $showIcons .= "</span>";
        // END-CODE for $showIcons

        if ($serverDetail->server_use_by_id->use_short_name == "DB")
        {
            $dbacount = $serverDetail->get_dba_counts($serverDetail->id);
            if ($dbacount > 0) {
                $has_dba = "<i class=\"far fa-check-circle\" title=\"YES\"></i>";
            } else {
                $has_dba = "<i class=\"far fa-times-circle\" title=\"NO\"></i>";
            }
        } else {
            $has_dba = "";
        }


        ?>
        <tr>
            @hasanyrole('advance|admin|superadmin')
                <td class="text-center">{!! $serverDetail->id !!}</td>
                @if (env('SHOW_GENERATED_SERVER_DETAILS_ID') == True)
                    <td class="text-center">{!! $serverDetail->gen_sd_id !!}</td>
                @endif
                <td>
                    <a href="{!! route('serverDetails.show', [$serverDetail->id]) !!}">
                    {!! strtoupper($serverDetail->server_name) !!}</a>
                </td>
            @else
                <td class="text-center">{!! $CX !!}</td>
                <td>
                    <a href="{!! route('serverDetails.show', [$serverDetail->id]) !!}">
                    {!! strtoupper($serverDetail->server_name) !!}</a> {!! $showIcons !!}
                </td>
            @endhasanyrole

            <td class="text-right">{!! $serverDetail->server_ip !!}</td>
            <td class="text-center">{!! $serverDetail->server_class !!}</td>
            @hasanyrole('advance|admin|superadmin')
                <td class="text-center">
                    @if($serverDetail->server_use_by_id->use_short_name == "DB")
                        {!! $hosted_db_count !!}
                    @else
                        {!! $instance_count + $ml_count !!}
                    @endif
                </td>
            @endhasanyrole

            @if ($serverDetail->database_types_by_id->db_long_name == "NULL")
            <td> </td>
            @else
                <td>{!! $serverDetail->database_types_by_id->db_long_name !!}</td>
            @endif
            <td>{!! $serverDetail->os_types_by_id->os_long_name !!}</td>
            <td class="text-center">{!! $serverDetail->server_ram_gb !!}</td>
            <td class="text-center">{!! $serverDetail->server_hdd_gb !!}</td>
            <td class="text-center">{!! $serverDetail->server_cpu_cores !!}</td>

            @hasanyrole('advance|admin|superadmin')
                <td class="text-center">{!! $serverDetail->server_use_by_id->use_short_name !!}</td>
                <td class="hidden">{!! $serverDetail->server_use_by_id->use_long_name !!}</td>
            @else
                <td class="text-center">{!! $serverDetail->server_use_by_id->use_long_name !!}</td>
            @endhasanyrole
            <td class="hidden">{!! $serverDetail->server_note !!}</td>
            @hasanyrole('advance|admin|superadmin')
                <td class="text-center">{!! $serverDetail->server_user !!}/{!! $serverDetail->server_password !!} </td>
                <td>{!! $serverDetail->server_owner !!}</td>
                <td class="text-center">{!! $has_dba !!}</td>
                @if($serverDetail->server_is_active == "Y")
                    <td class="text-center">
                    <i class="far fa-check-circle" title="YES"></i>
                @else
                    <td class="danger text-center">
                    <i class="far fa-times-circle" title="NO"></i>
                @endif
                    </td>
                @if($serverDetail->server_show_on_site == "Y")
                    <td class="text-center">
                    <i class="far fa-check-circle" title="YES"></i>
                @else
                    <td class="danger text-center">
                    <i class="far fa-times-circle" title="NO"></i>
                @endif
                    </td>

                <td>
                    @can('edit_serverDetails')
                        {!! Form::open(['class'=>'inline','route' => ['serverDetails.edit', $serverDetail->id], 'method' => 'get']) !!}
                        {!! Form::button('<i class="fas fa-pencil-alt" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-group-xs btn-edit btn-xs']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
                <td>
                    @can('delete_serverDetails')
                        {!! Form::open(['class'=>'inline','route' => ['serverDetails.destroy', $serverDetail->id], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="fas fa-trash" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-group-xs btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to delete this server details? This will also delete Database & Instance details for this Server!')"]) !!}
                        {{-- {!! Form::button('<i class="fas fa-trash" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-group-xs btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to delete this server details? This will also delete Database & Instance details for this Server!')"]) !!} --}}
                        {!! Form::close() !!}
                    @endcan
                </td>

            @endhasanyrole
        </tr>
        <?php $CX++; ?>
        @endif
    @endforeach
    </tbody>
</table>