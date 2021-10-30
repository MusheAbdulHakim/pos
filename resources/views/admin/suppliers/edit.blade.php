@extends('layouts.app')

@push('page-css')

@endpush


@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Supplier</h4>
            <form action="{{route('suppliers.update',$supplier)}}" method="post" class="needs-validation" novalidate>
                @csrf
                @method("PUT")
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input id="name" type="text" value="{{$supplier->name}}" name="name" class="form-control" required>
                    </div>
                      
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input id="phone" type="tel" value="{{$supplier->phone}}" name="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" value="{{$supplier->email}}" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" value="{{$supplier->address}}" name="address" id="address" class="form-control">
                    </div>   
                    <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea name="note" id="comment" cols="10" rows="3" class="form-control">{{$supplier->note}}</textarea>
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