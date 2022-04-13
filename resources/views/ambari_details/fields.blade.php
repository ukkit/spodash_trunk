    <div class="row">
        <!-- Ambari Name Field -->
        <div class="form-group col-sm-2">
            {!! Form::label('ambari_name', 'Name:') !!}
            {!! Form::text('ambari_name', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Ambari Url Field -->
        <div class="form-group col-sm-4">
            {!! Form::label('ambari_url', 'URL:') !!}
            {!! Form::text('ambari_url', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Ambari User Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('ambari_user', 'User Name:') !!}
            {!! Form::text('ambari_user', null, ['class' => 'form-control']) !!}
        </div>

        <!-- Ambari Pwd Field -->
        <div class="form-group col-sm-3">
            {!! Form::label('ambari_pwd', 'Password:') !!}
            {!! Form::text('ambari_pwd', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="box-footer">
    <!-- Submit Field -->
    <div class="form-group col-sm-12">
            <div class="text-center">
            {!! Form::submit('Save', ['class' => 'btn btn100px btn-primary']) !!}
            <a href="{!! route('ambariDetails.index') !!}" class="btn btn100px btn-default">Cancel</a>
        </div>
    </div>

{{--
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('ambariDetails.index') }}" class="btn btn-default">Cancel</a>
</div> --}}
