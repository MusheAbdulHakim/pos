@extends('layouts.app')

<x-assets.datatables />

@section('breadcrumb')
@can("create-tax")
<x-buttons.primary :text="'create tax'" :target="'#addTax'"  />
@endcan
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Tax List</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Rate(%)</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- create tax modal -->
    <div id="addTax" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Create Tax
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('tax')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input id="title" type="text" class="form-control" name="name" placeholder="enter tax name" required>
                            <div class="invalid-feedback">
                                Please enter tax name
                            </div> 
                        </div> 
                        <div class="form-group">
                            <label for="rate">Rate(%)</label>
                            <input id="rate" type="number" class="form-control" name="rate">
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
    <!-- edit tax modal -->
    <div id="editTax" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Edit Tax
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('tax')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_title">Name</label>
                            <input id="edit_title" type="text" class="form-control" name="name" placeholder="enter tax name" required>
                            <div class="invalid-feedback">
                                Please enter tax name
                            </div> 
                        </div> 
                        <div class="form-group">
                            <label for="edit_rate">Rate(%) </label>
                            <input id="edit_rate" type="number" class="form-control" name="rate">
                        </div>                                                     
                    </div>
                    <input type="hidden" name="id" id="edit_id">
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
                ajax: "{{route('tax')}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'rate', name: 'rate'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('#datatable').on('click','.edit',function(){
                var id = $(this).data('id');
                var title = $(this).data('name');
                var rate = $(this).data('rate');
                $('#editTax').modal('show');
                $('#edit_id').val(id);
                $('#edit_title').val(title);
                $('#edit_rate').val(rate);
            });
        });
    </script>
@endpush
