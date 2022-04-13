
<div class="table-responsive">
    <table class="table table-responsive table-condensed table-hover" id="action-data-table">
        <thead>
            <tr>
                <th rowspan="2" class="text-center">Release Number</th>
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
        <thead>

        </thead>
        @foreach ($releaseData as $release)
            {{-- <th class="text-center">{{ $release->spm_version }}</th> --}}
            <tr>
                @if ($release->spm_version != null)
                    <td class="text-center">SPM {{ $release->spm_version }}</td>
                @else
                    <td class="text-center">PAI {{ $release->pai_version }}</td>
                @endif
                <td class="text-center">
                    @if(($release->spm_upgrade_pass_count) != 0)
                        {{ $release->spm_upgrade_pass_count }}
                    @endif
                </td>
                <td class="text-center">
                    @if(($release->spm_upgrade_fail_count) != 0)
                        {{ $release->spm_upgrade_fail_count }}
                    @endif
                </td>
                <td class="text-right">
                    @if($release->spm_upgrade_total_time !== "00:00:00")
                        {{ $release->spm_upgrade_total_time }}
                    @endif
                </td>
                {{-- <td class="text-right">
                    @if($release->spm_upgrade_total_fail_time !== "00:00:00")
                        {{ $release->spm_upgrade_total_fail_time }}
                    @endif
                </td> --}}

                <td class="text-center">
                    @if(($release->pai_upgrade_pass_count) != 0)
                        {{ $release->pai_upgrade_pass_count }}
                    @endif
                </td>
                <td class="text-center">
                    @if(($release->pai_upgrade_fail_count) != 0)
                        {{ $release->pai_upgrade_fail_count }}
                    @endif
                </td>
                <td class="text-right">
                    @if($release->pai_upgrade_total_time !== "00:00:00")
                        {{ $release->pai_upgrade_total_time }}
                    @endif
                </td>
                {{-- <td class="text-right">
                    @if($release->pai_upgrade_total_fail_time !== "00:00:00")
                        {{ $release->pai_upgrade_total_fail_time }}
                    @endif
                </td> --}}

                <td class="text-center">
                    @if(($release->both_upgrade_pass_count) != 0)
                        {{ $release->both_upgrade_pass_count }}
                    @endif
                </td>
                <td class="text-center">
                    @if(($release->pai_upgrade_fail_count) != 0)
                        {{ $release->pai_upgrade_fail_count }}
                    @endif
                </td>
                <td class="text-right">
                    @if($release->both_upgrade_total_time !== "00:00:00")
                        {{ $release->both_upgrade_total_time }}
                    @endif
                </td>
                {{-- <td class="text-right">
                    @if($release->both_upgrade_total_fail_time !== "00:00:00")
                        {{ $release->both_upgrade_total_fail_time }}
                    @endif
                </td> --}}

                <td class="text-center">
                    @if(($release->startup_pass_count) != 0)
                        {{ $release->startup_pass_count }}
                    @endif
                </td>
                <td class="text-center">
                    @if(($release->startup_fail_count) != 0)
                        {{ $release->startup_fail_count }}
                    @endif
                </td>
                <td class="text-right">
                    @if($release->startup_total_time !== "00:00:00")
                        {{ $release->startup_total_time }}
                    @endif
                </td>
                {{-- <td class="text-right">
                    @if($release->startup_total_fail_time !== "00:00:00")
                        {{ $release->startup_total_fail_time }}
                    @endif
                </td> --}}

                <td class="text-center">
                    @if(($release->shutdown_pass_count) != 0)
                        {{ $release->shutdown_pass_count }}
                    @endif
                </td>
                <td class="text-center">
                    @if(($release->shutdown_fail_count) != 0)
                        {{ $release->shutdown_fail_count }}
                    @endif
                </td>
                <td class="text-right">
                    @if($release->shutdown_total_time !== "00:00:00")
                        {{ $release->shutdown_total_time }}
                    @endif
                </td>
                {{-- <td class="text-right">
                    @if($release->shutdown_total_fail_time !== "00:00:00")
                        {{ $release->shutdown_total_fail_time }}
                    @endif
                </td> --}}

                <td class="text-center">
                    @if(($release->restart_pass_count) != 0)
                        {{ $release->restart_pass_count }}
                    @endif
                </td>
                <td class="text-center">
                    @if(($release->restart_fail_count) != 0)
                        {{ $release->restart_fail_count }}
                    @endif
                </td>
                <td class="text-right">
                    @if($release->restart_total_time !== "00:00:00")
                        {{ $release->restart_total_time }}
                    @endif
                </td>
                {{-- <td class="text-right">
                    @if($release->restart_total_fail_time !== "00:00:00")
                        {{ $release->restart_total_fail_time }}
                    @endif
                </td> --}}

                <td class="text-right">
                    @if($release->all_pass_time !== "00:00:00")
                        {{ $release->all_pass_time }}
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</div>