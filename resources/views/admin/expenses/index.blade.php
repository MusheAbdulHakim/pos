@extends('layouts.app')

<x-assets.datatables />

@section('breadcrumb')

@can('create-expense')
<x-buttons.primary :text="'create expense'" :link="route('expenses.create')"  />
@endcan

@endsection

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Expenses List</h4>
            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>Expense Category</th>
                        <th>Amount</th>
                        <th>Comment</th>
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
            ajax: "{{route('expenses.index')}}",
            columns: [
                {data: 'expense_category', name: 'expense_category'},
                {data: 'amount', name: 'amount'},
                {data: 'comment', name: 'comment'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

    });
</script>
@endpush