@extends('layouts.app')

@push('page-css')

@endpush

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Expense</h4>
            <form action="{{route('expenses.update',$expense)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input id="amount" type="text" class="form-control" value="{{$expense->amount}}" name="amount" placeholder="Enter amount">
                </div>
                <div class="form-group">
                    <label for="permissions">Expense Category</label>
                    <x-input.select2.single :options="$categories" :name="'expense_category'" :key="'name'" :selected="$expense->expenseCategory->name" />
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" name="comment" id="comment" cols="10" rows="5">{{$expense->comment}}</textarea>
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

@endpush