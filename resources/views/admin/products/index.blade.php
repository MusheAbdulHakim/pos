@extends('layouts.app')

<x-assets.datatables />

@section('breadcrumb')

@can('create-product')
<x-buttons.primary :text="'create product'" :link="route('products.create')"  />
@endcan

@endsection

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Product List</h4>
            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Barcode</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>ProductUnit</th>
                        <th>Cost</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection

@push('page-js')
<script>
    $(document).ready(function(){
        var table = $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('products.index')}}",
            columns: [
                {data: 'image', name: 'image', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'barcode', name: 'barcode'},
                {data: 'brand', name: 'brand'},
                {data: 'category', name: 'category'},
                {data: 'unit', name: 'unit'},
                {data: 'cost', name: 'cost'},
                {data: 'price', name: 'price'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
</script>
@endpush