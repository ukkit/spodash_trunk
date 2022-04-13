<!-- Server Details Id Field -->
<div class="form-group">
    {!! Form::label('server_details_id', 'Server Details Id:') !!}
    <p>{{ $intellicusDetail->server_details_id }}</p>
</div>

<!-- Intellicus Port Field -->
<div class="form-group">
    {!! Form::label('intellicus_port', 'Intellicus Port:') !!}
    <p>{{ $intellicusDetail->intellicus_port }}</p>
</div>

<!-- Intellicus Login Field -->
<div class="form-group">
    {!! Form::label('intellicus_login', 'Intellicus Login:') !!}
    <p>{{ $intellicusDetail->intellicus_login }}</p>
</div>

<!-- Intellicus Pwd Field -->
<div class="form-group">
    {!! Form::label('intellicus_pwd', 'Intellicus Pwd:') !!}
    <p>{{ $intellicusDetail->intellicus_pwd }}</p>
</div>

<!-- Intellicus Install Path Field -->
<div class="form-group">
    {!! Form::label('intellicus_install_path', 'Intellicus Install Path:') !!}
    <p>{{ $intellicusDetail->intellicus_install_path }}</p>
</div>

