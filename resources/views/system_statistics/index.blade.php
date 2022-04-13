@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left"> STATISTICS SUMMARY</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-header">
                <strong><i class="fas fa-history"></i> Action Summary</strong>
            </div>
            <div class="box-body">
                    @include('system_statistics.action-summary')
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header">
                <strong><i class="far fa-calendar-alt" ></i> Time-Period Summary</strong>
            </div>
            <div class="box-body">
                @include('system_statistics.time_period')
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header">
                <div class="pull-left"><strong><i class="fas fa-code-branch"></i> Release-wise Action Summary</strong></div>
                <div class="pull-right"><a href="{!! route('systemStatistics.details') !!}">Details <i class="fas fa-angle-double-right fa-xs"></i></a></div>
            </div>
            <div class="box-body">
                @include('system_statistics.release-summary')
            </div>
        </div>
        {{-- <div class="box box-primary">
            <div class="box-body">
                @include('system_statistics.release-details')
            </div>

        </div>
        <div class="text-center">

        </div> --}}
    </div>
@endsection

