
<?php
$inst_array = $productVersion->instance_list_by_pvid($productVersion->pv_id);
?>

@if(count($inst_array) > 0)

    <table class="table table-95percent table-responsive table-condensed table-striped" id="releaseDetails-table">
        <thead>
            <tr>
                <th>Instance ID</th>
                <th>Instance Name</th>
                <th>Product</th>
                <th class="text-center"><i class="fas fa-heartbeat" title="Instance is Active"></i></th>
                <th class="text-center"><i class="fas fa-tachometer-alt" title="Show on Dashboard"></i></th>
            </tr>
        </thead>
        <tbody>
            @foreach($inst_array as $inst)
            <tr>
                <td>{{ $inst->id }}</td>
                <td>{{ $inst->instance_name }}</td>
                <td>{!! $productVersion->product_names_by_id($inst->product_names_id)->product_short_name !!}</td>
                @if($inst->instance_is_active == "Y")
                    <td class="text-center">
                        <i class="far fa-check-circle" title="YES"></i>
                @else
                    <td class="danger text-center">
                        <i class="far fa-times-circle" title="NO"></i>
                @endif
                </td>
                @if($inst->instance_show_on_site == "Y")
                    <td class="text-center">
                        <i class="far fa-check-circle" title="YES"></i>
                @else
                    <td class="danger text-center">
                        <i class="far fa-times-circle" title="NO"></i>
                @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

@endif

