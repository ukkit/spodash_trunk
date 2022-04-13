@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Intellicus Version
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($intellicusVersion, ['route' => ['intellicusVersions.update', $intellicusVersion->id], 'method' => 'patch']) !!}

                        @include('intellicus_versions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection