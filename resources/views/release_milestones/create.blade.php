@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Release Milestone
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')

        <div class="box box-primary">
            <div class="box-body">
                @can('add_releaseDetails')
                <div class="row">

                    {!! Form::open(['route' => 'releaseMilestones.store']) !!}

                        @include('release_milestones.fields')

                    {!! Form::close() !!}
                </div>
                @else
                <div class="alert alert-warning" role="alert">
                    <strong>Warning!</strong> You don't have permission to access this page.
                </div>
                @endcan
            </div>
        </div>
        {{-- @else
        <div class="alert alert-warning" role="alert">
            <p>You don't have permission to add Release Milestones</p>
        </div> --}}

    </div>
@endsection
