

    <table class="table table-responsive table-condensed table-striped" id="intellicusDetails-table">
        <thead>
            <tr>
                {{-- <th>Server Details Id</th> --}}
                @hasanyrole('advance|admin|superadmin')
                    <th class="text-center id_column">ID</th>
                @else
                    <th class="text-center id_column">#</th>
                @endhasanyrole
                <th class="name_column">Name</th>
                <th class="name_column">Server Name</th>
                <th class="hidden">IP Address</th>
                <th class="column_6pct">Version</th>
                <th>Repository</th>
                <th class="text-center column_5pct">Memory</th>
                <th class="text-center column_5pct">Port</th>
                <th class="text-center column_5pct">URL</th>
                {{-- <th class="column_5pct">Login</th> --}}
                <th class="column_5pct">Password</th>
                <th>Intellicus Install Path</th>
                <th class="hidden">Hidden Figures</th>
                <th class="text-center id_column">CFT</th>
                @canany('edit_databaseDetails','delete_databaseDetails')
                    <th class="text-center action_column"><i class="fas fa-tools" title="Actions"></i></th>
                @endcanany
            </tr>
        </thead>
        <tbody>
        @foreach($intellicusDetails as $intellicusDetail)
        @php
            $server_name = $intellicusDetail->serverDetails->server_name;
            $server_ip = $intellicusDetail->serverDetails->server_ip;
            $int_version = null;
            $hidden_figures = " ";
            $icon_list = "";

            if($intellicusDetail->jdk_type == "Amazon Corretto") {
                $icon_list .= "<i class=\"fab fa-amazon\" title=\"Amazon Corretto JDK ". $intellicusDetail->jdk_version ." \"></i> ";
                $hidden_figures .= "Amazon Corretto ";
            } elseif($intellicusDetail->jdk_type == "Oracle JDK") {
                $icon_list .= " <i class=\"fab fa-java\" title=\"Oracle JDK ". $intellicusDetail->jdk_version ."\"></i> ";
                $hidden_figures .= "Oracle JDK ";
            } elseif($intellicusDetail->jdk_type == "OpenJDK") {
                $icon_list .= " <i class=\"fas fa-star-half-alt\" title=\"Open JDK ". $intellicusDetail->jdk_version ."\"></i> ";
                $hidden_figures .= "Open JDK ";
            }
            if($intellicusDetail->is_https == "Y") {
                $hidden_figures .= "HTTPS ";
            } else {
                $hidden_figures .= "HTTP ";
            }

            try {
                $repository = $intellicusDetail->database_details_by_id->db_user."@".$intellicusDetail->database_details_by_id->db_sid;

            } catch (\Throwable $th) {
                $repository = null;
            }

            if ($intellicusDetail->instance_is_active == "N") {
                $app_btn_type = "btn-disabled";
                $intell_btn_type = "btn-disabled";
            } else {
                $app_btn_type = "btn-info";
                $intell_btn_type = "btn-default";
            }

            $int_ver_return = $intellicusDetail->getIntellicusVersionbyID($intellicusDetail->intellicus_versions_id);
            if(count($int_ver_return)) {
                $int_version = $int_ver_return[0]->intellicus_version;
                $int_version .=  " ".$int_ver_return[0]->intellicus_patch;
            }

            if($intellicusDetail->is_https == "Y") {
                $http_tag = "https";
                $link_icon = "<i class=\"fas fa-lock fs-sm\" ></i> ".$int_version;
                // $link_icon = "<button type=\"button\" class=\"btn $app_btn_type btn-xs xsmall\" title=\"$intellicusDetail->intellicus_name\"><i class=\"fas fa-lock fs-sm\" ></i> ".$int_version."</button>";
            } else {
                $http_tag = "http";
                $link_icon = "<i class=\"fas fa-lock-open fs-sm\" ></i> ".$int_version;

                // $link_icon = "<button type=\"button\" class=\"btn $app_btn_type btn-xs xsmall\" title=\"$intellicusDetail->intellicus_name\"><i class=\"fas fa-lock-open fa-sm\" ></i> ".$int_version   ."</button>";
            }
            $inturl = $http_tag."://" .$server_ip.":".$intellicusDetail->intellicus_port."/Intellicus";
            $intellicus = "<a href=\"".$inturl."\" target=\"_blank\"> $link_icon </a>";

            $CX = 1;
        @endphp
            @if($intellicusDetail->is_active == "Y")
            <tr>
            @else
            <tr class="disabled">
            @endif
                @hasanyrole('advance|admin|superadmin')
                    <td class="text-center">{!! $intellicusDetail->id !!}</td>
                @else
                    <td class="text-center">{!! $CX !!}</td>
                    @php
                    $CX++;
                    @endphp
                @endhasanyrole
                <td>
                    <span>
                    {{ $intellicusDetail->intellicus_name }}
                    </span>
                    {!! $icon_list !!}
                </td>
                {{-- <td>{{ strtoupper($server_name) }}</td> --}}
                <td><a href="{{ route('serverDetails.show', [$intellicusDetail->server_details_id]) }}"> {{ strtoupper($server_name) }} </a></td>
                <td class="hidden">{{ $server_ip }}</td>
                <td>{!! $intellicus !!}</td>
                <td>{{ $repository }}</td>
                <td class="text-center">{{ $intellicusDetail->intellicus_memory }} GB</td>
                <td class="text-center">{{ $intellicusDetail->intellicus_port }}</td>
                {{-- <td class="text-center"> {!! $intellicus !!}</td> --}}

                <td>{{ $intellicusDetail->intellicus_login }}</td>
                <td>{{ $intellicusDetail->intellicus_pwd }}</td>
                <td>{{ $intellicusDetail->intellicus_install_path }}</td>
                <td class="hidden">{{ $hidden_figures }}</td>
                <td class="text-center">{{ $intellicusDetail->check_fail_count }}</td>

                @canany('edit_databaseDetails','delete_databaseDetails')
                    <td class="text-center">
                        <div class="btn-group" role="group" aria-label="...">
                            @can('edit_databaseDetails')
                                {!! Form::open(['class'=>'inline','route' => ['intellicusDetails.edit', $intellicusDetail->id], 'method' => 'get']) !!}
                                {!! Form::button('<i class="fas fa-pencil-alt" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-xs']) !!}
                                {!! Form::close() !!}
                            @endcan
                            @can('delete_databaseDetails')
                                {!! Form::open(['class'=>'inline','route' => ['intellicusDetails.destroy', $intellicusDetail->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="fas fa-trash" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to DELETE this Intellicus details?')"]) !!}
                                {!! Form::close() !!}
                            @endcan
                        </div>
                    </td>
                @endcanany
            </tr>
        @endforeach
        </tbody>
    </table>

