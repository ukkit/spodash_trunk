
<li class="{{ Request::is('instanceDetails*') ? 'active' : '' }}">
    <a href="{!! route('instanceDetails.index') !!}"><i class="fa fa-home fa-fw fa-lg"></i></a>
</li>

<li class="{{ Request::is('preSales*') ? 'active' : '' }}">
    <a href="{!! route('instanceDetails.presales') !!}" title="Pre-Sales Instances"><i class="fas fa-poll fa-fw fa-lg"></i></a>
</li>

<li class="{{ Request::is('serverDetails*') ? 'active' : '' }}">
    <a href="{!! route('serverDetails.index') !!}" title="List all Server"><i class="fas fa-server fa-fw fa-lg"></i></a>
</li>


@if(Auth::check())

    @hasrole('superadmin')
    {{-- @if(auth()->user()->role('superadmin') || (env('SHOW_RELEASE_MILESTONES') == True)) --}}

    @endhasrole

    <li class="{{ Request::is('actionHistories*') ? 'active' : '' }}">
        <a href="{!! route('actionHistories.index') !!}"><i class="fas fa-history fa-fw fa-lg" Title="Action History"></i></a>
    </li>

    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-tools fa-lg"></i><span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
            <li class="{{ Request::is('databaseDetails*') ? 'active' : '' }}">
                <a href="{!! route('databaseDetails.index') !!}"><i class="fas fa-table"></i><span>Database Details</span></a>
            </li>

            <li class="{{ Request::is('intellicusDetails*') ? 'active' : '' }}">
                <a href="{{ route('intellicusDetails.index') }}"><i class="fas fa-info-circle"></i><span>Intellicus Details</span></a>
            </li>


            <li class="{{ Request::is('mlDetails*') ? 'active' : '' }}">
                <a href="{{ route('mlDetails.index') }}">
                    <i class="fab fa-leanpub"></i><span>Machine Learning</span>
                </a>
            </li>

        </ul>
    </li>

    @hasanyrole('advance|admin|superadmin')
        {{-- <li class="{{ Request::is('actionHistories*') ? 'active' : '' }}">
            <a href="{!! route('actionHistories.index') !!}"><i class="fas fa-history fa-fw fa-lg" Title="Action History"></i></a>
        </li> --}}

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-code-branch fa-lg"></i><span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">

                <li class="{{ Request::is('productVersions*') ? 'active' : '' }}">
                    <a href="{!! route('productVersions.index') !!}"><i class="fas fa-code-branch fa-lg"></i><span>SPM Builds</span></a>
                </li>

                <li class="{{ Request::is('paiBuilds*') ? 'active' : '' }}">
                    <a href="{{ route('paiBuilds.index') }}"><i class="fas fa-code-branch fa-lg"></i><span>PAI Builds</span></a>
                </li>

                <li class="{{ Request::is('sfBuilds*') ? 'active' : '' }}">
                    <a href="{{ route('sfBuilds.index') }}"><i class="fas fa-code-branch fa-lg"></i><span>Snowflake Builds</span></a>
                </li>

                <li class="{{ Request::is('mlBuilds*') ? 'active' : '' }}">
                    <a href="{{ route('mlBuilds.index') }}"><i class="fas fa-code-branch fa-lg"></i><span>ML Versions</span></a>
                </li>

                <li class="{{ Request::is('intellicusVersions*') ? 'active' : '' }}">
                    <a href="{{ route('intellicusVersions.index') }}"><i class="fas fa-code-branch fa-lg"></i><span>Intellicus Versions</span></a>
                </li>

            </ul>
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-hammer fa-lg"></i><span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">

                <li class="{{ Request::is('databaseTypes*') ? 'active' : '' }}">
                    <a href="{!! route('databaseTypes.index') !!}"><i class="fas fa-database"></i><span> Database Types</span></a>
                </li>

                <li class="{{ Request::is('osTypes*') ? 'active' : '' }}">
                    <a href="{!! route('osTypes.index') !!}"><i class="fab fa-windows"></i><span> Operating Systems</span></a>
                </li>

                <li class="{{ Request::is('serverUses*') ? 'active' : '' }}">
                    <a href="{!! route('serverUses.index') !!}"><i class="fas fa-cubes"></i><span>Server Uses</span></a>
                </li>

                <li class="{{ Request::is('productNames*') ? 'active' : '' }}">
                    <a href="{!! route('productNames.index') !!}"><i class="fab fa-product-hunt"></i><span> Product Names</span></a>
                </li>

                <li class="{{ Request::is('dbaDetails*') ? 'active' : '' }}">
                    <a href="{{ route('dbaDetails.index') }}">
                        <i class="fas fa-user-ninja"></i><span>DBA Details</span>
                    </a>
                </li>

                <li class="{{ Request::is('ambariDetails*') ? 'active' : '' }}">
                    <a href="{{ route('ambariDetails.index') }}"><i class="fab fa-amilia"></i><span>Ambari Details</span></a>
                </li>

                {{-- <li class="{{ Request::is('sprintCalendars*') ? 'active' : '' }}">
                    <a href="{!! route('sprintCalendars.index') !!}"><i class="fas fa-calendar"></i><span>Spirint Calendar</span></a>
                </li> --}}

            </ul>
        </li>

    @endhasanyrole

    @hasrole('superadmin')
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-atom fa-lg"></i></i><span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">

            {{-- <li class="{{ Request::is('releaseMilestones*') ? 'active' : '' }}">
                <a href="{{ route('releaseMilestones.index') }}"><i class="fas fa-archway"></i>
                    <span>Release Milestones</span>
                </a>
            </li> --}}

            <li class="{{ Request::is('tablespaceDetails*') ? 'active' : '' }}">
                <a href="{{ route('tablespaceDetails.index') }}"><i class="fas fa-table"></i>
                <span>Tablespace Details</span></a>
            </li>

            <li class="{{ Request::is('systemStatistics*') ? 'active' : '' }}">
                <a href="{{ route('systemStatistics.index') }}"><i class="fas fa-infinity"></i><span>Statistics</span></a>
            </li>

        </ul>
    </li>
    @endhasrole
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="{{ Auth::user()->name }}"><i class="fas fa-user-circle fa-lg"></i></i><span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">

            @hasanyrole('admin|superadmin')
                <li class="{{ Request::is('users*') ? 'active' : '' }}">
                    <a href="{!! route('users.index') !!}"><i class="fas fa-user-shield"></i>
                    <span>Users</span></a>
                </li>

                <li class="{{ Request::is('teams*') ? 'active' : '' }}">
                    <a href="{!! route('teams.index') !!}"><i class="fas fa-users-cog"></i>
                    <span>Teams</span></a>
                </li>

                <li class="{{ Request::is('roles*') ? 'active' : '' }}">
                    <a href="{!! route('roles.index') !!}"><i class="fas fa-user-astronaut"></i>
                    <span>Roles</span></a>
                </li>

                @if (env('ENABLE_REGISTRATIONS') == True)
                    <li class="{{ Request::is('register*') ? 'active' : '' }}">
                        <a href="register" title="Register"><i class="fas fa-user-plus"></i>
                        <span>Add User</span></a>
                    </li>
                @endif
            @endhasanyrole

            @hasanyrole('advance|admin|superadmin')
                <li class="{{ Request::is('log*') ? 'active' : '' }}">
                    <a href="{!! route('show.log') !!}" target="_blank"><i class="fas fa-file-alt"></i><span>Dashboard Log</span></a>
                </li>


            @endhasanyrole

            @if (env('ALLOW_PASSWORD_CHANGES') !== False)
                <li class="{{ Request::is('changePassword*') ? 'active' : '' }}">
                    <a href="{!! route('changePassword') !!}" title="Change Password for {{ Auth::user()->name }}"><i class="fas fa-key"></i>
                    <span>Change Password</span></a>
                </li>
            @endif
            <li class="{{ Request::is('logout*') ? 'active' : '' }}">
                <a href="{!! route('logout') !!}" title="Logout {{ Auth::user()->name }}"><i class="fas fa-sign-out-alt" ></i>
                <span>Logout</span></a>
            </li>
        </ul>
    </li>
    {{-- @else
    <li class="{{ Request::is('logout*') ? 'active' : '' }}">
        <a href="logout" title="Logout {{ Auth::user()->name }}"><i class="fas fa-sign-out-alt fa-lg" ></i></a>
    </li>
    @endhasanyrole --}}

@else


    <li class="{{ Request::is('login*') ? 'active' : '' }}">
        {{-- <a href="{{ url('/login')  . '?previous_url=' . urlencode(Request::fullUrl()) }}" title="Login"><i class="fas fa-sign-in-alt fa-lg"></i></a> --}}
        <a href="{!! url('/login') !!}" title="Login"><i class="fas fa-sign-in-alt fa-lg"></i></a>
        {{-- <a href="login" title="Login"><i class="fas fa-sign-in-alt fa-lg"></i></a> --}}
    </li>

@endif



