@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">
            Instance List for PAI Version {{ $paiBuild->pai_version }} build {{ $paiBuild->pai_build }}
        </h1>
        <h1 class="pull-right">
            <a class="btn bg-olive" style="margin-top: -10px; margin-bottom: 5px" href="{!! url()->previous() !!}">Back</a>
            </h1>
            <br>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                {{-- <div class="row" style="padding-left: 20px"> --}}
                    @include('pai_builds.show_fields')
                    {{-- <a href="{{ route('paiBuilds.index') }}" class="btn btn-default">Back</a> --}}
                {{-- </div> --}}
            </div>
        </div>
    </div>
@endsection
