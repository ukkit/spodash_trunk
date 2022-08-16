<?php
$is_active_array = ["Y","N"];
?>
<!-- Product Short Name Field -->
<div class="form-group col-sm-3">
    {!! Form::label('product_short_name', 'Product Short Name:') !!}
    {!! Form::text('product_short_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Long Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('product_long_name', 'Product Long Name:') !!}
    {!! Form::text('product_long_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Product Is Active Field -->
<!-- <div class="form-group col-sm-3">
    {!! Form::label('product_is_active', 'Product Is Active:') !!}
    {!! Form::text('product_is_active', null, ['class' => 'form-control']) !!}
</div> -->

@if($show_is_active)
    <div class="form-group col-sm-2">
        {!! Form::label('product_is_active', 'Product is Active?') !!}
        <div class="form-control">
                <label class="radio-inline">
                <input type="radio" name="product_is_active" value="Y" checked> Yes
            </label>
            <label class="radio-inline">
                <input type="radio" name="product_is_active" value= "N" @if($record->product_is_active == "N")  checked @endif> No
            </label>
        </div>
    </div>
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('productNames.index') !!}" class="btn btn-default">Cancel</a>
</div>
