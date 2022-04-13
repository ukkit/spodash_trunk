<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="{!! $title !!}">
        <h4 class="panel-title">
            {{--  {!! $title !!}  --}}
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#dd-{!! $title !!}" aria-expanded="true" aria-controls="dd-{!! $title !!}">
                {!! strtoupper($title) !!} PERMISSIONS: {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
            </a>
        </h4>
    </div>

    <div id="dd-{!! $title !!}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="dd-{!! $title !!}">
        <div class="panel-body">
            <div class="row">
                @foreach($permissions as $perm)
                    <?php
                        $per_found = null;

                        if( isset($role) ) {
                            $per_found = $role->hasPermissionTo($perm->name);
                        }

                        if( isset($user)) {
                            $per_found = $user->hasDirectPermission($perm->name);
                        }
                    ?>

                    <div class="col-md-3">
                        <div class="checkbox">
                            <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                @can('edit_roles')
                                {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}
                                @else
                                {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : ['disabled']) !!} {{ $perm->name }}
                                @endcan
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @can('edit_roles')
        <div class="panel-footer">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
        @endcan
    </div>
</div>