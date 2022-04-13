@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            {!! $releaseMilestone->release_number_by_id($releaseMilestone->release_numbers_id)->release_number !!} Release Milestone
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
            @can('edit_releaseDetails')
                @if(is_null($releaseMilestone->released_date))
                    <div class="row">
                        {!! Form::model($releaseMilestone, ['route' => ['releaseMilestones.update', $releaseMilestone->id], 'method' => 'patch']) !!}

                                @include('release_milestones.fields')

                        {!! Form::close() !!}
                    </div>
                @else
                    <div class="alert alert-info" role="alert">
                        <strong>INFO:</strong> Release milestones are not editable onec the release is done.
                    </div>
                @endif
            @else
            <div class="alert alert-warning" role="alert">
                <strong>WARNING:</strong> You don't have permission to access this page.
            </div>
            @endcan
           </div>

        </div>
       </div>
   </div>
@endsection