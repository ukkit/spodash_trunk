@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Product Version
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($productVersion, ['route' => ['productVersions.update', $productVersion->id], 'method' => 'patch']) !!}

                        @include('product_versions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection