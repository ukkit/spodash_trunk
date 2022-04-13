
<div class="table-responsive">
    <table class="table table-responsive table-condensed table-hover" id="action-data-details-table">
        <thead>
            <tr>
                <th rowspan="2">Release Number</th>
                <th colspan="8" class="text-center">SPM Upgrade</th>
                <th rowspan="2">&nbsp;</th>
                <th colspan="8" class="text-center">PAI Upgrade</th>
                <th rowspan="2">&nbsp;</th>
                <th colspan="8" class="text-center">SPM & PAI Upgrade</th>
                {{-- <th colspan="4" class="text-center">PAI Upgrade Time</th>
                <th colspan="4" class="text-center">SPM & PAI Upgrade Time</th>
                <th colspan="4" class="text-center">App Start Time</th>
                <th colspan="4" class="text-center">App Shutdown Time</th>
                <th colspan="4" class="text-center">App Restart Time</th> --}}
                {{-- <th rowspan="2">Total Time</th> --}}
            </tr>
            <tr>
                <th class="text-center"><i class="fas fa-check" title="Pass count"></i></th>
                <th class="text-center"><i class="fas fa-arrow-up" title="Maximum Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-arrows-alt-h" title="Average Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-arrow-down" title="Minimum Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="far fa-clock" title="Total Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-times" title="Failed Count"></i></th>
                <th class="text-center"><i class="fas fa-history" title="Total Hours for Failed Actions"></i></th>
                <th class="text-center"><i class="fas fa-percentage" title="Success Action Percentage"></i></th>
                <th class="text-center"><i class="fas fa-check" title="Pass count"></i></th>
                <th class="text-center"><i class="fas fa-arrow-up" title="Maximum Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-arrows-alt-h" title="Average Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-arrow-down" title="Minimum Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="far fa-clock" title="Total Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-times" title="Failed Count"></i></th>
                <th class="text-center"><i class="fas fa-history" title="Total Hours for Failed Actions"></i></th>
                <th class="text-center"><i class="fas fa-percentage" title="Success Action Percentage"></i></th>
                <th class="text-center"><i class="fas fa-check" title="Pass count"></i></th>
                <th class="text-center"><i class="fas fa-arrow-up" title="Maximum Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-arrows-alt-h" title="Average Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-arrow-down" title="Minimum Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="far fa-clock" title="Total Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-times" title="Failed Count"></i></th>
                <th class="text-center"><i class="fas fa-history" title="Total Hours for Failed Actions"></i></th>
                <th class="text-center"><i class="fas fa-percentage" title="Success Action Percentage"></i></th>
            </tr>
        </thead>
        <thead>

        </thead>
        @foreach ($releaseData as $release)
            {{-- <th class="text-center">{{ $release->spm_version }}</th> --}}
            <tr>
                @if ($release->spm_version != null)
                    <td class="text-center">{{ $release->spm_version }}</td>
                @else
                    <td class="text-center">{{ $release->pai_version }}</td>
                @endif

                {{--  SPM UPGRADE BLOCK --}}
                <td class="text-center">
                    @if(($release->spm_upgrade_pass_count) != 0)
                        {{ $release->spm_upgrade_pass_count }}
                    @endif
                </td>
                <td>{{ $release->spm_upgrade_max_time }}</td>
                <td>{{ $release->spm_upgrade_avg_time }}</td>
                <td>{{ $release->spm_upgrade_min_time }}</td>
                <td>
                    @if($release->spm_upgrade_total_time !== "00:00:00")
                        {{ $release->spm_upgrade_total_time }}
                    @endif
                </td>
                <td class="text-center">
                    @if(($release->spm_upgrade_fail_count) != 0)
                        {{ $release->spm_upgrade_fail_count }}
                    @endif
                </td>
                <td class="text-right">
                    @if($release->spm_upgrade_total_fail_time !== "00:00:00")
                        {{ $release->spm_upgrade_total_fail_time }}
                    @endif
                </td>
                <td class="text-right">
                    @if(($release->spm_upgrade_pass_count) != 0)
                    @php
                        $pass_percent = (( $release->spm_upgrade_pass_count - $release->spm_upgrade_fail_count) / $release->spm_upgrade_pass_count) * 100;
                        echo number_format((float)$pass_percent, 2, '.', '')." %";
                    @endphp
                    @endif
                </td>
                <td>&nbsp;</td>
                {{--  PAI UPGRADE BLOCK --}}
                <td class="text-center">
                    @if(($release->pai_upgrade_pass_count) != 0)
                        {{ $release->pai_upgrade_pass_count }}
                    @endif
                </td>
                <td>{{ $release->pai_upgrade_max_time }}</td>
                <td>{{ $release->pai_upgrade_avg_time }}</td>
                <td>{{ $release->pai_upgrade_min_time }}</td>
                <td>
                    @if($release->pai_upgrade_total_time !== "00:00:00")
                        {{ $release->pai_upgrade_total_time }}
                    @endif
                </td>
                <td class="text-center">
                    @if(($release->pai_upgrade_fail_count) != 0)
                        {{ $release->pai_upgrade_fail_count }}
                    @endif
                </td>
                <td class="text-right">
                    @if($release->pai_upgrade_total_fail_time !== "00:00:00")
                        {{ $release->pai_upgrade_total_fail_time }}
                    @endif
                </td>
                <td class="text-right">
                    @if(($release->pai_upgrade_pass_count) != 0)
                    @php
                        $pass_percent = (( $release->pai_upgrade_pass_count - $release->pai_upgrade_fail_count) / $release->pai_upgrade_pass_count) * 100;
                        echo number_format((float)$pass_percent, 2, '.', '')." %";
                    @endphp
                    @endif
                </td>

                <td>&nbsp;</td>
                {{--  BOTH UPGRADE BLOCK --}}
                <td class="text-center">
                    @if(($release->both_upgrade_pass_count) != 0)
                        {{ $release->both_upgrade_pass_count }}
                    @endif
                </td>
                <td>{{ $release->both_upgrade_max_time }}</td>
                <td>{{ $release->both_upgrade_avg_time }}</td>
                <td>{{ $release->both_upgrade_min_time }}</td>
                <td>
                    @if($release->both_upgrade_total_time !== "00:00:00")
                        {{ $release->both_upgrade_total_time }}
                    @endif
                </td>
                <td class="text-center">
                    @if(($release->both_upgrade_fail_count) != 0)
                        {{ $release->both_upgrade_fail_count }}
                    @endif
                </td>
                <td class="text-right">
                    @if($release->both_upgrade_total_fail_time !== "00:00:00")
                        {{ $release->both_upgrade_total_fail_time }}
                    @endif
                </td>
                <td class="text-right">
                    @if(($release->both_upgrade_pass_count) != 0)
                    @php
                        $pass_percent = (( $release->both_upgrade_pass_count - $release->both_upgrade_fail_count) / $release->both_upgrade_pass_count) * 100;
                        echo number_format((float)$pass_percent, 2, '.', '')." %";
                    @endphp
                    @endif
                </td>

            </tr>
            @endforeach
    </table>
</div>
<hr />
<div class="table-responsive">
    <table class="table table-responsive table-condensed table-hover" id="action-data-details-table">
        <thead>
            <tr>
                <th rowspan="2">Release Number</th>
                <th colspan="8" class="text-center">Instance Startup</th>
                <th rowspan="2">&nbsp;</th>
                <th colspan="8" class="text-center">Instance Shutdown</th>
                <th rowspan="2">&nbsp;</th>
                <th colspan="8" class="text-center">Instance Restart</th>
                {{-- <th colspan="4" class="text-center">PAI Upgrade Time</th>
                <th colspan="4" class="text-center">SPM & PAI Upgrade Time</th>
                <th colspan="4" class="text-center">App Start Time</th>
                <th colspan="4" class="text-center">App Shutdown Time</th>
                <th colspan="4" class="text-center">App Restart Time</th> --}}
                {{-- <th rowspan="2">Total Time</th> --}}
            </tr>
            <tr>
                <th class="text-center"><i class="fas fa-check" title="Pass count"></i></th>
                <th class="text-center"><i class="fas fa-arrow-up" title="Maximum Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-arrows-alt-h" title="Average Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-arrow-down" title="Minimum Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="far fa-clock" title="Total Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-times" title="Failed Count"></i></th>
                <th class="text-center"><i class="fas fa-history" title="Total Hours for Failed Actions"></i></th>
                <th class="text-center"><i class="fas fa-percentage" title="Success Action Percentage"></i></th>
                <th class="text-center"><i class="fas fa-check" title="Pass count"></i></th>
                <th class="text-center"><i class="fas fa-arrow-up" title="Maximum Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-arrows-alt-h" title="Average Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-arrow-down" title="Minimum Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="far fa-clock" title="Total Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-times" title="Failed Count"></i></th>
                <th class="text-center"><i class="fas fa-history" title="Total Hours for Failed Actions"></i></th>
                <th class="text-center"><i class="fas fa-percentage" title="Success Action Percentage"></i></th>
                <th class="text-center"><i class="fas fa-check" title="Pass count"></i></th>
                <th class="text-center"><i class="fas fa-arrow-up" title="Maximum Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-arrows-alt-h" title="Average Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-arrow-down" title="Minimum Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="far fa-clock" title="Total Pass Time (hh:mm:ss)"></i></th>
                <th class="text-center"><i class="fas fa-times" title="Failed Count"></i></th>
                <th class="text-center"><i class="fas fa-history" title="Total Hours for Failed Actions"></i></th>
                <th class="text-center"><i class="fas fa-percentage" title="Success Action Percentage"></i></th>
            </tr>
        </thead>
        <thead>

        </thead>
        @foreach ($releaseData as $release)
            {{-- <th class="text-center">{{ $release->spm_version }}</th> --}}
            <tr>
                @if ($release->spm_version != null)
                    <td class="text-center">{{ $release->spm_version }}</td>
                @else
                    <td class="text-center">{{ $release->pai_version }}</td>
                @endif

                {{--  INSTANCE STARTUP BLOCK --}}
                <td class="text-center">
                    @if(($release->startup_pass_count) != 0)
                        {{ $release->startup_pass_count }}
                    @endif
                </td>
                <td>{{ $release->startup_max_time }}</td>
                <td>{{ $release->startup_avg_time }}</td>
                <td>{{ $release->startup_min_time }}</td>
                <td>
                    @if($release->startup_total_time !== "00:00:00")
                        {{ $release->startup_total_time }}
                    @endif
                </td>
                <td class="text-center">
                    @if(($release->startup_fail_count) != 0)
                        {{ $release->startup_fail_count }}
                    @endif
                </td>
                <td class="text-right">
                    @if($release->startup_total_fail_time !== "00:00:00")
                        {{ $release->startup_total_fail_time }}
                    @endif
                </td>
                <td class="text-right">
                    @if(($release->startup_pass_count) != 0)
                    @php
                        $pass_percent = (( $release->startup_pass_count - $release->startup_fail_count) / $release->startup_pass_count) * 100;
                        echo number_format((float)$pass_percent, 2, '.', '')." %";
                    @endphp
                    @endif
                </td>

                <td>&nbsp;</td>
                {{--  INSTANCE SHUTDOWN BLOCK --}}
                <td class="text-center">
                    @if(($release->shutdown_pass_count) != 0)
                        {{ $release->shutdown_pass_count }}
                    @endif
                </td>
                <td>{{ $release->shutdown_max_time }}</td>
                <td>{{ $release->shutdown_avg_time }}</td>
                <td>{{ $release->shutdown_min_time }}</td>
                <td>
                    @if($release->shutdown_total_time !== "00:00:00")
                        {{ $release->shutdown_total_time }}
                    @endif
                </td>
                <td class="text-center">
                    @if(($release->shutdown_fail_count) != 0)
                        {{ $release->shutdown_fail_count }}
                    @endif
                </td>
                <td class="text-right">
                    @if($release->shutdown_total_fail_time !== "00:00:00")
                        {{ $release->shutdown_total_fail_time }}
                    @endif
                </td>
                <td class="text-right">
                    @if(($release->shutdown_pass_count) != 0)
                    @php
                        $pass_percent = (( $release->shutdown_pass_count - $release->shutdown_fail_count) / $release->shutdown_pass_count) * 100;
                        echo number_format((float)$pass_percent, 2, '.', '')." %";
                    @endphp
                    @endif
                </td>

                <td>&nbsp;</td>
                {{--  INSTANCE RESTART BLOCK --}}
                <td class="text-center">
                    @if(($release->restart_pass_count) != 0)
                        {{ $release->restart_pass_count }}
                    @endif
                </td>
                <td>{{ $release->restart_max_time }}</td>
                <td>{{ $release->restart_avg_time }}</td>
                <td>{{ $release->restart_min_time }}</td>
                <td>
                    @if($release->restart_total_time !== "00:00:00")
                        {{ $release->restart_total_time }}
                    @endif
                </td>
                <td class="text-center">
                    @if(($release->restart_fail_count) != 0)
                        {{ $release->restart_fail_count }}
                    @endif
                </td>
                <td class="text-right">
                    @if($release->restart_total_fail_time !== "00:00:00")
                        {{ $release->restart_total_fail_time }}
                    @endif
                </td>
                <td class="text-right">
                    @if(($release->restart_pass_count) != 0)
                    @php
                        $pass_percent = (( $release->restart_pass_count - $release->restart_fail_count) / $release->restart_pass_count) * 100;
                        echo number_format((float)$pass_percent, 2, '.', '')." %";
                    @endphp
                    @endif
                </td>

            </tr>
            @endforeach
    </table>
    <br>
    <br>

</div>
                {{-- <td>{{ $release->startup_max_time }}</td>
                <td>{{ $release->startup_avg_time }}</td>
                <td>{{ $release->startup_min_time }}</td>
                <td>
                    @if($release->startup_total_time !== "00:00:00")
                        {{ $release->startup_total_time }}
                    @endif
                </td>

                <td>{{ $release->shutdown_max_time }}</td>
                <td>{{ $release->shutdown_avg_time }}</td>
                <td>{{ $release->shutdown_min_time }}</td>
                <td>
                    @if($release->shutdown_total_time !== "00:00:00")
                        {{ $release->shutdown_total_time }}
                    @endif
                </td>

                <td>{{ $release->restart_max_time }}</td>
                <td>{{ $release->restart_avg_time }}</td>
                <td>{{ $release->restart_min_time }}</td>
                <td>
                    @if($release->restart_total_time !== "00:00:00")
                        {{ $release->restart_total_time }}
                    @endif
                </td>
                <td class="text-right">
                    @if($release->all_pass_time !== "00:00:00")
                        {{ $release->all_pass_time }}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</div> --}}