@extends('layouts.auth')

@section('form')
<form class="form-horizontal" method="post" action="{{route('register')}}">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" value="{{old('name')}}" id="name" placeholder="Enter name">
    </div>
    <div class="form-group">
        <label for="useremail">Email</label>
        <input type="email" class="form-control" name="email" value="{{old('email')}}"  id="useremail" placeholder="Enter email">
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="{{old('username')}}"  placeholder="Enter username">
    </div>

    <div class="form-group">
        <label for="userpassword">Password</label>
        <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Repeat password">
    </div>

    <div class="mt-4">
        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Register</button>
    </div>

</form>
@endsection

@push('form-footer')
<p>Already have an account ? <a href="{{route('login')}}" class="font-weight-medium text-primary"> Login</a> </p>
@endpush