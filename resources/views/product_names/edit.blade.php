@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Product Name
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($productName, ['route' => ['productNames.update', $productName->id], 'method' => 'patch']) !!}

                        @include('product_names.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection