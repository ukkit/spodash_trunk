<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $actionHistory->id !!}</p>
</div>

<!-- Unique Id Field -->
<div class="form-group">
    {!! Form::label('unique_id', 'Unique Id:') !!}
    <p>{!! $actionHistory->unique_id !!}</p>
</div>

<!-- Users Id Field -->
<div class="form-group">
    {!! Form::label('users_id', 'Users Id:') !!}
    <p>{!! $actionHistory->users_id !!}</p>
</div>

<!-- Jenkins Build Id Field -->
<div class="form-group">
    {!! Form::label('jenkins_build_id', 'Jenkins Build Id:') !!}
    <p>{!! $actionHistory->jenkins_build_id !!}</p>
</div>

<!-- Action Field -->
<div class="form-group">
    {!! Form::label('action', 'Action:') !!}
    <p>{!! $actionHistory->action !!}</p>
</div>

<!-- Start Time Field -->
<div class="form-group">
    {!! Form::label('start_time', 'Start Time:') !!}
    <p>{!! $actionHistory->start_time !!}</p>
</div>

<!-- End Time Field -->
<div class="form-group">
    {!! Form::label('end_time', 'End Time:') !!}
    <p>{!! $actionHistory->end_time !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $actionHistory->status !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $actionHistory->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $actionHistory->updated_at !!}</p>
</div>

<!-- Deleted At Field -->
<div class="form-group">
    {!! Form::label('deleted_at', 'Deleted At:') !!}
    <p>{!! $actionHistory->deleted_at !!}</p>
</div>

