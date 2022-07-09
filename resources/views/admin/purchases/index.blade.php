@extends('layouts.app')

<x-assets.datatables />

@section('breadcrumb')

@can('create-purchase')
<x-buttons.primary :text="'create purchase'" :link="route('purchases.create')"  />
@endcan

@endsection

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Purchase List</h4>
            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Supplier</th>
                        <th>Product(s)</th>
                        <th>Purchase Status</th>
                        <th>Date</th>
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
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5',
                'colvis'
            ],
            processing: true,
            serverSide: true,
            ajax: "{{route('purchases.index')}}",
            columns: [
                {data: 'reference', name: 'reference'},
                {data: 'supplier', name: 'supplier'},
                {data: 'products', name: 'products'},
                {data: 'status', name: 'status'},
                {data: 'date', name: 'date'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
            
        });
        table.buttons().container()
        .appendTo( '#datatable_wrapper .col-md-6:eq(0)' );
    });
</script>
@endpush