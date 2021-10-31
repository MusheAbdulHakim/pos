@extends('layouts.app')

@push('page-css')
    
@endpush

@section('content')
<div class="col-md-12 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="profile-widgets py-3">

                <div class="text-center">
                    <div class="">
                        <img src="{{!empty(auth()->user()->avatar) ? asset('storage/users/'.auth()->user()->avatar): asset('assets/images/users/avatar-2.jpg')}}" alt="avatar" class="avatar-lg mx-auto img-thumbnail rounded-circle">
                        <div class="online-circle"><i class="fas fa-circle text-success"></i></div>
                    </div>

                    <div class="mt-3 ">
                        <a href="#" class="text-dark font-weight-medium font-size-16">Patrick Becker</a>
                        <p class="text-body mt-1 mb-1">
                            @foreach (auth()->user()->roles as $role)
                            {{$role->name}}
                            @endforeach
                        </p>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Personal Information</h5>
            <div class="mt-3">
                <div class="font-size-12 text-muted mb-1">Name</div>
                <h6>{{auth()->user()->name}}</h6>
            </div>
            <div class="mt-3">
                <div class="font-size-12 text-muted mb-1">Username</div>
                <h6>{{auth()->user()->username}}</h6>
            </div>

            <div class="mt-3">
                <p class="font-size-12 text-muted mb-1">Email Address</p>
                <h6 class="">{{auth()->user()->email}}</h6>
            </div>

            <div class="mt-3">
                <div class="font-size-12 text-muted mb-1">Username</div>
                <h6>{{auth()->user()->username}}</h6>
            </div>

        </div>
    </div>
</div>

<div class="col-md-12 col-xl-9">  
    <div class="card">
        <div class="card-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">
                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                        <span class="d-none d-sm-block">Profile</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#password" role="tab">
                        <span class="d-none d-sm-block">Password</span>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content p-3 text-muted">
                <div class="tab-pane active" id="profile" role="tabpanel">
                    <form action="{{route('profile.update',auth()->user()->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="name" name="name" value="{{auth()->user()->name}}" class="form-control">
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" value="{{auth()->user()->username}}" id="username">
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{auth()->user()->email}}" id="email">
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="lockscreen">LockScreen Time</label>
                                    <input type="number" class="form-control" name="lockscreen" value="{{auth()->user()->lockout_time}}" id="email">
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                    <input type="file" name="avatar" class="form-control" id="avatar">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <Button type="submit" class="btn btn-block btn-primary">Update</Button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tab-pane" id="password" role="tabpanel">
                    <form action="{{route('profile.updatePassword',auth()->user()->id)}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="old_password">Current Password</label>
                                    <input type="password" class="form-control" name="current_password" id="old_password">
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password_confirm">Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirm">
                                </div>
                            </div> <!-- end col -->
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <Button type="submit" class="btn btn-block btn-primary">Update Password</Button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>   
@endsection

@push('page-js')
   
@endpush
