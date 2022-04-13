@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Action History
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($actionHistory, ['route' => ['actionHistories.update', $actionHistory->id], 'method' => 'patch']) !!}

                        @include('action_histories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection