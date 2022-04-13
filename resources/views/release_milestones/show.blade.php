@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! $releaseMilestone->product_name_by_id($releaseMilestone->release_numbers_id,'product_short_name')->get('0') !!} {!! $releaseMilestone->release_number_by_id($releaseMilestone->release_numbers_id)->release_number !!} Release Milestones
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('release_milestones.show_fields')

                </div>
            </div>
            <div class="box-footer text-center">
                @if(is_null($releaseMilestone->released_date))
                @can('edit_releaseDetails')
                <div class="btn-group" role="group" aria-label="...">
                    {!! Form::open(['route' => ['releaseMilestones.edit', $releaseMilestone->id], 'method' => 'get']) !!}
                    {!! Form::button('Edit', ['type' => 'submit', 'class' => 'btn btn-group btn-info']) !!}
                    {!! Form::close() !!}
                </div>
                &nbsp;&nbsp;
                @endcan
                @endif
                <div class="btn-group" role="group" aria-label="...">
                    {!! Form::open(['route' => ['releaseMilestones.index', $releaseMilestone->id], 'method' => 'get']) !!}
                    {!! Form::button('Back', ['type' => 'submit', 'class' => 'btn btn-group btn-default']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
