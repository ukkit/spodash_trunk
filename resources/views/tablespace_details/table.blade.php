<?php
$Ctr = 1;
?>
<div class="table-responsive">
    {{-- <table class="table" id="tablespaceDetails-table"> --}}
        <table class="table table-responsive table-condensed table-striped" id="tablespaceDetails-table">
        <thead>
            <tr>
                <th>#</th>
                {{-- <th>ID</th>     --}}
                <th>DB Details ID</th>
                {{-- <th>PAI Details ID</th> --}}
                <th>Tablespace Name</th>
                <th class="text-right">Used Space (MB)</th>
                {{-- <th>Free Space</th> --}}
                <th class="text-right">Total Space (MB)</th>
                <th class="text-right">Used %</th>
                <th class="text-right">Free %</th>
                <th>Added</th>
                {{-- <th colspan="3">Action</th> --}}
            </tr>
        </thead>
        <tbody>
        @foreach($tablespaceDetails as $tablespaceDetail)
        <?php
            $tblspc_used = ($tablespaceDetail->used_space);
            $tblspc_free = ($tablespaceDetail->free_space);
            $tblspc_total = ($tablespaceDetail->total_space);
            try {
                $percent_free = round((($tblspc_free/$tblspc_total)*100),2)."%";
            } catch (\Throwable $th) {
                $percent_free = null;
            }

            try {
                $percent_used = round((($tblspc_used/$tblspc_total)*100),2);
            } catch (\Throwable $th) {
                $percent_used = null;
            }

        ?>
            <tr>
                <td>{{ $Ctr }}</td>
                {{-- <td>{{ $tablespaceDetail->id }}</td> --}}
                <td>{{ $tablespaceDetail->database_details_id }}</td>
                {{-- <td>{{ $tablespaceDetail->pai_details_id }}</td> --}}
                <td>{{ $tablespaceDetail->tablespace_name }}</td>
                <td class="text-right">{{ number_format($tblspc_used) }}</td>
                <td class="text-right">{{ number_format($tblspc_total) }}</td>
                <td class="text-right">{{ $percent_used }}%</td>
                <td class="text-right">{{ $percent_free }}%</td>
                <td>{{ $tablespaceDetail->created_at }}</td>

                {{-- <td>
                    {!! Form::open(['route' => ['tablespaceDetails.destroy', $tablespaceDetail->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tablespaceDetails.show', [$tablespaceDetail->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('tablespaceDetails.edit', [$tablespaceDetail->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td> --}}
            </tr>
            @php $Ctr++; @endphp
        @endforeach
        </tbody>
    </table>
</div>
