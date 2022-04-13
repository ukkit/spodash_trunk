
<div class="row">
    <!-- Server Class Field -->
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('server_class', 'Server Type:') !!}
            <p>{!! $serverDetail->server_class !!}</p>
        </div>
    </div>

    <!-- Server Purpose Field -->
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('server_purpose', 'Server Location:') !!}
            <p>{!! $serverDetail->server_location !!}</p>
        </div>
    </div>

    <!-- Server Is Active Field -->
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('server_is_active', 'Active:') !!}
            <p>@if($serverDetail->server_is_active=="Y") Yes @else No @endif</p>
        </div>
    </div>

    <!-- Database Types Id Field -->
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('database_types_id', 'Database Type:') !!}
            <p>{!! $serverDetail->database_types_by_id->db_long_name !!}</p>
        </div>
    </div>

    <!-- Os Types Id Field -->
    <div class="col-md-3">
        <div class="form-group">
            {!! Form::label('os_types_id', 'Operating System:') !!}
            <p>{!! $serverDetail->os_types_by_id->os_long_name !!}</p>
        </div>
    </div>

</div>

<div class="row">
    <!-- Server Ram Gb Field -->
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('server_ram_gb', 'RAM:') !!}
            <p>{!! $serverDetail->server_ram_gb !!} GB</p>
        </div>
    </div>

    <!-- Server Hdd Gb Field -->
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('server_hdd_gb', 'Disk Space:') !!}
            <p>{!! $serverDetail->server_hdd_gb !!} GB</p>
        </div>
    </div>

    <!-- Server CPU Cores Field -->
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('server_hdd_gbserver_cpu_cores', 'CPU Cores:') !!}
            <p>{!! $serverDetail->server_cpu_cores !!}</p>
        </div>
    </div>

    <!-- Server Owner Field -->
    @if($serverDetail->server_owner != "")
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('server_owner', 'Server Owner:') !!}
                <p>{!! $serverDetail->server_owner !!}</p>
            </div>
        </div>
    @endif

    <!-- Server Note Field -->
    @if($serverDetail->server_note != "")
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('server_note', 'Notes:') !!}
                <p>{!! $serverDetail->server_note !!}</p>
            </div>
        </div>
    @endif

</div>

@hasanyrole('advance|admin|superadmin')
<div class="row">

    <!-- Server Is Active Field -->
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('server_show_on_site', 'Show on Site:') !!}
            <p>@if($serverDetail->server_show_on_site=="Y") Yes @else No @endif</p>
        </div>
    </div>


    <!-- Server User Field -->
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('server_user', 'Server Login:') !!}
            <p>{!! $serverDetail->server_user !!}</p>
        </div>
    </div>

    <!-- Server Password Field -->
    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('server_password', 'Server Password:') !!}
            <p>{!! $serverDetail->server_password !!}</p>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            {!! Form::label('nothing', 'DBA Entries:') !!}
            <p>{!! $serverDetail->get_dba_counts($serverDetail->id) !!}</p>
        </div>
    </div>

    <div class="row">
        <!-- Admin Login Field -->
        @if($serverDetail->admin_user != "")
            <div class="form-group col-md-3">
                {!! Form::label('admin_user', 'Administrator Login:') !!}
                <p>{!! $serverDetail->admin_user !!}</p>
            </div>
        @endif

        <!-- Admin Password Field -->
        @if($serverDetail->admin_password != "")
            <div class="form-group col-md-3">
                {!! Form::label('admin_password', 'Administrator Password:') !!}
                <p>{!! $serverDetail->admin_password !!}</p>
            </div>
        @endif
    </div>
</div>
@endhasanyrole

