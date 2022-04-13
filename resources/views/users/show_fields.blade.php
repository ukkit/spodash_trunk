<?php
    $Ctr=1;
?>
    <h3>User Action Histories</h3>
    <table class="table table-responsive table-condensed table-hover" id="user-actions-table">
        <thead>
            <th class="text-center id_column">#</th>
            <th class="text-center">Instance</th>
            <th>Action</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Status</th>
        </thead>
        <tbody>
        @foreach($user->user_actions($user->id) as $uac)
        @php

            try {
                $instance_name = $user->instance_details($uac->instance_details_id)->instance_name;

            } catch (\Throwable $th) {
                Log::error($th);
                $instance_name = Null;
            }
            switch($uac->action) {
                case "StartAppServer":
                    $action_text = "Start Server";
                    break;
                case "ShutDownAppServer":
                    $action_text = "Stop Server";
                    break;
                case "Restart":
                    $action_text = "Restart Server";
                    break;
                case "SPO_upgrade":
                    $action_text = "Build Update";
                    break;
                case "BuildUpdate":
                    $action_text = "PAI+SPM Update";
                    break;
                case "PAI_upgrade":
                    $action_text = "PAI Update";
                    break;
            }

        @endphp
            <tr>
                <td>{{ $Ctr }}</td>
                {{-- <td>{{ $instance_name }}</td> --}}
                <td>
                    <span class="instancce_name">
                        <a href="{!! route('instanceDetails.show', [$uac->instance_details_id]) !!}">
                        {!! $instance_name !!}
                    </a></span>
                </td>
                <td>{{ $action_text }}</td>
                <td>{{ $uac->start_time }}</td>
                <td>{{ $uac->end_time }}</td>
                <td>{{ $uac->status }}</td>
            </tr>
            @php $Ctr++ @endphp
        @endforeach
        </tbody>
    </table>
