<?php

$total_pass = 0;
$total_fail = 0;
$total_time = array();

function add_hours($array) {
    $returnVal = Null;
    $sum=0;
    $hours=0;
    $minutes=0;
    $seconds=0;
    $fgsum=0;
    if(count($array) > 0) {
        foreach ($array as $fval) {
            $exploded = explode(':',$fval);
            $sum = $exploded[0]*60*60 + $exploded[1]*60 + $exploded[2];
            $fgsum = $fgsum + $sum;
        }
        if ($fgsum < 24 * 60 * 60) {
            $returnVal = gmdate('H:i:s', $fgsum);
        } else {
            $hours = floor($fgsum / 3600);
            $minutes = floor(($fgsum - $hours * 3600) / 60);
            $seconds = floor($fgsum - ($hours * 3600) - ($minutes * 60));
            $returnVal = "$hours:$minutes:$seconds";
        }
    }
    echo $returnVal;
}
$updated = Null;

?>

<div class="table-responsive">
    <table class="table table-responsive table-condensed table-hover" id="action-data-table">
        <thead>
            <th>Action Name</th>
            <th>Pass Count</th>
            <th>Fail Count</th>
            <th>Total Count</th>
            <th>Success %</th>
            <th class="text-right">Total Time (Success)</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($actionData as $action)
                <tr>
                    <td>
                        @php
                        $action_name = get_action_text($action->action_name);
                        echo strtoupper($action_name);
                        $total_pass += $action->pass_count;
                        $total_fail += $action->fail_count;
                        array_push($total_time, $action->total_time);
                        $updated = $action->created_at;
                        @endphp
                    </td>
                    <td>{{ $action->pass_count }}</td>
                    <td>{{ $action->fail_count }}</td>
                    <td>{!! $action->pass_count + $action->fail_count !!}</td>
                    <td >
                        @php
                        try {
                            $passperc = ($action->pass_count / ($action->pass_count + $action->fail_count)) * 100;
                            echo number_format((float)$passperc, 2, '.', '')." %";
                        } catch (\Throwable $th) {
                            //throw $th;
                        }

                        @endphp
                    </td>
                    <td class="text-right">{{ $action->total_time }}</td>
                    <td></td>
                </tr>
            @endforeach
            <tr class="strong">
                <td>GRAND TOTAL</td>
                <td>{{ $total_pass }}</td>
                <td>{{ $total_fail }}</td>
                <td> {{ $total_pass + $total_fail }}</td>
                <td>
                    @php
                    $passperc = $total_pass / ($total_pass + $total_fail) * 100;
                    echo number_format((float)$passperc, 2, '.', '')." %";
                    @endphp
                </td>
                <td class="text-right">{{ add_hours($total_time) }}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="6" class="text-right">
                    <p class="afblue">Updated: {{ $updated }}</p>
                </td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
