<!-- Server Details Id Field -->

<!-- Use Short Name Field -->
<div class="form-group col-sm-3">
    {!! Form::label('use_short_name', 'Short Name:') !!}
    {!! Form::text('use_short_name', null, ['class' => 'form-control', 'placeholder' => 'APP', 'required']) !!}
</div>

<!-- Use Long Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('use_long_name', 'Long Name:') !!}
    {!! Form::text('use_long_name', null, ['class' => 'form-control', 'placeholder' => 'App Server', 'required']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('serverUses.index') !!}" class="btn btn-default">Cancel</a>
</div>
