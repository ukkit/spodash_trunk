<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="google" content="notranslate">
    <meta http-equiv="Content-Language" content="en">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    @if (Request::is('instanceDetails'))
        <meta http-equiv="refresh" content="300" >
    @endif

    @if (env('APP_ENV') == 'Production')
        <title>SPO-Dashboard</title>
    @else
        <title>SPO-Dashboard | {{ env('BETA_VERSION') }}</title>
    @endif


    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  -->
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous"> --}}

    {{-- <script src="https://kit.fontawesome.com/a7d2453bd0.js" crossorigin="anonymous"></script> --}}
    <link rel="stylesheet" href="{{ URL::asset('css/fontawesome-5.15.4/css/all.css') }}">


    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    {{-- Font Mfizz --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-mfizz/2.4.1/font-mfizz.css" rel="stylesheet" />

    <!-- DataTable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">


    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Oswald|Cuprum|Source+Sans+Pro&display|Roboto|Noto+Sans+JP&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:wght@500&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ URL::asset('css/copper.css?version=15') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/tables.css?version=15') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/buttons.css?version=15') }}">
    <link rel="icon" href="{{ URL::asset('img/favicon.png') }}" type="image/x-icon">

    @yield('css')
</head>

<body class="skin-green layout-top-nav">

    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">
            <nav class="navbar navbar-static-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">
                        {{-- <img src="{{ URL::asset('img/dark_icon.png') }}" /> --}}
                        <img src="{{ URL::asset('img/small-logo.png') }}" />
                        @if (env('APP_ENV') == 'Production')
                            SPO-DASHboard
                        @else
                            SPO-Dashboard <i>{{ env('BETA_VERSION') }}</i>
                        @endif
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                @include('layouts.menu')

                </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <?php
        $cip = ($_SERVER['REMOTE_ADDR']);
        // $minor = `svn info -r 'HEAD' | grep Revision | egrep -o "[0-9]+"`;
        $revision = `svnversion`;
        $git_rev = `git rev-list --count HEAD`
        ?>
        <footer class="main-footer">
            @if(Auth::user())
                <small>© {!! env('COPYRIGHT_YEAR') !!} PTC GURGAON  - v.{{ env('SPOD_VERSION') }}.{{ $git_rev }} - {{ strtoupper(Browser::browserName()) }} - {{ strtoupper(Auth::user()->name) }}
                @hasrole('zero')
                    /ZERO
                @endhasrole
                    @hasrole('basic')
                    /BASIC
                @endhasrole
                @hasrole('advance')
                    /ADVANCE
                @endhasrole
                @hasrole('admin')
                    /ADMIN
                @endhasrole
                @hasrole('superadmin')
                    /SUPERADMIN
                @endhasrole
            </small>
            @else
                @if (env('APP_ENV') == 'Production')
                    <small>© {!! env('COPYRIGHT_YEAR') !!} PTC GURGAON - v.{{ env('SPOD_VERSION') }}.{{ $git_rev }} - {{ strtoupper(Browser::browserName()) }} </small>
                @else
                    <small>© {!! env('COPYRIGHT_YEAR') !!} PTC GURGAON - {{ env('BETA_VERSION') }} - {{ strtoupper(Browser::browserName()) }} </small>
                @endif
            @endif

        </footer>
    </div>

    {{-- JQuery 3.4.0 --}}
    <script
        src="https://code.jquery.com/jquery-3.4.0.min.js"
        integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg="
        crossorigin="anonymous">
    </script>

    <!-- jQuery 3.1.1 -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>

    <script src="{{ URL::asset('js/copper.js') }}"></script>

    @yield('scripts')
</body>
</html>