@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">SPM Builds</h1>
        @can('add_productVersions')
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('productVersions.create') !!}">Add</a>
        </h1>
        @endcan
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('product_versions.table')
            </div>
        </div>
        {{-- <div class="text-center">
            {{ $productVersions->links() }}
        </div> --}}
    </div>
@endsection

