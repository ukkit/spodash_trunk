<?php

 function convertDate($date) {
    if (is_null($date)) {
        $value = null;
    } else {
        $value = Carbon\Carbon::parse($date)->format('d-M-Y');
    }
    return $value;
}

$start_sprint = $releaseMilestone->sprint_by_date($releaseMilestone->release_start_date);
$end_sprint = $releaseMilestone->sprint_by_date($releaseMilestone->release_end_date);

?>
<div class="col-md-10 col-md-offset-1">
    <table class="table table-condensed table-super-condensed table-bordered" id="release-milestone-details">
        <thead>
            <tr>
                <th style="width: 30%">Milestones</th>
                <th class="text-center" style="width: 20%">Start</th>
                <th class="text-center" style="width: 20%">End</th>
                <th class="text-center" style="width: 50%">Notes</th>
            </tr>
        </thead>
        <tr class="heavy">
            <td class="milestone_tbl_label">Release Start Date</td>
            <td class="milestone_tbl_normal" colspan="2">{{ convertDate($releaseMilestone->release_start_date) }}</td>
            <td class="milestone_tbl_normal"></td>
        </tr>

        @if((!is_null($releaseMilestone->baseline_start_date)) or (!is_null($releaseMilestone->baseline_end_date)))
        <tr>
            <td class="milestone_tbl_label">Finalize Baseline</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->baseline_start_date) }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->baseline_end_date) }}</td>
            <td class="milestone_tbl_normal">{{ $releaseMilestone->baseline_comments }}</td>
        </tr>
        @endif
        @php
        for ($st = $start_sprint; $st < $end_sprint; $st++) {
            $st_date = $releaseMilestone->sprint_details_by_number($st)->sprint_start_date;
            $ed_date = $releaseMilestone->sprint_details_by_number($st)->sprint_end_date;
        @endphp
        <tr class="lightgray_bkgd">
            <td class="milestone_tbl_label">Sprint {{ $st }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($st_date) }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($ed_date) }}</td>
            <td class="milestone_tbl_normal"></td>
        </tr>
        @php
        }
        @endphp
        @if((!is_null($releaseMilestone->content_complete_start_date)) or (!is_null($releaseMilestone->content_complete_end_date)))
        <tr class="greenyellow_bkgb">
            <td class="milestone_tbl_label">CCO (Content Complete)</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->content_complete_start_date) }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->content_complete_end_date) }}</td>
            <td class="milestone_tbl_normal">{{ $releaseMilestone->content_complete_comments }}</td>
        </tr>
        @endif
        @if((!is_null($releaseMilestone->regressions_start_date)) or (!is_null($releaseMilestone->regressions_end_date)))
        <tr>
            <td class="milestone_tbl_label">Regression Testing</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->regressions_start_date) }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->regressions_end_date) }}</td>
            <td class="milestone_tbl_normal">{{ $releaseMilestone->regressions_comments }}</td>
        </tr>
        @endif
        @if((!is_null($releaseMilestone->enablement_delivery_start_date)) or (!is_null($releaseMilestone->enablement_delivery_end_date)))
        <tr>
            <td class="milestone_tbl_label">Deliver list of TS/GS Enablement Topics</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->enablement_delivery_start_date) }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->enablement_delivery_end_date) }}</td>
            <td class="milestone_tbl_normal">{{ $releaseMilestone->enablement_delivery_comments }}</td>
        </tr>
        @endif
        @if(!is_null($releaseMilestone->pre_release_1_date))
        <tr class="greenyellow_bkgb">
            <td class="milestone_tbl_label">Pre-Release 1</td>
            <td class="milestone_tbl_normal"></td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->pre_release_1_date) }}</td>
            <td class="milestone_tbl_normal">{{ $releaseMilestone->pre_release_1_comments }}</td>
        </tr>
        @endif
        @if(!is_null($releaseMilestone->pre_release_2_date))
            <tr class="greenyellow_bkgb heavy">
                <td class="milestone_tbl_label">Pre-Release 2</td>
                <td class="milestone_tbl_normal"></td>
                <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->pre_release_2_date) }}</td>
                <td class="milestone_tbl_normal">{{ $releaseMilestone->pre_release_2_comments }}</td>
            </tr>
        @endif
        @if(!is_null($releaseMilestone->pre_release_3_date))
            <tr class="greenyellow_bkgb heavy">
                <td class="milestone_tbl_label">Pre-Release 3</td>
                <td class="milestone_tbl_normal"></td>
                <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->pre_release_3_date) }}</td>
                <td class="milestone_tbl_normal">{{ $releaseMilestone->pre_release_3_comments }}</td>
            </tr>
        @endif
        @if(!is_null($releaseMilestone->pre_release_4_date))
            <tr class="greenyellow_bkgb heavy">
                <td class="milestone_tbl_label">Pre-Release 4</td>
                <td class="milestone_tbl_normal"></td>
                <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->pre_release_4_date) }}</td>
                <td class="milestone_tbl_normal">{{ $releaseMilestone->pre_release_4_comments }}</td>
            </tr>
        @endif
        @if((!is_null($releaseMilestone->localization_start_date)) or (!is_null($releaseMilestone->localization_end_date)))
        <tr>
            <td class="milestone_tbl_label">Localization Testing</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->localization_start_date) }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->localization_end_date) }}</td>
            <td class="milestone_tbl_normal">{{ $releaseMilestone->localization_comments }}</td>
        </tr>
        @endif
        @if((!is_null($releaseMilestone->contrast_scan_start_date)) or (!is_null($releaseMilestone->contrast_scan_end_date)))
        <tr>
            <td class="milestone_tbl_label">Security Scans</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->contrast_scan_start_date) }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->contrast_scan_end_date) }}</td>
            <td class="milestone_tbl_normal">{{ $releaseMilestone->contrast_scan_comments }}</td>
        </tr>
        @endif
        @if((!is_null($releaseMilestone->owasp_scan_start_date)) or (!is_null($releaseMilestone->owasp_scan_end_date)))
        <tr>
            <td class="milestone_tbl_label">Security Scans</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->owasp_scan_start_date) }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->owasp_scan_end_date) }}</td>
            <td class="milestone_tbl_normal">{{ $releaseMilestone->owasp_scan_comments }}</td>
        </tr>
        @endif
        @if((!is_null($releaseMilestone->webinspect_scan_start_date)) or (!is_null($releaseMilestone->webinspect_scan_end_date)))
        <tr>
            <td class="milestone_tbl_label">Security Scans</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->webinspect_scan_start_date) }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->webinspect_scan_end_date) }}</td>
            <td class="milestone_tbl_normal">{{ $releaseMilestone->webinspect_scan_comments }}</td>
        </tr>
        @endif
        @if(!is_null($releaseMilestone->release_branch_creation_date))
        <tr>
            <td class="milestone_tbl_label">Release Branch</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->release_branch_creation_date) }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->release_branch_creation_date) }}</td>
            {{-- <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->release_branch_creation_date) }}</td> --}}
            <td class="milestone_tbl_normal">{{ $releaseMilestone->release_branch_creation_comments }}</td>
        </tr>
        @endif
        @if((!is_null($releaseMilestone->documentation_start_date)) or (!is_null($releaseMilestone->documentation_end_date)))
        <tr  class="lightgreen_bkgd">
            <td class="milestone_tbl_label">Release Documentation</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->documentation_start_date) }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->documentation_end_date) }}</td>
            <td class="milestone_tbl_normal">{{ $releaseMilestone->documentation_comments }}</td>
        </tr>
        @endif
        @if(!is_null($releaseMilestone->code_freeze_date))
        <tr  class="lightgreen_bkgd">
            <td class="milestone_tbl_label">Code Freeze</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->code_freeze_date) }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->code_freeze_date) }}</td>
            <td class="milestone_tbl_normal">{{ $releaseMilestone->code_freeze_comments }}</td>
        </tr>
        @endif
        @if(!is_null($releaseMilestone->release_candidate_date))
        <tr>
            <td class="milestone_tbl_label">Release Candidate Build</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->release_candidate_date) }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->release_candidate_date) }}</td>
            <td class="milestone_tbl_normal">{{ $releaseMilestone->release_candidate_comments }}</td>
        </tr>
        @endif
        @if(!is_null($releaseMilestone->final_qa_date))
        <tr class="lightgreen_bkgd">
            <td class="milestone_tbl_label">Final QA</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->final_qa_date) }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->final_qa_date) }}</td>
            <td class="milestone_tbl_normal">{{ $releaseMilestone->final_qa_comments }}</td>
        </tr>
        @endif
        @if(!is_null($releaseMilestone->release_build_date))
        <tr>
            <td class="milestone_tbl_label">Release Build and Verification</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->release_build_date) }}</td>
            <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->release_build_date) }}</td>
            <td class="milestone_tbl_normal">{{ $releaseMilestone->release_build_comments }}</td>
        </tr>
        @endif
        <tr class="green_bkgd heavy white_font">
            @if(is_null($releaseMilestone->released_date))
                <td class="milestone_tbl_label">RTM Target Date</td>
            @else
                <td class="milestone_tbl_label">RTM Date</td>
            @endif
            <td class="milestone_tbl_normal"></td>
            <td class="milestone_tbl_normal float-right" colspan="2">{{ convertDate($releaseMilestone->release_end_date) }}</td>
            {{-- <td class="milestone_tbl_normal"></td> --}}
        </tr>
        @if(!is_null($releaseMilestone->milestone_notes))
        <tr>
            <td class="milestone_tbl_label">Notes</td>
            <td class="milestone_tbl_normal" colspan="2">{{ $releaseMilestone->milestone_notes }}</td>
            {{-- <td class="milestone_tbl_normal">{{ convertDate($releaseMilestone->release_build_date) }}</td> --}}
            {{-- <td class="milestone_tbl_normal"></td> --}}
        </tr>
        @endif
    </table>
</div>

{{-- <td>{!! Carbon\Carbon::parse($actionHistory->start_time)->toDateTimeString() !!} IST</td> --}}

{{--
<!-- Release Numbers Id Field -->
<div class="form-group">
    {!! Form::label('release_numbers_id', 'Release Numbers Id:') !!}
    <p>{{ $releaseMilestone->release_numbers_id }}</p>
</div>


<!-- Release End Date Field -->
<div class="form-group">
    {!! Form::label('release_end_date', 'Release End Date:') !!}
    <p>{{ $releaseMilestone->release_end_date }}</p>
</div>



<!-- Number Of Sprints Field -->
<div class="form-group">
    {!! Form::label('number_of_sprints', 'Number Of Sprints:') !!}
    <p>{{ $releaseMilestone->number_of_sprints }}</p>
</div>


<!-- Regressions Start Date Field -->
<div class="form-group">
    {!! Form::label('regressions_start_date', 'Regressions Start Date:') !!}
    <p>{{ $releaseMilestone->regressions_start_date }}</p>
</div>

<!-- Regressions End Date Field -->
<div class="form-group">
    {!! Form::label('regressions_end_date', 'Regressions End Date:') !!}
    <p>{{ $releaseMilestone->regressions_end_date }}</p>
</div>

<!-- Enablement Delivery Field -->
<div class="form-group">
    {!! Form::label('enablement_delivery', 'Enablement Delivery:') !!}
    <p>{{ $releaseMilestone->enablement_delivery }}</p>
</div>

<!-- Enablement Delivery Start Date Field -->
<div class="form-group">
    {!! Form::label('enablement_delivery_start_date', 'Enablement Delivery Start Date:') !!}
    <p>{{ $releaseMilestone->enablement_delivery_start_date }}</p>
</div>

<!-- Enablement Delivery End Date Field -->
<div class="form-group">
    {!! Form::label('enablement_delivery_end_date', 'Enablement Delivery End Date:') !!}
    <p>{{ $releaseMilestone->enablement_delivery_end_date }}</p>
</div>

<!-- Localization Review Field -->
<div class="form-group">
    {!! Form::label('localization_review', 'Localization Review:') !!}
    <p>{{ $releaseMilestone->localization_review }}</p>
</div>

<!-- Localization Start Date Field -->
<div class="form-group">
    {!! Form::label('localization_start_date', 'Localization Start Date:') !!}
    <p>{{ $releaseMilestone->localization_start_date }}</p>
</div>

<!-- Localization End Date Field -->
<div class="form-group">
    {!! Form::label('localization_end_date', 'Localization End Date:') !!}
    <p>{{ $releaseMilestone->localization_end_date }}</p>
</div>

<!-- Run Security Scan Field -->
<div class="form-group">
    {!! Form::label('run_security_scan', 'Run Security Scan:') !!}
    <p>{{ $releaseMilestone->run_security_scan }}</p>
</div>

<!-- Security Scan Start Date Field -->
<div class="form-group">
    {!! Form::label('security_scan_start_date', 'Security Scan Start Date:') !!}
    <p>{{ $releaseMilestone->security_scan_start_date }}</p>
</div>

<!-- Security Scan End Date Field -->
<div class="form-group">
    {!! Form::label('security_scan_end_date', 'Security Scan End Date:') !!}
    <p>{{ $releaseMilestone->security_scan_end_date }}</p>
</div>

<!-- Release Branch Creation Date Field -->
<div class="form-group">
    {!! Form::label('release_branch_creation_date', 'Release Branch Creation Date:') !!}
    <p>{{ $releaseMilestone->release_branch_creation_date }}</p>
</div>

<!-- Documentation Start Date Field -->
<div class="form-group">
    {!! Form::label('documentation_start_date', 'Documentation Start Date:') !!}
    <p>{{ $releaseMilestone->documentation_start_date }}</p>
</div>

<!-- Documentation End Date Field -->
<div class="form-group">
    {!! Form::label('documentation_end_date', 'Documentation End Date:') !!}
    <p>{{ $releaseMilestone->documentation_end_date }}</p>
</div>

<!-- Code Freeze Date Field -->
<div class="form-group">
    {!! Form::label('code_freeze_date', 'Code Freeze Date:') !!}
    <p>{{ $releaseMilestone->code_freeze_date }}</p>
</div>

<!-- Release Candidate Date Field -->
<div class="form-group">
    {!! Form::label('release_candidate_date', 'Release Candidate Date:') !!}
    <p>{{ $releaseMilestone->release_candidate_date }}</p>
</div>

<!-- Final Qa Date Field -->
<div class="form-group">
    {!! Form::label('final_qa_date', 'Final Qa Date:') !!}
    <p>{{ $releaseMilestone->final_qa_date }}</p>
</div>

<!-- Release Build Date Field -->
<div class="form-group">
    {!! Form::label('release_build_date', 'Release Build Date:') !!}
    <p>{{ $releaseMilestone->release_build_date }}</p>
</div>

<!-- Has Pre Release Field -->
<div class="form-group">
    {!! Form::label('has_pre_release', 'Has Pre Release:') !!}
    <p>{{ $releaseMilestone->has_pre_release }}</p>
</div>

<!-- Pre Release 1 Date Field -->
<div class="form-group">
    {!! Form::label('pre_release_1_date', 'Pre Release 1 Date:') !!}
    <p>{{ $releaseMilestone->pre_release_1_date }}</p>
</div>

<!-- Has Pre Release 2 Field -->
<div class="form-group">
    {!! Form::label('has_pre_release_2', 'Has Pre Release 2:') !!}
    <p>{{ $releaseMilestone->has_pre_release_2 }}</p>
</div>

<!-- Pre Release 2 Date Field -->
<div class="form-group">
    {!! Form::label('pre_release_2_date', 'Pre Release 2 Date:') !!}
    <p>{{ $releaseMilestone->pre_release_2_date }}</p>
</div>

<!-- Has Pre Release 3 Field -->
<div class="form-group">
    {!! Form::label('has_pre_release_3', 'Has Pre Release 3:') !!}
    <p>{{ $releaseMilestone->has_pre_release_3 }}</p>
</div>

<!-- Pre Release 3 Date Field -->
<div class="form-group">
    {!! Form::label('pre_release_3_date', 'Pre Release 3 Date:') !!}
    <p>{{ $releaseMilestone->pre_release_3_date }}</p>
</div>

<!-- Has Pre Release 4 Field -->
<div class="form-group">
    {!! Form::label('has_pre_release_4', 'Has Pre Release 4:') !!}
    <p>{{ $releaseMilestone->has_pre_release_4 }}</p>
</div>

<!-- Pre Release 4 Date Field -->
<div class="form-group">
    {!! Form::label('pre_release_4_date', 'Pre Release 4 Date:') !!}
    <p>{{ $releaseMilestone->pre_release_4_date }}</p>
</div>

<!-- Released Date Field -->
<div class="form-group">
    {!! Form::label('released_date', 'Released Date:') !!}
    <p>{{ $releaseMilestone->released_date }}</p>
</div>
 --}}
