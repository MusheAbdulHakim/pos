@extends('layouts.app')

@push('page-css')
<link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create Product</h4>
            <form action="{{route('products.store')}}" class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="row">
                   <div class="col-lg-4">
                    <div class="form-group">
                        <label for="product_type">Product Type</label>
                        <select name="product_type" id="product_type" class="form-control select2">
                            <option selected>Standard</option>
                            <option>Combo</option>
                        </select>
                    </div>
                   </div>
                   <div class="col-lg-4">
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}" required>
                        <div class="invalid-feedback">
                            Please enter product name
                        </div>
                    </div>
                   </div>
                   <div class="col-lg-4">
                      <div class="form-group">
                        <label>BarCode</label>
                        <input type="text" class="form-control" value="{{old('barcode')}}" name="barcode" required>
                        <div class="invalid-feedback">
                            Please enter product barcode
                        </div>
                      </div>
                   </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Product Brand</label>
                            <x-input.select2.single :options="App\Models\Brand::get()" :name="'brand'" :key="'title'" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Product Category</label>
                            <x-input.select2.single :options="App\Models\ProductCategory::get()" :name="'category'" :key="'name'" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Product Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                     <div class="form-group">
                         <label class="control-label">Product Cost</label>
                         <input type="text" class="form-control" value="{{old('cost')}}" name="cost" placeholder="product cost price" required>
                         <div class="invalid-feedback">
                            Please provide product cost
                         </div>
                     </div>
                    </div>
                    <div class="col-lg-4">
                     <div class="form-group">
                         <label class="control-label">Product Price</label>
                         <input type="text" name="price" class="form-control" value="{{old('price')}}" placeholder="product selling price" required>
                         <div class="invalid-feedback">
                             Please enter product selling price
                         </div>
                     </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="form-group">
                         <label>Alert Quantity</label>
                         <input type="number" class="form-control" name="alert_quantity" value="{{old('alert_quantity') ?? '1'}}">
                       </div>
                    </div>
                 </div>

                 <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Product Unit</label>
                            <select name="product_unit" class="form-control select2">
                                <option selected disabled>select product unit</option>
                                @foreach (App\Models\Unit::get() as $unit)
                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Sale Unit</label>
                            <select name="sale_unit" class="form-control select2">
                                <option selected disabled>select sale unit</option>
                                @foreach (App\Models\Unit::get() as $unit)
                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Purchase Unit</label>
                            <select name="purchase_unit" class="form-control select2">
                                <option selected disabled>select purchase unit</option>
                                @foreach (App\Models\Unit::get() as $unit)
                                <option value="{{$unit->id}}">{{$unit->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                 </div>

                 <div class="row">
                    <div class="col-lg-6">
                     <div class="form-group">
                         <label class="control-label">Tax</label>
                         <select name="tax" class="form-control select2">
                            <option selected disabled>No Tax</option>
                            @foreach (App\Models\Tax::get() as $tax)
                            <option value="{{$tax->id}}">{{$tax->name}}</option>
                            @endforeach
                        </select>
                     </div>
                    </div>
                    <div class="col-lg-6">
                     <div class="form-group">
                         <label class="control-label">Tax Method</label>
                         <select name="tax_method" class="form-control select2">
                            <option selected disabled>No Tax Method </option>
                            <option>Exclusive</option>
                            <option>Inclusive</option>
                        </select>
                     </div>
                    </div>
                    
                 </div>
                
                <div class="form-group">
                    <label class="control-label">Details</label>
                    <x-input.filemanager.tinymce :name="'details'" :value="old('details')" />
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
<script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
@endpush