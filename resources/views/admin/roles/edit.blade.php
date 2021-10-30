@extends('layouts.app')

@push('page-css')
<link href="{{asset('assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Role</h4>

            <form action="{{route('roles.update',$role)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" type="text" class="form-control" value="{{$role->name}}" name="role">
                </div>
                <div class="form-group">
                    <label for="permissions">Permissions</label>
                    <select name="permission[]" id="permissions" class="form-control select2" multiple data-placeholder="choose permission">
                        @foreach ($permissions as $permission)
                            <option {{$role->hasPermissionTo($permission->name) ? 'selected': ''}}>{{$permission->name}}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <button class="btn btn-primary btn-block" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('page-js')
    <script src="{{asset('assets/libs/select2/js/select2.min.js')}}"></script>
    <!-- form advanced init -->
    <script src="{{asset('assets/js/pages/form-advanced.init.js')}}"></script>
@endpush