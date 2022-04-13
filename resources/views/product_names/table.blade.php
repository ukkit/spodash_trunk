<table class="table table-responsive table-condensed table-striped" id="productNames-table">
    <thead>
        <tr>
        <th class="text-center id_column">ID</th>
        <th>Short Name</th>
        <th>Long Name</th>
        <th class="text-center">Active</th>
        @canany('edit_productNames','delete_productNames')
        <th class="text-center icon_column"><i class="fas fa-tools" title="Actions"><i></th>
        @endcanany
        <!-- <th colspan="3">Action</th> -->
        </tr>
    </thead>
    <tbody>
    @foreach($productNames as $productName)
        <tr>
            <td class="text-center">{!! $productName->id !!}</td>
            <td>{!! $productName->product_short_name !!}</td>
            <td>{!! $productName->product_long_name !!}</td>
            <!-- <td class="text-center">{!! $productName->product_is_active !!}</td> -->
            @if($productName->product_is_active == "Y")
                <td class="text-center">
                Yes
            @else
                <td class="danger text-center">
                No
            @endif
            @canany('edit_productNames','delete_productNames')
            <td class="text-center">
                {!! Form::open(['route' => ['productNames.destroy', $productName->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <!-- <a href="{!! route('productNames.show', [$productName->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a> -->

                    <a href="{!! route('productNames.edit', [$productName->id]) !!}" class='btn btn-info btn-xs'><i class="fas fa-pencil-alt"></i></a>

                    <!-- {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!} -->
                </div>
                {!! Form::close() !!}
            </td>
            @endcanany
        </tr>
    @endforeach
    </tbody>
</table>