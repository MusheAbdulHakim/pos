@extends('layouts.app')

@push('page-css')

@endpush

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create Purchase</h4>
            <form autocomplete="off" action="{{route('purchases.store')}}" class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Supplier</label>
                            <x-input.select2.single :options="App\Models\Supplier::get()" :name="'supplier'" :key="'name'" />
                        </div>
                    </div>
                    
                   <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Purhcase Status</label>
                            <select value="{{old('status')}}" name="status" class="form-control">
                                <option selected>Received</option>
                                <option>Pending</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
        
                <div class="row mb-3 mt-3">
                    <div class="col-lg-12 repeater">
                        <div data-repeater-list="products">
                            <div data-repeater-item class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label>Search Product</label>
                                         <div class="container input-group">
                                             <span class="input-group-append">
                                                 <span class="input-group-text" data-original-title="" title="" tabindex="0">
                                                     <i class="fas fa-barcode"></i>
                                                 </span>
                                             </span>
                                             <input class="typeahead form-control" name="name" type="text" placeholder="Search product" required>
                                             <div class="invalid-feedback">
                                                Please choose product
                                            </div> 
                                         </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="control-label">Quantity</label>
                                        <input type="number" name="quantity" class="form-control" value="{{old('quantity')}}" placeholder="quantity" required>
                                        <div class="invalid-feedback">
                                            Please provide product quantity
                                        </div> 
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label class="control-label">Batch</label>
                                        <input type="text" name="batch" class="form-control" value="{{old('batch')}}" placeholder="batch number">
                                    </div>
                                </div>    
                                
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label class="control-label">Expiry Date</label>
                                        <input type="date" name="expiry_date" class="form-control" value="{{old('expiry_date')}}">
                                    </div>
                                </div> 

                                <div class="col-lg-1 align-self-center">
                                    <button type="button" data-repeater-delete class="btn btn-primary btn-block"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>

                        </div>
                        <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Add" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label">Note</label>
                            <x-input.filemanager.tinymce :name="'note'" :value="old('note')" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('page-js')
<!-- type ahead js -->
<script src="{{asset('assets/libs/bootstrap-typeahead/bootstrap3-typeahead.min.js')}}"></script>

<!-- form repeater js -->
<script src="{{asset('assets/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>
<script>
    $(document).ready(function(){
        var path = "{{ route('autocomplete')}}";
        $('input.typeahead').typeahead({
            source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                    console.log(Object.keys(data))
                    return process(data);
                });
            }
        });
        $(".repeater").repeater({
            defaultValues: {
            
            },
            show: function () {
                $(this).slideDown();
                $('input.typeahead').typeahead({
                    source:  function (query, process) {
                        return $.get(path, { query: query }, function (data) {
                            console.log(Object.keys(data))
                                return process(data);
                            });
                    }
                });
            },
            hide: function (e) {
                confirm("Are you sure you want to delete this element?") &&
                $(this).slideUp(e);
            },
            ready: function (e) {},
        });
        
    });
</script>

@endpush