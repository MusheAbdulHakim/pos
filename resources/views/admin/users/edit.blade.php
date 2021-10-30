@extends('layouts.app')

@push('page-css')
    
@endpush

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Create User</h4>

            <form action="{{route('user.update',$user)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control" value="{{$user->name}}" name="name" placeholder="Enter name">
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input id="username" type="text" value="{{$user->username}}" class="form-control" name="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" value="{{$user->email}}" class="form-control" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                        @foreach ($roles as $role)
                        <option {{$user->hasRole($role->name) ? 'selected' : ''}} >{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" class="form-control" name="password" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input id="confirm_password" type="password" class="form-control" name="password_confirmation" placeholder="Repeat password">
                </div>
                <div class="form-group">
                    <label for="avatar">Avatar</label>
                    <input type="file" name="avatar" class="form-control" id="avatar">
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