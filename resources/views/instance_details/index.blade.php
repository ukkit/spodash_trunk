@extends('layouts.app')

@section('content')

    <section class="content-header">

        <h1 class="pull-left">Instance Details</h1>

        @can('add_instanceDetails')
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('instanceDetails.create') !!}">Add</a>
        </h1>
        @endcan
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="box box-primary">
            <div class="box-body">
                    @include('instance_details.table')
            </div>
        </div>
        {{-- <div class="text-center">
            {{ $instanceDetails->links() }}
        </div> --}}

    </div>
@endsection

