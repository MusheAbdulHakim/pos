@extends('layouts.auth')

@section('form')
<form class="form-horizontal" method="post" action="{{route('login')}}">
    @csrf
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" value="{{old('username')}}" placeholder="Enter username" name="username">
    </div>

    <div class="form-group">
        <label for="userpassword">Password</label>
        <input type="password" class="form-control" id="userpassword"
            placeholder="Enter password" name="password">
    </div>

    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="rememberme" id="customControlInline">
        <label class="custom-control-label" for="customControlInline">Remember
            me</label>
    </div>

    <div class="mt-3">
        <button class="btn btn-primary btn-block waves-effect waves-light"
            type="submit">Log In</button>
    </div>

    <div class="mt-4 text-center">
        <a href="{{route('forgot-password')}}" class="text-muted"><i
                class="mdi mdi-lock mr-1"></i> Forgot your password?</a>
    </div>
</form>
@endsection

@push('form-footer')
<p>Don't have an account ? <a href="{{route('register')}}"
    class="font-weight-medium text-primary"> Signup now </a> </p>
@endpush