<!-- Team Name Field -->
<div class="form-group col-md-3 col-md-offset-3">
    {!! Form::label('team_name', 'Team Name:') !!}
    {!! Form::text('team_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Team Email Field -->
<div class="form-group col-md-3">
    {!! Form::label('team_email', 'Team Name:') !!}
    {!! Form::text('team_email', null, ['class' => 'form-control', 'placeholder' => 'Enter email address']) !!}
</div>

<hr>
<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('teams.index') !!}" class="btn btn-default">Cancel</a>
</div>
