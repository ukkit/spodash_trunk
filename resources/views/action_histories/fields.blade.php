<!-- Unique Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unique_id', 'Unique Id:') !!}
    {!! Form::text('unique_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Users Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('users_id', 'Users Id:') !!}
    {!! Form::number('users_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Jenkins Build Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenkins_build_id', 'Jenkins Build Id:') !!}
    {!! Form::number('jenkins_build_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Action Field -->
<div class="form-group col-sm-6">
    {!! Form::label('action', 'Action:') !!}
    {!! Form::text('action', null, ['class' => 'form-control']) !!}
</div>

<!-- Start Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('start_time', 'Start Time:') !!}
    {!! Form::date('start_time', null, ['class' => 'form-control','id'=>'start_time']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#start_time').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- End Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('end_time', 'End Time:') !!}
    {!! Form::date('end_time', null, ['class' => 'form-control','id'=>'end_time']) !!}
</div>

@section('scripts')
    <script type="text/javascript">
        $('#end_time').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endsection

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('actionHistories.index') !!}" class="btn btn-default">Cancel</a>
</div>
