@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Intellicus Detail
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               {{-- <div class="row"> --}}
                   {!! Form::model($intellicusDetail, ['route' => ['intellicusDetails.update', $intellicusDetail->id], 'method' => 'patch']) !!}

                        @include('intellicus_details.fields')

                   {!! Form::close() !!}
               {{-- </div> --}}
           </div>
       </div>
   </div>
@endsection