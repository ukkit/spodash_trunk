<?php
    $CX=1;
?>
<table class="table table-responsive table-condensed table-striped" id="databaseDetails-table">
    <thead>
        <tr>
            @hasanyrole('advance|admin|superadmin')
            <th class="text-center id_column"><i class="fas fa-portrait" title="ID"></i></th> {{-- 1. ID --}}
            @else
            <th class="text-center id_column">#</th> {{-- 1. Count --}}
            @endhasanyrole
            <th class="text-left"><i class="fas fa-server" title="Server Name"></i></th> {{-- 2. Server Name --}}
            <th class="hidden"><i class="fas fa-network-wired" title="IP Address"></i></th> {{-- 3. IP Address --}}
            <th class="hidden">Repository</th> {{-- Repository (Hidden) --}}
            <th class="text-left"><i class="fas fa-database" title="Database"></i></th> {{-- 4. Database --}}
            <th class="text-center"><i class="fas fa-user-tie" title="Username"></i></th> {{-- 5. Username --}}
            <th class="text-center"><i class="fas fa-key" title="Password"></i></th> {{-- 6. Password --}}
            <th>SID/DB Name</th> {{-- 7. SID --}}
            <th class="text-center"><i class="fas fa-dice-d6" title="Tablespace Name"></i></th> {{-- 8. Tablespace Name --}}
            <th class="hidden">Port</th> {{-- 9. Port --}}
            <th class="text-right"><i class="fas fa-hdd" title="Database Size (MB)"></i></th> {{-- 10. Database Size --}}
            <th class="text-right"><i class="far fa-hdd" title="Temp Database Size (MB)"></i></th> {{-- 11. Temp DB Size --}}
            <th class="text-center"><i class="fas fa-calendar-plus" title="DB Creation Date"></i></th> {{-- 12. DB Creation Date --}}
            <th class="text-center"><i class="fas fa-calendar-check" title="Last Access"></i></th> {{-- 13. Last Access --}}
            <th class="text-center"><i class="fas fa-clipboard" title="Notes"></i></th> {{-- 14. Notes --}}
            <th>Data Updated</th> {{-- 15. Data Updated --}}
            @can('edit_databaseDetails','delete_databaseDetails')
                <th class="text-center icon_column"><i class="fas fa-pencil-alt" title="Actions"></i></th> {{-- 16. Actions --}}
            @endcan
            @can('edit_databaseDetails','delete_databaseDetails')
                <th class="text-center icon_column"><i class="fas as fa-trash" title="Actions"></i></th> {{-- 16. Actions --}}
            @endcan
        </tr>
    </thead>
    <tbody>

        @foreach ($databaseDetails as $databaseDetail)
            <?php
                // INITIALIZING ALL VARIABLES AS NULL TO BEGIN WITH
                $icons = Null;
                $db_last_accessed = Null;
                $db_size = Null;
                $db_temp_size = Null;
                $db_creation_date = Null;
                $db_data_updated = Null;
                $tblspc_name = null;
                $tblspc_used = null;
                $tblspc_free = null;
                $tblspc_total = null;
                $temp_tblspc_name = null;
                $temp_tblspc_used = null;
                $temp_tblspc_free = null;
                $temp_tblspc_total = null;

                if ($databaseDetail->is_dba == "Y") {
                    $icons .="<i class=\"fas fa-user-astronaut\" title=\"User is DBA\">";
                }

                if ($databaseDetail->repository_type == "PAI") {
                    $icons .="<i class=\"fab fa-product-hunt\" title=\"PAI Repository\">";
                } elseif ($databaseDetail->repository_type == "Intellicus") {
                    $icons .="<i class=\"fas fa-info-circle\" title=\"PAI Repository\">";
                }

                // if ($databaseDetail->data_gather_in_progress == "Y") {
                //     $icons .=" <i class=\"fas fa-spinner fa-pulse\" title=\"Database size data gather in progress\"></i>";
                // }

                if ($databaseDetail->is_intellicus_repository == "Y"){
                    $icon = "<i class=\"fas fa-info-circle\" title=\"Intellicus Repository\"></i>";
                } else {
                    $icon = null;
                }

                try {
                    $dbsize_data = $databaseDetail->db_size_by_id($databaseDetail->id);
                } catch (\Throwable $th) {
                    $dbsize_data = null;
                }

                if(!empty($dbsize_data)) {

                    $db_size = $dbsize_data->db_size;
                    $db_temp_size = $dbsize_data->db_temp_size;

                    $tblspc_name = $dbsize_data->tablespace_name;
                    $tblspc_used = $dbsize_data->tablespace_used;
                    $tblspc_free = $dbsize_data->tablespace_free;
                    $tblspc_total = $tblspc_used + $tblspc_free;

                    $temp_tblspc_name = $dbsize_data->temp_tablespace_name;
                    $temp_tblspc_used = $dbsize_data->temp_tablespace_used;
                    $temp_tblspc_free = $dbsize_data->temp_tablespace_free;
                    $temp_tblspc_total = $temp_tblspc_used + $temp_tblspc_free;

                    if (!empty($dbsize_data->db_access_datetime)) {
                        $db_last_accessed = date('Y-m-d', strtotime($dbsize_data->db_access_datetime));
                    }

                    if (!empty($dbsize_data->db_creation_date)) {
                        $db_creation_date = date('Y-m-d', strtotime($dbsize_data->db_creation_date));
                    }

                    $db_data_updated = $dbsize_data->created_at;
                }

                if (empty($db_size)) {
                    $db_size = $tblspc_total;
                }

                if (empty($db_temp_size)) {
                    $db_temp_size = $temp_tblspc_total;
                }

                try {
                    $server_name = $databaseDetail->server_details_by_id->server_name;
                    $server_ip = $databaseDetail->server_details_by_id->server_ip;
                } catch (\Throwable $th) {
                    $server_name = "";
                    $server_ip = "";
                }

            ?>
            @if($databaseDetail->db_is_active == "N")
                <tr class="danger">
            @else
                <tr>
            @endif

                @hasanyrole('advance|admin|superadmin')
                <td class="text-center">{!! $databaseDetail->id !!}</td> {{-- 1. ID --}}
                @else
                <td class="text-center">{!! $CX !!}</td> {{-- 1. Count --}}
                @endhasanyrole
                <td> {{-- 2. Server Name --}}
                    <a href="{!! route('serverDetails.show', [$databaseDetail->server_details_by_id]) !!}">
                    {!! strtoupper($server_name) !!}</a>&nbsp;{!! $icons !!}
                </td>
                <td class="hidden">{!! $server_ip !!}</td> {{-- 3. IP Address --}}
                <td class="hidden"> {{ $databaseDetail->repository_type }}</td> {{-- Repository (Hidden) --}}
                <td>{!! $databaseDetail->database_types_by_id->db_short_name !!}</td> {{-- 4. Database --}}
                <td>{!! $databaseDetail->db_user !!}</td> {{-- 5. USername --}}
                <td>{!! $databaseDetail->db_pass !!}</td> {{-- 6. Password --}}
                <td>{!! $databaseDetail->db_sid !!}</td> {{-- 7. SID --}}
                <td>{!! $tblspc_name !!}</td> {{-- 8. Tablespace Name --}}
                <td class="hidden">{!! $databaseDetail->db_port !!}</td> {{-- 9. Port --}}
                @if($db_size == 0)
                    <td></td>
                @else
                    <td class="text-right">{!! number_format($db_size) !!} M</td> {{-- 10. Database Size --}}
                @endif
                @if($db_temp_size == 0)
                    <td></td>
                @else
                    <td class="text-right">{!! number_format($db_temp_size) !!} M</td> {{-- 10. Database Size --}}
                @endif
                <td class="text-center">{!! $db_creation_date !!}</td> {{-- 12. DB Creation Date --}}
                <td class="text-center">{!! $db_last_accessed !!}</td> {{-- 13. Last Access --}}
                <td>{!! $databaseDetail->db_notes !!}</td> {{-- 14. Notes --}}

                @if($databaseDetail->data_gather_in_progress == "Y")
                    <td class="text-center"><i class="fas fa-spinner fa-pulse" title="Database size data udating"></i></td>
                @else
                    <td>{!! $db_data_updated !!}</td> {{-- 15. Data Updated --}}
                @endif

                <td class="text-center">{{-- 16. Actions --}}
                    @can('edit_databaseDetails')
                        {!! Form::open(['class'=>'inline','route' => ['databaseDetails.edit', $databaseDetail->id], 'method' => 'get']) !!}
                        {!! Form::button('<i class="fas fa-pencil-alt" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-edit btn-xs']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
                <td class="text-center">{{-- 16. Actions --}}
                        @can('delete_databaseDetails')
                        {!! Form::open(['class'=>'inline','route' => ['databaseDetails.destroy', $databaseDetail->id], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="fas fa-trash" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to DELETE this database details?')"]) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
            <?php $CX++; ?>
        @endforeach

    </tbody>
</table>