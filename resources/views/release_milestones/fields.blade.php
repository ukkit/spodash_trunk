<div class="col-md-10 col-md-offset-1">
    <table class="table table-condensed table-super-condensed table-bordered" id="release-milestone-fields">

        @if($this_is_edit)
        <thead>
            <tr>
            <th style="width: 40%">Milestones</th>
            <th class="text-center" style="width: 20%">Start</th>
            <th class="text-center" style="width: 20%">End</th>
            <th class="text-center" style="width: 40%">Notes</th>
            </tr>
        </thead>
        @endif
        <tbody>
            @if($this_is_edit)
                <input type="hidden" id="release_numbers_id" name="release_numbers_id" value={!! $releaseMilestone->release_numbers_id !!}>
            @else
            <tr>
                <td class="milestone_tbl_label">Release Number</td>
                <td class="milestone_tbl_normal">
                    <select name="release_numbers_id" class="form-control select-version width200px">
                        <option value="">Select .... </option>
                        @foreach($release_number as $prv)
                            <option value="{{ $prv->id }}"> {{App\Models\Release_milestone::product_name_by_id($prv->product_names_id,'product_short_name')->get('0')}} {{ $prv->release_number }} </option>
                        @endforeach
                    </select>
                </td>
                @if($this_is_edit)
                <td></td>
                @endif
            </tr>
            @endif

        <tr class="heavy">
            <td class="milestone_tbl_label">Release Start Date</td>
            <td class="milestone_tbl_normal">
                <div class="input-group date">
                    @if($this_is_edit)
                        @hasanyrole('admin|superadmin')
                        {!! Form::date('release_start_date', $releaseMilestone->release_start_date, ['value'=>$releaseMilestone->release_start_date, 'class' => 'form-control-milestone-calendar','id'=>'release_start_date']) !!}
                        @else
                        {!! Form::date('release_start_date', $releaseMilestone->release_start_date, ['value'=>$releaseMilestone->release_start_date, 'class' => 'form-control-milestone-calendar','id'=>'release_start_date', 'disabled'=>'disabled']) !!}
                        @endhasanyrole
                    @else
                    {!! Form::date('release_start_date', null, ['class' => 'form-control-milestone-calendar','id'=>'release_start_date']) !!}
                    @endif
                </div>
            </td>
            @if($this_is_edit)
            <td class="milestone_tbl_normal"></td>
            <td class="milestone_tbl_normal"></td>
            @endif
        </tr>

        {{-- BELOW ARE DISPLAYED ONLY WHEN MILESTONES ARE EDITED --}}

        @if($this_is_edit)

            {{-- Baseline Start and End --}}
            <tr>
                <td class="milestone_tbl_label">Finalize Baseline</td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('baseline_start_date', $releaseMilestone->baseline_start_date, ['value'=>$releaseMilestone->baseline_start_date, 'class' => 'form-control-milestone-calendar','id'=>'baseline_start_date']) !!}
                </td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('baseline_end_date', $releaseMilestone->baseline_end_date, ['value'=>$releaseMilestone->baseline_end_date, 'class' => 'form-control-milestone-calendar','id'=>'baseline_end_date']) !!}
                </td>
                <td>
                    {{-- {!! Form::text('baseline_comments', null, ['class' => 'form-control', 'rows' => 1, 'size' => 100,  'placeholder' => 'notes']) !!} --}}
                    {!! Form::text('baseline_comments', null, ['class' => 'form-control']) !!}
                </td>
            </tr>

            {{-- Content Complete Start and End --}}
            <tr class="greenyellow_bkgb">
                <td class="milestone_tbl_label">CCO (Content Complete)</td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('content_complete_start_date', $releaseMilestone->content_complete_start_date, ['value'=>$releaseMilestone->content_complete_start_date, 'class' => 'form-control-milestone-calendar','id'=>'content_complete_start_date']) !!}
                </td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('content_complete_end_date', $releaseMilestone->content_complete_end_date, ['value'=>$releaseMilestone->content_complete_end_date, 'class' => 'form-control-milestone-calendar','id'=>'content_complete_end_date']) !!}
                </td>
                <td>{!! Form::text('content_complete_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>

            {{-- Regression Testing Start and End --}}
            <tr>
                <td class="milestone_tbl_label">Regression Testing</td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('regressions_start_date', $releaseMilestone->regressions_start_date, ['value'=>$releaseMilestone->regressions_start_date, 'class' => 'form-control-milestone-calendar','id'=>'regressions_start_date']) !!}
                </td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('regressions_end_date', $releaseMilestone->regressions_end_date, ['value'=>$releaseMilestone->regressions_end_date, 'class' => 'form-control-milestone-calendar','id'=>'regressions_end_date']) !!}
                </td>
                <td>{!! Form::text('regressions_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>


            {{-- Enablement Start and End --}}
            <tr>
                <td class="milestone_tbl_label">Deliver list of TS/GS Enablement Topics</td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('enablement_delivery_start_date', $releaseMilestone->enablement_delivery_start_date, ['value'=>$releaseMilestone->enablement_delivery_start_date, 'class' => 'form-control-milestone-calendar','id'=>'enablement_delivery_start_date']) !!}
                </td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('enablement_delivery_end_date', $releaseMilestone->enablement_delivery_end_date, ['value'=>$releaseMilestone->enablement_delivery_end_date, 'class' => 'form-control-milestone-calendar','id'=>'enablement_delivery_end_date']) !!}
                </td>
                <td>{!! Form::text('enablement_delivery_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>

            {{-- Pre-Release 1 Date --}}
            <tr class="greenyellow_bkgb">
                <td class="milestone_tbl_label">Pre-Release 1</td>
                <td class="milestone_tbl_normal"></td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('pre_release_1_date', $releaseMilestone->pre_release_1_date, ['value'=>$releaseMilestone->pre_release_1_date, 'class' => 'form-control-milestone-calendar','id'=>'pre_release_1_date']) !!}
                </td>
                <td>{!! Form::text('pre_release_1_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>

            {{-- Pre-Release 2 Date --}}
            <tr class="greenyellow_bkgb">
                <td class="milestone_tbl_label">Pre-Release 2</td>
                <td class="milestone_tbl_normal"></td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('pre_release_2_date', $releaseMilestone->pre_release_2_date, ['value'=>$releaseMilestone->pre_release_2_date, 'class' => 'form-control-milestone-calendar','id'=>'pre_release_2_date']) !!}
                </td>
                <td>{!! Form::text('pre_release_2_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>

            @hasanyrole('admin|superadmin')
            {{-- Pre-Release 3 Date --}}
            <tr class="greenyellow_bkgb">
                <td class="milestone_tbl_label">Pre-Release 3</td>
                <td class="milestone_tbl_normal"></td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('pre_release_3_date', $releaseMilestone->pre_release_3_date, ['value'=>$releaseMilestone->pre_release_3_date, 'class' => 'form-control-milestone-calendar','id'=>'pre_release_3_date']) !!}
                </td>
                <td>{!! Form::text('pre_release_3_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>

            {{-- Pre-Release 4 Date --}}
            <tr class="greenyellow_bkgb">
                <td class="milestone_tbl_label">Pre-Release 4</td>
                <td class="milestone_tbl_normal"></td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('pre_release_4_date', $releaseMilestone->pre_release_4_date, ['value'=>$releaseMilestone->pre_release_4_date, 'class' => 'form-control-milestone-calendar','id'=>'pre_release_4_date']) !!}
                </td>
                <td>{!! Form::text('pre_release_4_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>
            @endhasanyrole

            {{-- Localization Testing Start and End --}}
            <tr>
                <td class="milestone_tbl_label">Localization Testing</td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('localization_start_date', $releaseMilestone->localization_start_date, ['value'=>$releaseMilestone->localization_start_date, 'class' => 'form-control-milestone-calendar','id'=>'localization_start_date']) !!}
                </td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('localization_end_date', $releaseMilestone->localization_end_date, ['value'=>$releaseMilestone->localization_end_date, 'class' => 'form-control-milestone-calendar','id'=>'localization_end_date']) !!}
                </td>
                <td>{!! Form::text('localization_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>

            {{-- Contrast Scan Start and End --}}
            <tr>
                <td class="milestone_tbl_label">Contrast Security Scan</td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('contrast_scan_start_date', $releaseMilestone->contrast_scan_start_date, ['value'=>$releaseMilestone->contrast_scan_start_date, 'class' => 'form-control-milestone-calendar','id'=>'contrast_scan_start_date']) !!}
                </td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('contrast_scan_end_date', $releaseMilestone->contrast_scan_end_date, ['value'=>$releaseMilestone->contrast_scan_end_date, 'class' => 'form-control-milestone-calendar','id'=>'contrast_scan_end_date']) !!}
                </td>
                <td>{!! Form::text('contrast_scan_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>

            {{-- OWASP Scan Start and End --}}
            <tr>
                <td class="milestone_tbl_label">OWASP Security Scan</td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('owasp_scan_start_date', $releaseMilestone->owasp_scan_start_date, ['value'=>$releaseMilestone->owasp_scan_start_date, 'class' => 'form-control-milestone-calendar','id'=>'owasp_scan_start_date']) !!}
                </td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('owasp_scan_end_date', $releaseMilestone->owasp_scan_end_date, ['value'=>$releaseMilestone->owasp_scan_end_date, 'class' => 'form-control-milestone-calendar','id'=>'owasp_scan_end_date']) !!}
                </td>
                <td>{!! Form::text('owasp_scan_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>

            {{-- WebInsect Scan Start and End --}}
            <tr>
                <td class="milestone_tbl_label">WebInspect Security Scan</td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('webinspect_scan_start_date', $releaseMilestone->webinspect_scan_start_date, ['value'=>$releaseMilestone->webinspect_scan_start_date, 'class' => 'form-control-milestone-calendar','id'=>'webinspect_scan_start_date']) !!}
                </td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('webinspect_scan_end_date', $releaseMilestone->webinspect_scan_end_date, ['value'=>$releaseMilestone->webinspect_scan_end_date, 'class' => 'form-control-milestone-calendar','id'=>'webinspect_scan_end_date']) !!}
                </td>
                <td>{!! Form::text('webinspect_scan_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>

            {{-- Release Branch Creation Date --}}
            <tr>
                <td class="milestone_tbl_label">Release Branch</td>
                <td class="milestone_tbl_normal">
                </td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('release_branch_creation_date', $releaseMilestone->release_branch_creation_date, ['value'=>$releaseMilestone->release_branch_creation_date, 'class' => 'form-control-milestone-calendar','id'=>'release_branch_creation_date']) !!}
                </td>
                <td>{!! Form::text('release_branch_creation_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>

            {{-- Documentation Start and End --}}
            <tr  class="lightgreen_bkgd">
                <td class="milestone_tbl_label">Release Documentation</td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('documentation_start_date', $releaseMilestone->documentation_start_date, ['value'=>$releaseMilestone->documentation_start_date, 'class' => 'form-control-milestone-calendar','id'=>'documentation_start_date']) !!}
                </td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('documentation_end_date', $releaseMilestone->documentation_end_date, ['value'=>$releaseMilestone->documentation_end_date, 'class' => 'form-control-milestone-calendar','id'=>'documentation_end_date']) !!}
                </td>
                <td>{!! Form::text('documentation_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>

            {{-- Code Freeze Date --}}
            <tr class="lightgreen_bkgd">
                <td class="milestone_tbl_label">Code Freeze</td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('code_freeze_date', $releaseMilestone->code_freeze_date, ['value'=>$releaseMilestone->code_freeze_date, 'class' => 'form-control-milestone-calendar','id'=>'code_freeze_date']) !!}
                </td>
                <td class="milestone_tbl_normal"></td>
                <td>{!! Form::text('code_freeze_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>

            {{-- Release Candidate Build Date --}}
            <tr>
                <td class="milestone_tbl_label">Release Candidate Build</td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('release_candidate_date', $releaseMilestone->release_candidate_date, ['value'=>$releaseMilestone->release_candidate_date, 'class' => 'form-control-milestone-calendar','id'=>'release_candidate_date']) !!}
                </td>
                <td class="milestone_tbl_normal">
                </td>
                <td>{!! Form::text('release_candidate_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>

            {{-- Final QA Date --}}
            <tr class="lightgreen_bkgd">
                <td class="milestone_tbl_label">Final QA</td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('final_qa_date', $releaseMilestone->final_qa_date, ['value'=>$releaseMilestone->final_qa_date, 'class' => 'form-control-milestone-calendar','id'=>'final_qa_date']) !!}
                </td>
                <td class="milestone_tbl_normal"></td>
                <td>{!! Form::text('final_qa_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>

            {{-- Release Build and Verification Date --}}
            <tr>
                <td class="milestone_tbl_label">Release Build and Verification</td>
                <td class="milestone_tbl_normal">
                    {!! Form::date('release_build_date', $releaseMilestone->release_build_date, ['value'=>$releaseMilestone->release_build_date, 'class' => 'form-control-milestone-calendar','id'=>'release_build_date']) !!}
                </td>
                <td class="milestone_tbl_normal"></td>
                <td>{!! Form::text('release_build_comments', null, ['class' => 'form-control']) !!}</td>
            </tr>
        @endif

        @if($this_is_edit)
        <tr>
            <td class="milestone_tbl_label">Notes</td>
            <td colspan="3">
                <div class="form-group">
                    {{-- {!! Form::label('milestone_notes', 'Notes:') !!} --}}
                    {!! Form::textarea('milestone_notes', null, ['class' => 'form-control', 'rows' => 2, 'placeholder' => 'Optional']) !!}
                </div>
            </td>
            {{-- <td></td> --}}
        </tr>
        @endif

        @if($this_is_edit)
        <tr class="green_bkgd heavy">
        @else
        <tr class="heavy">
        @endif
            <td class="milestone_tbl_label">RTM Target Date</td>
            @if($this_is_edit)
            <td class="milestone_tbl_normal"></td>
            @endif
            <td class="milestone_tbl_normal">
                <div class="input-group date">
                    @if($this_is_edit)
                    {!! Form::date('release_end_date', $releaseMilestone->release_end_date, ['value'=>$releaseMilestone->release_end_date, 'class' => 'form-control-milestone-calendar','id'=>'release_end_date']) !!}
                    @else
                    {!! Form::date('release_end_date', null, ['class' => 'form-control-milestone-calendar','id'=>'release_end_date']) !!}
                    @endif
                </div>
            </td>
            @if($this_is_edit)
            <td></td>
            @endif
        </tr>


        @if($this_is_edit)
        @php
            $todate = Carbon\Carbon::now()->format('d-M-Y');
        @endphp
            @hasanyrole('admin|superadmin')
            <tr class="heavy">
                <td class="milestone_tbl_label">Release Close Date</td>
                @if($this_is_edit)
                <td class="milestone_tbl_normal"></td>
                @endif
                <td class="milestone_tbl_normal">
                    <div class="input-group date">
                        @if($this_is_edit)
                            @if ($releaseMilestone->release_end_date >= $todate)
                                {!! Form::date('released_date', $releaseMilestone->released_date, ['value'=>$releaseMilestone->released_date, 'class' => 'form-control-milestone-calendar','id'=>'released_date']) !!}
                                @else
                                {!! Form::date('released_date', null, ['class' => 'form-control-milestone-calendar','id'=>'released_date', 'disabled' => 'disabled']) !!}
                                @endif
                        @else
                        {!! Form::date('released_date', null, ['class' => 'form-control-milestone-calendar','id'=>'released_date']) !!}
                        @endif
                    </div>
                </td>
                <td></td>
            </tr>
            @endhasanyrole
        @endif
        </tbody>
    </table>
</div>
</div>

<div class="box-footer text-center">
    @can('edit_releaseDetails')
    <div class="btn-group" role="group" aria-label="...">
        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    </div>
    &nbsp;&nbsp;
    @endcan
    <div class="btn-group" role="group" aria-label="...">
        <a href="{{ route('releaseMilestones.index') }}" class="btn btn-group btn-default">Cancel</a>
    </div>

</div>