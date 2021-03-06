@extends('layouts.app')

<x-assets.datatables />

@section('breadcrumb')
@can('create-customer')
<x-buttons.primary :text="'create customer'" :link="route('customers.create')"  />
@endcan
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Customer List</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Customer Type</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
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
                ajax: "{{route('customers.index')}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'customer_type', name: 'customer_type'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'address', name: 'address'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        });
    </script>
@endpush
