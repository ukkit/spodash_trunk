@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">
            @if($serverDetail->server_use_by_id->use_short_name == "DB")
                <i class="fas fa-database fa-fw fa-lg" title="{!! $serverDetail->server_use_by_id->use_long_name !!}"></i>
            @elseif ($serverDetail->server_use_by_id->use_short_name == "APP")
                <i class="far fa-file-alt fa-fw fa-lg" title="{!! $serverDetail->server_use_by_id->use_long_name !!}"></i>
            @else
                <i class="fas fa-server fa-fw fa-lg" title="{!! $serverDetail->server_use_by_id->use_long_name !!}"></i>
            {{-- <i class="fas fa-server fa-fw fa-lg"></i> --}}
            @endif
            {!! $serverDetail->server_name !!} ({!! $serverDetail->server_ip !!})
        <i> {!! $serverDetail->server_use_by_id->use_long_name !!}</i>
        </h1>

        <h1 class="pull-right">
                {{-- <a href="{!! route('serverDetails.index') !!}" class="btn btn-default">Back</a> --}}
            <a class="btn bg-olive pull-right" style="margin-top: -10px; margin-bottom: 5px" href="{!! URL::previous() !!}">Back</a>
        </h1>

    <br>
    </section>
    <div class="content">
        <div class="clearfix"></div>

            @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('server_details.show_fields')
                    {{-- <a href="{!! route('serverDetails.index') !!}" class="btn btn-default">Back</a> --}}
                </div>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('server_details.list')
                    {{-- <a href="{!! route('serverDetails.index') !!}" class="btn btn-default">Back</a> --}}
                </div>
            </div>
        </div>
    </div>
@endsection
