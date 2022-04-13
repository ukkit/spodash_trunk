@extends('layouts.app')
@php
    $team_name_array = $instanceDetail->return_team_names($instanceDetail->id,'team_name');
    $team = "";
    $ctr = 1;
    if (count($team_name_array) == 1 ) {
        foreach ($team_name_array as $tna) {
            $team = $tna;
        }
    } elseif (count($team_name_array) >= 2) {
        foreach ($team_name_array as $tna) {
            if ( count($team_name_array) == $ctr) {
                $team .= $tna;
            } else {
                $team .= $tna . ", ";
            }
            $ctr++;
            // echo $team;
        }
    }
@endphp
@section('content')
    <section class="content-header">
        <h1 class="pull-left">
            {!! $instanceDetail->instance_name !!} <small><i> {!! $team !!}</i></small>
        </h1>
        <h1 class="pull-right">
                {{-- <a href="{!! route('serverDetails.index') !!}" class="btn btn-default">Back</a> --}}
            @can('edit_instanceDetails')
                <a class="btn btn-info" style="margin-top: -10px; margin-bottom: 5px" href="{{ route('instanceDetails.edit', ['id' => $instanceDetail->id]) }}">Edit</a>
            @endcan
            <a class="btn bg-olive" style="margin-top: -10px; margin-bottom: 5px" href="{!! url()->previous() !!}">Back</a>
        </h1>
        <br>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                @include('instance_details.show_fields')
                {{-- <a href="{!! route('instanceDetails.index') !!}" class="btn btn-default">Back</a> --}}
            </div>
        </div>
    </div>
@endsection
