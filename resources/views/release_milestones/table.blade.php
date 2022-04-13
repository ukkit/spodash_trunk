<?php

$active_rel = null;
$old_rel = null;

foreach($releaseMilestones as $rM) {
    if(is_null($rM->released_date)) {
        $active_rel = True;
    } else {
        $old_rel = True;
    }
}

if ((is_null($active_rel) AND is_null($old_rel))) {
    echo "<div class=\"alert alert-info\" role=\"alert\">";
    echo "<strong>INFO!</strong> No data to display.";
    echo "</div>";
} else {
?>
@if(!is_null($active_rel))
<table class="table table-25percent table-condensed table-bordered table-responsive" id="release-milestone-table">
    <thead>
        <th class="text-center">Active Release(s)</th>
    </thead>
    <tbody>
        @foreach($releaseMilestones as $releaseMilestone)
            @if(is_null($releaseMilestone->released_date))
            <tr>
                <td class="text-center">
                    <a href="{{ route('releaseMilestones.show', [$releaseMilestone->id]) }}" class="btn btn-default lightgreen_bkgd btn-group-justified">
                        <special>{!! $releaseMilestone->product_name_by_id($releaseMilestone->release_numbers_id,'product_short_name')->get('0') !!}
                        {!! $releaseMilestone->release_number_by_id($releaseMilestone->release_numbers_id)->release_number !!}</special>
                        <small> /{!! Carbon\Carbon::parse($releaseMilestone->release_end_date)->format('d-M-Y') !!}</small>
                    </a>
                </td>
            </tr>
            @else
            @endif
        @endforeach
    </tbody>
</table>
@endif
@if(!is_null($old_rel))
<br>
<table class="table table-25percent table-condensed table-bordered table-responsive" id="release-milestone-table">
    <thead>
        <th class="text-center">Old Release(s)</th>
    </thead>
    <tbody>
        @foreach($releaseMilestones as $releaseMilestone)
            @if(!is_null($releaseMilestone->released_date))
            <tr>
                <td class="text-center">
                    <a href="{{ route('releaseMilestones.show', [$releaseMilestone->id]) }}" class="btn btn-default btn-group-justified">
                        {!! $releaseMilestone->product_name_by_id($releaseMilestone->release_numbers_id,'product_short_name')->get('0') !!} {!! $releaseMilestone->release_number_by_id($releaseMilestone->release_numbers_id)->release_number !!}
                        <xsmall> {!! Carbon\Carbon::parse($releaseMilestone->release_end_date)->format('d-M-Y') !!}</xsmall>
                    </a>
                </td>
            </tr>
            @else
            @endif
        @endforeach
    </tbody>
</table>
@endif
<?php
}

?>
