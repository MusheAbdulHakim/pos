@extends('layouts.auth')

@section('form')
<form class="form-horizontal" action="{{route('login.unlock')}}" method="post">
    @csrf
    <div class="user-thumb text-center mb-4">
        <img src="assets/images/users/avatar-1.jpg" class="rounded-circle img-thumbnail avatar-md" alt="thumbnail">
        <h5 class="font-size-15 mt-3">{{auth()->user()->name}}</h5>
    </div>

    <div class="form-group">
        <label for="userpassword">Password</label>
        <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password">
    </div>

    <div class="form-group row mb-0">
        <div class="col-12 text-right">
            <button class="btn btn-primary btn-block w-md waves-effect waves-light" type="submit">Unlock</button>
        </div>
    </div>
</form>
@endsection

@push('form-footer')
<p>Not you ? return <a href="{{route('login')}}" class="font-weight-medium text-primary"> Sign In </a> </p>
@endpush

