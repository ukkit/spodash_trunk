@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">
            Instance List for {{ $productVersion->product_ver_number }} build {{ $productVersion->product_build_numer }}
        </h1>
        <h1 class="pull-right">
        <a class="btn bg-olive" style="margin-top: -10px; margin-bottom: 5px" href="{!! url()->previous() !!}">Back</a>
        </h1>
        <br>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('product_versions.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
