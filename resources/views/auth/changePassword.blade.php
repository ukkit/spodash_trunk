@extends('layouts.app')
@section('content')

    <section class="content-header">
        <h1 class="pull-left">Change Password</h1>
    </section>

    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                <div class="col-md-8 col-md-offset-2">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">Current Password</label>

                                <div class="col-md-6">
                                    <input id="current-password" type="password" class="form-control" name="current-password" required>

                                    @if ($errors->has('current-password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">New Password</label>

                                <div class="col-md-6">
                                    <input id="new-password" type="password" class="form-control" name="new-password" required>

                                    @if ($errors->has('new-password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                                <div class="col-md-6">
                                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                    <a href="{!! route('instanceDetails.index') !!}" class="btn btn100px btn-default">Cancel</a>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Change Password
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection