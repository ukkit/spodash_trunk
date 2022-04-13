@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Database Type
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($databaseType, ['route' => ['databaseTypes.update', $databaseType->id], 'method' => 'patch']) !!}

                        @include('database_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection