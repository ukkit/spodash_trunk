<div class="table-responsive">
    <table class="table table-responsive table-condensed table-hover" id="action-data-table">
        <thead>
            <tr>
                <th rowspan="2" class="text-center">Time Period</th>
                <th colspan="3" class="text-center">SPM Upgrade</th>
                <th colspan="3" class="text-center">PAI Upgrade</th>
                <th colspan="3" class="text-center">SPM & PAI Upgrade</th>
                <th colspan="3" class="text-center">App Start</th>
                <th colspan="3" class="text-center">App Shutdown</th>
                <th colspan="3" class="text-center">App Restart</th>
                <th rowspan="2" class="text-center">Total Time (hh:mm:ss)</th>
            </tr>
            <tr>
                <th class="text-center"><i class="fas fa-check" title="Pass count"></i></th>
                <th class="text-center"><i class="fas fa-times" title="Failed Count"></i></th>
                <th class="text-center"><i class="far fa-clock" title="Total Hours for Passed Actions"></i></th>
                {{-- <th class="text-center"><i class="fas fa-history" title="Total Hours for Failed Actions"></i></th> --}}
                <th class="text-center"><i class="fas fa-check" title="Pass count"></i></th>
                <th class="text-center"><i class="fas fa-times" title="Failed Count"></i></th>
                <th class="text-center"><i class="far fa-clock" title="Total Hours for Passed Actions"></i></th>
                {{-- <th class="text-center"><i class="fas fa-history" title="Total Hours for Failed Actions"></i></th> --}}
                <th class="text-center"><i class="fas fa-check" title="Pass count"></i></th>
                <th class="text-center"><i class="fas fa-times" title="Failed Count"></i></th>
                <th class="text-center"><i class="far fa-clock" title="Total Hours for Passed Actions"></i></th>
                {{-- <th class="text-center"><i class="fas fa-history" title="Total Hours for Failed Actions"></i></th> --}}
                <th class="text-center"><i class="fas fa-check" title="Pass count"></i></th>
                <th class="text-center"><i class="fas fa-times" title="Failed Count"></i></th>
                <th class="text-center"><i class="far fa-clock" title="Total Hours for Passed Actions"></i></th>
                {{-- <th class="text-center"><i class="fas fa-history" title="Total Hours for Failed Actions"></i></th> --}}
                <th class="text-center"><i class="fas fa-check" title="Pass count"></i></th>
                <th class="text-center"><i class="fas fa-times" title="Failed Count"></i></th>
                <th class="text-center"><i class="far fa-clock" title="Total Hours for Passed Actions"></i></th>
                {{-- <th class="text-center"><i class="fas fa-history" title="Total Hours for Failed Actions"></i></th> --}}
                <th class="text-center"><i class="fas fa-check" title="Pass count"></i></th>
                <th class="text-center"><i class="fas fa-times" title="Failed Count"></i></th>
                <th class="text-center"><i class="far fa-clock" title="Total Hours for Passed Actions"></i></th>
                {{-- <th class="text-center"><i class="fas fa-history" title="Total Hours for Failed Actions"></i></th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach($timePeriod as $tp)
                <tr>
                    <td>{{ $tp->time_period }}</td>
                    <td class="text-center">
                        @if(($tp->spm_upgrade_pass_count) != 0)
                            {{ $tp->spm_upgrade_pass_count }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(($tp->spm_upgrade_fail_count) != 0)
                            {{ $tp->spm_upgrade_fail_count }}
                        @endif
                    </td>
                    <td class="text-right">
                        @if($tp->spm_upgrade_total_time !== "00:00:00")
                            {{ $tp->spm_upgrade_total_time }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(($tp->pai_upgrade_pass_count) != 0)
                            {{ $tp->pai_upgrade_pass_count }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(($tp->pai_upgrade_fail_count) != 0)
                            {{ $tp->pai_upgrade_fail_count }}
                        @endif
                    </td>
                    <td class="text-right">
                        @if($tp->pai_upgrade_total_time !== "00:00:00")
                            {{ $tp->pai_upgrade_total_time }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(($tp->both_upgrade_pass_count) != 0)
                            {{ $tp->both_upgrade_pass_count }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(($tp->pai_upgrade_fail_count) != 0)
                            {{ $tp->pai_upgrade_fail_count }}
                        @endif
                    </td>
                    <td class="text-right">
                        @if($tp->both_upgrade_total_time !== "00:00:00")
                            {{ $tp->both_upgrade_total_time }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(($tp->startup_pass_count) != 0)
                            {{ $tp->startup_pass_count }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(($tp->startup_fail_count) != 0)
                            {{ $tp->startup_fail_count }}
                        @endif
                    </td>
                    <td class="text-right">
                        @if($tp->startup_total_time !== "00:00:00")
                            {{ $tp->startup_total_time }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(($tp->shutdown_pass_count) != 0)
                            {{ $tp->shutdown_pass_count }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(($tp->shutdown_fail_count) != 0)
                            {{ $tp->shutdown_fail_count }}
                        @endif
                    </td>
                    <td class="text-right">
                        @if($tp->shutdown_total_time !== "00:00:00")
                            {{ $tp->shutdown_total_time }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(($tp->restart_pass_count) != 0)
                            {{ $tp->restart_pass_count }}
                        @endif
                    </td>
                    <td class="text-center">
                        @if(($tp->restart_fail_count) != 0)
                            {{ $tp->restart_fail_count }}
                        @endif
                    </td>
                    <td class="text-right">
                        @if($tp->restart_total_time !== "00:00:00")
                            {{ $tp->restart_total_time }}
                        @endif
                    </td>
                    <td class="text-right">
                        @if($tp->all_pass_time !== "00:00:00")
                            {{ $tp->all_pass_time }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>