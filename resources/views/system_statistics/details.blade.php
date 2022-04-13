@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left"> DETAILED STATISTICS </h1>
        <a class="btn bg-olive pull-right" style="margin-top: -10px; margin-bottom: 5px" href="{!! URL::previous() !!}">Back</a>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        {{-- <div class="box box-primary">
            <div class="box-body">
                    @include('system_statistics.action')
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-body">
                @include('system_statistics.release-summary')
            </div>
        </div> --}}
        <div class="box box-primary">
            <div class="box-body">
                @include('system_statistics.release-details')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

