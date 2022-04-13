@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Machine Learning Details</h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               {{-- <div class="row"> --}}
                   {!! Form::model($mlDetail, ['route' => ['mlDetails.update', $mlDetail->id], 'method' => 'patch']) !!}

                        @include('ml_details.fields')

                   {!! Form::close() !!}
               {{-- </div> --}}
           </div>
       </div>
   </div>
@endsection