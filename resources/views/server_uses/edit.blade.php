@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Server Use
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($serverUse, ['route' => ['serverUses.update', $serverUse->id], 'method' => 'patch']) !!}

                        @include('server_uses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection