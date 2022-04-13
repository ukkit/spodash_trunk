@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pai Build
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'paiBuilds.store']) !!}

                        @include('pai_builds.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
