<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-4">
    {!! Form::label('email', 'Email:') !!}
    @if($this_is_edit)
        @hasanyrole('admin|superadmin')
            {!! Form::text('email', null, ['class' => 'form-control', 'required']) !!}
        @else
            {!! Form::text('email', null, ['class' => 'form-control', 'disabled']) !!}
        @endhasanyrole
    @else
        {!! Form::text('email', null, ['class' => 'form-control', 'required']) !!}
    @endif
</div>

@php
    $rolename = ($user->roles->pluck('name'));
    // dd($rolename[0]);
    if ($rolename[0] !== "superadmin") {
@endphp
<!-- Role Field -->
<div class="form-group col-sm-4 @if ($errors->has('roles')) has-error @endif">
    {!! Form::label('roles[]', 'Roles') !!}
    {!! Form::select('roles[]', $roles, isset($user) ? $user->roles->pluck('id')->toArray() : null,  ['class' => 'form-control']) !!}
    @if ($errors->has('roles')) <p class="help-block">{{ $errors->first('roles') }}</p> @endif
</div>

@php
    }
    // if ($rolename[0] == "basic") {
@endphp
<!-- Teams Field -->
<div class="form-group col-lg-12">
       @foreach($teams as $tm)
        <div class="col-sm-2">
           <input type="checkbox" id="{{$tm->team_name}}" name="teamName[]" value="{{$tm->id}}"
            @foreach($teams_arr as $tr)
                @if($tm->id == $tr->team_id) checked @endif
            @endforeach/>
            {{$tm->team_name}}
        </div>
       @endforeach
</div>

{{-- TEAMS BLOCK ENDS HERE --}}

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancel</a>
</div>
