@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1 class="pull-left">Pre-Sales Instances</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                    @include('instance_details.ps-table')
            </div>
        </div>
        {{-- <div class="text-center">
            {{ $instanceDetails->links() }}
        </div> --}}

    </div>
@endsection

