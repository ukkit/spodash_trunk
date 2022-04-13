@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Edit details for {!! $serverDetail->server_name !!}
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               {{-- <div class="row"> --}}
                   {!! Form::model($serverDetail, ['route' => ['serverDetails.update', $serverDetail->id], 'method' => 'patch']) !!}

                        @include('server_details.fields')

                   {!! Form::close() !!}
               {{-- </div> --}}
           </div>
       </div>
   </div>
@endsection