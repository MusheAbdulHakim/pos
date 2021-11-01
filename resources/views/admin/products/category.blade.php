@extends('layouts.app')

<x-assets.datatables />

@section('breadcrumb')
@can('create-expense-category')
<x-buttons.primary :text="'create category'" :target="'#addCategory'"  />
@endcan
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Product Category List</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Parent Category</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- create expense category modal -->
    <div id="addCategory" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Create Product Category
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('product.category')}}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">Category Name</label>
                            <input type="text" class="form-control" name="name" placeholder="enter category name" required>
                            <div class="invalid-feedback">
                                Please enter category
                            </div> 
                        </div>  
                        <div class="form-group">
                            <label class="control-label">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>  
                        <div class="form-group">
                        <label class="control-label">Parent Category</label>
                        <select name="parent_category" class="form-control">
                            <option value="">No Parent Category</option>
                            @foreach (App\Models\ProductCategory::get() as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
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
    <!-- edit product category modal -->
    <div id="editCategory" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Edit Expense Category
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('product.category')}}" method="post" class="needs-validation updateForm" novalidate enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">Category Name</label>
                            <input id="name" type="text" class="form-control" name="name" placeholder="type category name" required>
                            <div class="invalid-feedback">
                                Please enter category
                            </div> 
                        </div>  
                        <div class="form-group">
                            <label class="control-label">Image</label>
                            <input id="image" type="file" class="form-control" name="image">
                        </div>  
                        <div class="form-group">
                            <label class="control-label">Parent Category</label>
                            <select id="parent_category" name="parent_category" class="form-control">
                                <option value="">No Parent Category</option>
                                @foreach (App\Models\ProductCategory::get() as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
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
                ajax: "{{route('product.category')}}",
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'parent_category', name: 'parent_category'},
                    {data: 'image', name: 'image', orderable: false, searchable: false},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('#datatable').on('click','.edit',function(){
                var id = $(this).data('id');
                var name = $(this).data('name');
                var parent_category = $(this).data('base');
                $('#editCategory').modal('show');
                $('#edit_id').val(id);
                $('#name').val(name);
                $('#parent_category').val(parent_category);
            });
        });
    </script>
@endpush
