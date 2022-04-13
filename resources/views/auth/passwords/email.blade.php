<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SPO-Dashboard sign-in</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Oswald|Vast+Shadow|Righteous|Cuprum" rel="stylesheet">

    <link rel="stylesheet" href="{{ URL::asset('css/copper.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/buttons.css') }}">
    <link rel="icon" href="{{ URL::asset('img/favicon.png') }}" type="image/x-icon">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ URL::asset('img/dark_icon.png') }}" />
            SPO-Dashboard
            {{-- SPO-Dashboard <i>sign-in</i> --}}
            {{-- <a href="{{ url('/') }}">SPODASH</a> <i>admin</i> --}}
        </div>
        @if(session()->has('success'))
        <div class="clearfix"></div>
        <div class="box-body">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i>Success</h4>
                {{Session::get('success')}}
            </div>
        </div>
        @endif

        <div class="clearfix"></div>

    <div class="login-box-body">
        <p class="login-box-msg">Enter Email to reset password</p>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="post" action="{{ url('/password/email') }}">
            @csrf

            <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('email'))
                    <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-4">
                    <a href="{!! url('/login') !!}" class="btn btn-default btn-block btn-flat">Cancel</a>
                    </div>
                <div class="col-xs-8">
                    <button type="submit" class="btn btn-primary btn-flat pull-right">
                        Send Password Reset Link
                    </button>
                </div>
            </div>

        </form>

    </div>
    <!-- /.login-box-body -->
    <div class="login-box-footer">
        <!-- <small>© 2019 PTC GURGAON - {{ Browser::browserName() }}</small> -->
        © {!! env('COPYRIGHT_YEAR') !!} PTC GURGAON
    </div>
</div>
<!-- /.login-box -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
</body>
</html>
