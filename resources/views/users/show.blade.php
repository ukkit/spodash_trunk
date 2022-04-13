@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">User: {!! $user->name !!}</h1>
        {{-- <h1 class="pull-right">
            <a href="{!! route('users.index') !!}" class="btn btn-default">Back</a>
        </h1> --}}
        <h1 class="pull-right">
            {{-- <a href="{!! route('serverDetails.index') !!}" class="btn btn-default">Back</a> --}}
        <a class="btn bg-olive pull-right" style="margin-top: -10px; margin-bottom: 5px" href="{!! route('users.index') !!}">Back</a>
    </h1>
    </section>

    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('users.show_fields')
            </div>
        </div>
    </div>

@endsection
