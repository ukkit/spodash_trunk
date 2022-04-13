<div class="table-responsive">
    <table class="table table-responsive table-condensed table-hover" id="users-table">
        <thead>
            <tr>
                <th class="text-center id_column"><i class="fas fa-portrait" title="ID"></i></th>
                <th><i class="fas fa-user-astronaut" title="User Name"></i></th>
                <th class="text-center"><i class="fas fa-people-carry" title="User Role"></i></th>
                <th class="text-center"><i class="fas fa-users" title="Teams"></i></th>
                <th><i class="far fa-clock" title="Last Login Time"></i></th>
                <th><i class="fas fa-network-wired" title="Last Login IP"></i></th>
                <th><i class="fas fa-history" title="Last Action Performaned"></i></th>
                <th class="text-center column_3pct"><i class="fas fa-calculator" title="Action Count"></i></th>
                @can('edit_users', 'delete_users')
                <th class="text-center icon_column"><i class="fas fa-tools" title="Actions"></i></th>
                @endcan
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        @php
        $show_url = Null;
        // try {
        //     $action = $user->userAction($user->id)->action;
        // } catch (\Throwable $th) {
        //     $action = Null;
        // }
        // try {
        //     $last_action_time = $user->userAction($user->id)->updated_at;
        // } catch (\Throwable $th) {
        //     $last_action_time = null;
        // }
        try {
            $action = $user->userAction($user->id)->action;
            $start_time = $user->userAction($user->id)->start_time;
            $end_time = $user->userAction($user->id)->end_time;
            $action_details = $action ." <i class=\"far fa-clock\" title=\"End Time\"></i> ".$end_time;
            // $action_details = $action ." <i class=\"fas fa-arrow-up\" title=\"Start Time\"></i> ".$start_time. " <i class=\"fas fa-arrow-down\" title=\"End Time\"></i> ".$end_time;
        } catch (\Throwable $th) {
            $action = null;
            $start_time = null;
            $end_time = null;
            $action_details = null;
        }
        $action_count = count($user->user_actions($user->id));
        if ((!empty($user->last_login_at) && $action_count > 0)) {
            $show_url = "Y";
        }

        @endphp
            <tr>
                <td class="text-center" >{!! $user->id !!}</td>
                <td>
                    @hasanyrole('advance|admin|superadmin')
                        @if($show_url == "Y")
                        <a href="{!! route('users.show', [$user->id]) !!}">{!! $user->name !!}</a>
                        @else
                        {!! $user->name !!}
                        @endif
                    @else
                     {!! $user->name !!}
                    @endhasanyrole
                </td>
                <td class="text-center">{!! $user->roles->implode('name', ', ') !!}</td>
                <td class="text-center">{!! $user->userTeams($user->id)->implode('team_name', '<br>') !!}</td>
                <td>{!! $user->last_login_at !!}</td>
                <td>{!! $user->last_login_ip !!}</td>
                <td>{!!  $action_details !!}</td>
                <td class="text-center">
                    {!! $action_count !!}
                </td>
                @can('edit_users')
                <td class="text-center">
                    {!! Form::open(['route' => ['users.edit', $user->id], 'method' => 'get']) !!}
                    {!! Form::button('<i class="far fa-edit" title="Edit"></i>', ['type' => 'submit', 'class' => 'btn btn-info btn-xs']) !!}
                    {!! Form::close() !!}
                </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
