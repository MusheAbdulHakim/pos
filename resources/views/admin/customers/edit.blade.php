@extends('layouts.app')

@push('page-css')

@endpush


@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Customer</h4>
            <form action="{{route('customers.update',$customer)}}" method="post" class="needs-validation" novalidate>
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" value="{{$customer->name}}" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="type_name">Customer Type</label>
                        <x-input.select2.single :selected="$customer->customerType->name" :name="'customer_type'" :options="$customertypes" :key="'name'" />
                        <div class="invalid-feedback">
                            Please enter customer type
                        </div> 
                    </div>   
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input id="phone" type="tel" value="{{$customer->phone}}" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{$customer->email}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" value="{{$customer->address}}" class="form-control">
                    </div>                                                
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('page-js')
    
@endpush