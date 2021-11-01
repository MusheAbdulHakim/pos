@extends('layouts.app')

<x-assets.datatables />

@section('breadcrumb')
<x-buttons.primary :text="'create unit'" :target="'#addUnit'"  />
@endsection

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Unit List</h4>

                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Base Unit</th>
                            <th>Operator</th>
                            <th>Operation Value</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <!-- create unit modal -->
    <div id="addUnit" class="modal fade" tabindex="-1" role="dialog"
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
                <form action="{{route('unit')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input id="code" type="text" class="form-control" name="code" placeholder="pc" required>
                            <div class="invalid-feedback">
                                Please enter unit code
                            </div> 
                        </div> 
                        <div class="form-group">
                            <label for="title">Name</label>
                            <input id="title" type="text" class="form-control" name="name" placeholder="piece" required>
                            <div class="invalid-feedback">
                                Please enter unit name
                            </div> 
                        </div> 
                        <div class="form-group">
                            <label for="base">Base Unit</label>
                            <select name="base_unit" id="base" class="form-control">
                                <option value="">No Base Unit</option>
                                @foreach (App\Models\Unit::get() as $unit)
                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please choose base unit
                            </div> 
                        </div>  
                        <div id="base_operation">
                            <div class="form-group">
                                <label for="operator">Operator</label>
                                <input id="operator" type="text" class="form-control" name="operator" placeholder="*">
                            </div>  
                            <div class="form-group">
                                <label for="value">Operation Value</label>
                                <input id="value" type="number" class="form-control" name="value" placeholder="1">
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
    <!-- edit unit modal -->
    <div id="editUnit" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Edit Unit
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('unit')}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_code">Code</label>
                            <input id="edit_code" type="text" class="form-control" name="code" placeholder="pc" required>
                            <div class="invalid-feedback">
                                Please enter unit code
                            </div> 
                        </div> 
                        <div class="form-group">
                            <label for="edit_name">Name</label>
                            <input id="edit_name" type="text" class="form-control" name="name" placeholder="piece" required>
                            <div class="invalid-feedback">
                                Please enter unit name
                            </div> 
                        </div> 
                        <div class="form-group">
                            <label for="edit_base">Base Unit</label>
                            <select name="base_unit" id="edit_base" class="form-control">
                                <option value="">No Base Unit</option>
                                @foreach (App\Models\Unit::get() as $unit)
                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Please choose base unit
                            </div> 
                        </div>  
                        <div id="edit_base_operation">
                            <div class="form-group">
                                <label for="edit_operator">Operator</label>
                                <input id="edit_operator" type="text" class="form-control" name="operator" placeholder="math operator eg: *">
                            </div>  
                            <div class="form-group">
                                <label for="edit_value">Operation Value</label>
                                <input id="edit_value" type="number" class="form-control" name="value" placeholder="1">
                            </div>
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
                ajax: "{{route('unit')}}",
                columns: [
                    {data: 'code', name: 'code'},
                    {data: 'name', name: 'name'},
                    {data: 'base_unit', name: 'base_unit'},
                    {data: 'operator', name: 'operator'},
                    {data: 'value', name: 'value'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });


            //hide/show base unit operation
            $('#base_operation').hide();
            $('select[name=base_unit]').change(function (){
                if($(this).val()){
                    $('#base_operation').show();
                }else{
                    $('#base_operation').hide();
                }
            });
            $('#datatable').on('click','.edit',function(){
                var id = $(this).data('id');
                var code = $(this).data('code');
                var name = $(this).data('name');
                var operator = $(this).data('operator');
                var value = $(this).data('value');
                var base_unit = $(this).data('base');
                event.preventDefault();
                $('#editUnit').modal('show');
                $('#edit_id').val(id);
                $('#edit_code').val(code);
                $('#edit_name').val(name);
                $('#edit_operator').val(operator);
                $('#edit_value').val(value);
                $('#edit_base').val(base_unit);
                console.log($('#edit_base').val())
                if($('#edit_base').val() == ''){
                    $('#edit_base_operation').hide();
                }else{
                    $('#edit_base_operation').show();
                }
                $('#edit_base').change(function (){
                    if($(this).val() != ''){
                        $('#edit_base_operation').show();
                    }else{
                        $('#edit_base_operation').hide();
                    }
                });
            });
                      
            
        });
    </script>
@endpush
