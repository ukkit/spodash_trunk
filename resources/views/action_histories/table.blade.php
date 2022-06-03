{{-- <div class="table-responsive"> --}}
    <table class="table table-responsive table-condensed table-striped" id="actionHistories-table">
        <thead>
            <tr>
                <th class="text-center id_column">#</th>
                <th>User</th>
                <th class="text-center">Instance</th>
                <th class="text-center">Build</th>
                <th class="text-center">Jenkins Build #</th>
                <th>Action</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
                @can('edit_actionHistories')
                <th class="text-center icon_column"><i class="fas fa-tools" title="Actions"></i></th>
                @endcan
            </tr>
        </thead>
        <tbody>
        @foreach($actionHistories as $actionHistory)

            @php
                $hasEndTime = True;
                $pai_release_number = Null;
                $pai_build_number = Null;
                $spo_release_number = Null;
                $spo_build_number = Null;

                try {
                    $build_data = $actionHistory->return_product_versions_by_pvid($actionHistory->instance_details->pv_id);
                    $spo_release_number = $build_data->product_ver_number;
                    $spo_build_number = $build_data->product_build_numer;
                } catch (\Throwable $th) {
                    Log::error('Missing value for pv_id for Action History ID '.$actionHistory->id);
                    Log::error($th);
                }


                if(!empty($actionHistory->old_pai_build_id)) {
                    try {
                        $build_data = $actionHistory->return_pai_versions_by_pvid($actionHistory->instance_details->pai_pv_id);
                        $pai_release_number = $build_data->pai_version;
                        $pai_build_number = $build_data->pai_build;
                    } catch (\Throwable $th) {
                        Log::error('Missing value for pv_id for Action History ID '.$actionHistory->id);
                        Log::error($th);
                    }
                }

                if(empty($actionHistory->old_build_id) && empty($actionHistory->old_pai_build_id)) { // Both spo and pai old build is empty
                    $build = $spo_release_number." ".$spo_build_number;
                } elseif(!empty($actionHistory->old_build_id) && empty($actionHistory->old_pai_build_id)) { // spo old build id present but no pai build id
                    $old_release_data = $actionHistory->return_product_versions_by_id($actionHistory->old_build_id);
                    $new_release_data = $actionHistory->return_product_versions_by_id($actionHistory->new_build_id);
                    $build = $old_release_data->product_ver_number." ".$old_release_data->product_build_numer;
                    $build .= " <i class=\"fas fa-long-arrow-alt-right\" title=\"upgraded to\"></i> ".$new_release_data->product_build_numer;
                } elseif(empty($actionHistory->old_build_id) && !empty($actionHistory->old_pai_build_id)) { // pai old build id present but no spo build id
                    $old_release_data = $actionHistory->return_pai_versions_by_id($actionHistory->old_pai_build_id);
                    $new_release_data = $actionHistory->return_pai_versions_by_id($actionHistory->new_pai_build_id);
                    $build = $old_release_data->pai_version." ".$old_release_data->pai_build;
                    $build .= " <i class=\"fas fa-long-arrow-alt-right\" title=\"upgraded to\"></i> ".$new_release_data->pai_build;
                } else { //both are present
                    $old_spo_release_data = $actionHistory->return_product_versions_by_id($actionHistory->old_build_id);
                    $new_spo_release_data = $actionHistory->return_product_versions_by_id($actionHistory->new_build_id);
                    $old_pai_release_data = $actionHistory->return_pai_versions_by_id($actionHistory->old_pai_build_id);
                    $new_pai_release_data = $actionHistory->return_pai_versions_by_id($actionHistory->new_pai_build_id);
                    $build = $old_spo_release_data->product_ver_number." ".$old_spo_release_data->product_build_numer;
                    $build = $old_spo_release_data->product_ver_number." ".$old_spo_release_data->product_build_numer;
                    $build .= " <i class=\"fas fa-long-arrow-alt-right\" title=\"spo upgraded to\"></i> ".$new_spo_release_data->product_build_numer."<br>";
                    $build .= $old_pai_release_data->pai_version." ".$old_pai_release_data->pai_build;
                    $build .= " <i class=\"fas fa-long-arrow-alt-right\" title=\"upgraded to\"></i> ".$new_pai_release_data->pai_build;
                }

                $action_text = get_action_text($actionHistory->action);

                try {
                    if ($actionHistory->jenkins_build_id != 0) {
                        $gen_jenkins_url = "<a href=\"".$actionHistory->instance_details->jenkins_url."/".$actionHistory->jenkins_build_id."/console\" target=\"_blank\"> ".$actionHistory->jenkins_build_id." </a>";
                    } else {
                        $gen_jenkins_url = $actionHistory->jenkins_build_id;
                    }
                } catch (\Throwable $th) {
                    Log::error('Jenkins details missing for Action History '.$actionHistory->id);
                    Log::error($th);
                    $gen_jenkins_url = Null;
                }

                try {
                    $instance_name = $actionHistory->instance_details->instance_name;
                } catch (\Throwable $th) {
                    Log::error('Missing value for instance_details for Action History ID '.$actionHistory->id.' and instance_details_id '.$actionHistory->instance_details_id);
                    Log::error($th);
                    $instance_name = Null;
                }

                if(Auth::user()->hasAnyRole(['advance', 'admin', 'superadmin'])) {
                    $show = true;
                } else {
                    if (Auth::id() == $actionHistory->users_id) {
                        $show = true;
                    } else {
                        $show = false;
                    }
                }

            @endphp

            @if($show == true)
                <tr>
                <td class="text-center">{!! $actionHistory->id !!}</td>
                <td>{!! $actionHistory->users->name !!}</td>
                <td class="text-center">
                    <a href="{!! route('instanceDetails.show', [$actionHistory->instance_details_id]) !!}">
                        {!! $instance_name !!}
                    </a>
                </td>
                <td class="text-center"> {!! $build !!} </td>

                <td class="text-center"> {!! $gen_jenkins_url !!} </td>
                <td> {!! $action_text !!} </td>

                <td>{!! Carbon\Carbon::parse($actionHistory->start_time)->toDateTimeString() !!} IST</td>

                <td>
                    @if($actionHistory->end_time == null)
                    {{-- Print nothing --}}
                    @php $hasEndTime = False; @endphp
                    @else
                    {!! Carbon\Carbon::parse($actionHistory->end_time)->toDateTimeString() !!} IST
                    @endif
                </td>

                <td>{!! $actionHistory->status !!}</td>

                @can('edit-actionHistories')
                    <td class="text-center">
                        <div class="btn-group">
                            {!! Form::open(['class'=>'inline','route' => ['actionHistories.edit', $actionHistory->id], 'method' => 'get']) !!}
                            {!! Form::button('<i class="fas fa-pencil-alt" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-edit btn-xs']) !!}
                            {!! Form::close() !!}
                        @if(!$hasEndTime)
                            @role('superadmin')
                                {!! Form::open(['class'=>'inline','route' => ['actionHistories.destroy', $actionHistory->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="fas fa-trash" title="Delete"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to delete this action history record?')"]) !!}
                                {!! Form::close() !!}
                            @endrole
                        @endif
                        </div>
                    </td>
                @endcan
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
{{-- </div> --}}
