@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Os Type
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($osType, ['route' => ['osTypes.update', $osType->id], 'method' => 'patch']) !!}

                        @include('os_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection