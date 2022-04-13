@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Database Detail
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               {{-- <div class="row"> --}}
                   {!! Form::model($databaseDetail, ['route' => ['databaseDetails.update', $databaseDetail->id], 'method' => 'patch']) !!}

                        @include('database_details.fields')

                   {!! Form::close() !!}
               {{-- </div> --}}
           </div>
       </div>
   </div>
@endsection