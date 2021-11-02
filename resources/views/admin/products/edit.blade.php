@extends('layouts.app')

@push('page-css')
<link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Product</h4>
            <form action="{{route('products.update',$product)}}" class="needs-validation" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                @method("PUT")
                <div class="row">
                   <div class="col-lg-4">
                    <div class="form-group">
                        <label for="product_type">Product Type</label>
                        <select name="product_type" value="{{$product->type}}" id="product_type" class="form-control select2">
                            <option selected>Standard</option>
                            <option>Combo</option>
                        </select>
                    </div>
                   </div>
                   <div class="col-lg-4">
                    <div class="form-group">
                        <label class="control-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{$product->name ?? old('name')}}" required>
                        <div class="invalid-feedback">
                            Please enter product name
                        </div>
                    </div>
                   </div>
                   <div class="col-lg-4">
                      <div class="form-group">
                        <label>BarCode</label>
                        <input type="text" class="form-control" value="{{$product->barcode ?? old('barcode')}}" name="barcode" required>
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
                            <x-input.select2.single :options="App\Models\Brand::get()" :name="'brand'" :key="'title'" :selected="$product->brand->title" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Product Category</label>
                            <x-input.select2.single :options="App\Models\ProductCategory::get()" :name="'category'" :key="'name'" :selected="$product->product_category->name" />
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
                         <input type="text" class="form-control" value="{{$product->cost ?? old('cost')}}" name="cost" placeholder="product cost price" required>
                         <div class="invalid-feedback">
                            Please provide product cost
                         </div>
                     </div>
                    </div>
                    <div class="col-lg-4">
                     <div class="form-group">
                         <label class="control-label">Product Price</label>
                         <input type="text" name="price" class="form-control" value="{{ $product->price ?? old('price')}}" placeholder="product selling price" required>
                         <div class="invalid-feedback">
                             Please enter product selling price
                         </div>
                     </div>
                    </div>
                    <div class="col-lg-4">
                       <div class="form-group">
                         <label>Alert Quantity</label>
                         <input type="number" class="form-control" name="alert_quantity" value="{{$product->alert_quantity ?? old('alert_quantity')}}">
                       </div>
                    </div>
                 </div>

                 <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Product Unit</label>
                            <select name="product_unit" class="form-control select2">
                                <option value="" selected disabled>select product unit</option>
                                @foreach (App\Models\Unit::get() as $unit)
                                <option value="{{$unit->id}}" {{($unit->id == $product->product_unit_id) ? 'selected': ''}}>{{$unit->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Sale Unit</label>
                            <select name="sale_unit" class="form-control select2">
                                <option value="" selected disabled>select sale unit</option>
                                @foreach (App\Models\Unit::get() as $unit)
                                <option value="{{$unit->id}}" {{($unit->id == $product->sale_unit_id) ? 'selected': ''}}>{{$unit->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label class="control-label">Purchase Unit</label>
                            <select name="purchase_unit" class="form-control select2">
                                <option value="" selected disabled>select purchase unit</option>
                                @foreach (App\Models\Unit::get() as $unit)
                                <option value="{{$unit->id}}" {{($unit->id == $product->purchase_unit_id) ? 'selected': ''}}>{{$unit->name}}</option>
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
                            <option value="" selected>No Tax</option>
                            @foreach (App\Models\Tax::get() as $tax)
                            <option value="{{$tax->id}}" {{($tax->id == $product->tax_id) ? 'selected': ''}}>{{$tax->name}}</option>
                            @endforeach
                        </select>
                     </div>
                    </div>
                    <div class="col-lg-6">
                     <div class="form-group">
                         <label class="control-label">Tax Method</label>
                         <select name="tax_method" value="{{$product->tax_method}}" class="form-control select2">
                            <option value="">No Tax Method</option>
                            <option>Inclusive</option>
                            <option>Exclusive</option>
                        </select>
                     </div>
                    </div>
                    
                 </div>
                
                <div class="form-group">
                    <label class="control-label">Details</label>
                    <x-input.filemanager.tinymce :name="'details'" :value="$product->details" />
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