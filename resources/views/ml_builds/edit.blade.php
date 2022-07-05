@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Ml Build
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($mlBuild, ['route' => ['mlBuilds.update', $mlBuild->id], 'method' => 'patch']) !!}

                        @include('ml_builds.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection