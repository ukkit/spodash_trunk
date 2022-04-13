@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Tablespace Detail
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tablespaceDetail, ['route' => ['tablespaceDetails.update', $tablespaceDetail->id], 'method' => 'patch']) !!}

                        @include('tablespace_details.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection