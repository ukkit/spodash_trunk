<div class="row">

    <!-- Ml Name Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('ml_name', 'Name:') !!}
        {!! Form::text('ml_name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Server Details Id Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('server_details_id', 'Server:') !!}
        <select name="server_details_id" class="form-control select-server-name">
            <option value="">Select .... </option>
            @foreach($server_detail as $sda)
                @if($this_is_edit)
                <option value="{{ $sda->id }}" @if($sda->id==$record->server_details_id) selected='selected' @endif >{{ $sda->server_name }} ({{ $sda->server_ip }})</option>
                @else
                    <option value="{{ $sda->id }}">{{ $sda->server_name }} ({{ $sda->server_ip }})</option>
                @endif
            @endforeach
        </select>
    </div>

    <!-- Intellicus Details Id Field -->

    <div class="form-group col-sm-4">
        {!! Form::label('intellicus_details_id  ', 'Intellicus:') !!}
        <!-- {!! Form::number('intellicus_details_id', null, ['class' => 'form-control']) !!} -->
        <select name="intellicus_details_id" class="form-control select-app-server">
            <option value="">Optional</option>
            @foreach($intellicus_detail as $ida)
            @php
                $server_ip = $ida->server_details_by_id->server_ip;
                $server_name = $ida->server_details_by_id->server_name;
                $intell_ver = $ida->return_intellicus_version_details($ida->intellicus_versions_id, 'intellicus_version')->get('0');
                $intell_patch = $ida->return_intellicus_version_details($ida->intellicus_versions_id, 'intellicus_patch')->get('0');
                $is_https = $ida->is_https;
                if ($is_https == "Y") {
                    $http_icon = "#";
                } else {
                    $http_icon = "";
                }
            @endphp
                @if($this_is_edit)
                <option value="{{ $ida->id }}" @if($ida->id==$record->intellicus_details_id) selected='selected' @endif >{{ $ida->intellicus_name }} ({{ $server_name }}/{{ $server_ip }}:{{ ($ida->intellicus_port) }} ) ver {{ $intell_ver }} {{ $intell_patch }} {{ $http_icon }}</option>
                @else
                    <option value="{{ $ida->id }}">{{ $ida->intellicus_name }} ({{ $server_name }}/{{ $server_ip }}:{{ ($ida->intellicus_port) }} ) ver {{ $intell_ver }} {{ $intell_patch }}  {{ $http_icon }}</option>
                @endif
            @endforeach
        </select>
    </div>

</div>
<div class="row">

    <!-- Zeppelin User Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('zeppelin_user', 'Zeppelin User:') !!}
        {!! Form::text('zeppelin_user', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Zeppelin Pwd Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('zeppelin_pwd', 'Zeppelin Pwd:') !!}
        {!! Form::text('zeppelin_pwd', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Zeppelin Port Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('zeppelin_port', 'Zeppelin Port:') !!}
        {!! Form::number('zeppelin_port', null, ['class' => 'form-control']) !!}
    </div>

</div>

<div class="row">

    <!-- Installed Path Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('installed_path', 'Installed Path:') !!}
        {!! Form::text('installed_path', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Notes Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('notes', 'Notes:') !!}
        {!! Form::textarea('notes', null, ['class' => 'form-control', 'rows' => 2, 'placeholder' => 'Optional']) !!}
    </div>
</div>


{{-- <!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('mlDetails.index') }}" class="btn btn-default">Cancel</a>
</div> --}}

</div> {{-- THIS DIV CLOSED IS OF BOX-BODY FROM CREATE --}}


<div class="box-footer">
<!-- Submit Field -->
<div class="form-group col-sm-12">
        <div class="text-center">
        {!! Form::submit('Save', ['class' => 'btn btn100px btn-primary']) !!}
        <a href="{!! route('mlDetails.index') !!}" class="btn btn100px btn-default">Cancel</a>
    </div>
</div>