@extends('layouts.app')

<x-assets.datatables />

@section('breadcrumb')
@can('create-customer-type')
<x-buttons.primary :text="'create customer type'" :target="'#addCustomerType'"  />
@endcan
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Customer Type List</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- create customer type modal -->
    <div id="addCustomerType" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Create Customer Type
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('customer-type')}}" method="post" class="needs-validation" novalidate>
                    <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="type_name">Customer Type</label>
                                <input id="type_name" type="text" class="form-control" name="name" placeholder="retail" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Please enter customer type
                                </div> 
                            </div>                                                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- edit permission modal -->
    <div id="editCustomerType" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Edit Customer Type
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('customer-type')}}" method="post" class="needs-validation updateForm" novalidate>
                    <div class="modal-body">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="edit_type_name">Customer Type</label>
                            <input id="edit_type_name" type="text" class="form-control" name="name" placeholder="retail" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                            <div class="invalid-feedback">
                                Please enter customer type
                            </div> 
                        </div>
                        <input type="hidden" name="id" id="edit_id">
                                                   
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@push('page-js')
    <script>
        $(document).ready(function(){
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('customer-type')}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('#datatable').on('click','.edit',function(){
                var id = $(this).data('id');
                var name = $(this).data('name');
                $('#editCustomerType').modal('show');
                $('#edit_type_name').val(name);
                $('#edit_id').val(id);
            });
        });
    </script>
@endpush
