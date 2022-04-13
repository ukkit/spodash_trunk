@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Ambari Detail
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               {{-- <div class="row"> --}}
                   {!! Form::model($ambariDetail, ['route' => ['ambariDetails.update', $ambariDetail->id], 'method' => 'patch']) !!}

                        @include('ambari_details.fields')

                   {!! Form::close() !!}
               {{-- </div> --}}
           </div>
       </div>
   </div>
@endsection