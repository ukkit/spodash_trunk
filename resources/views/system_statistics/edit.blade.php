@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            System Statistic
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($systemStatistic, ['route' => ['systemStatistics.update', $systemStatistic->id], 'method' => 'patch']) !!}

                        @include('system_statistics.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection