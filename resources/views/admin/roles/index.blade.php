@extends('layouts.app')

<x-assets.datatables />

@section('breadcrumb')
@can('create-role')
<x-buttons.primary :text="'create role'" :link="route('roles.create')"  />
@endcan
@endsection

@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">

            <h4 class="card-title">User Permission List</h4>

            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{$role->name}}</td>
                        <td>
                            @foreach ($role->getAllPermissions() as $permission)
                                <span class="badge badge-primary">{{ $permission->name }}</span>
                            @endforeach
                        </td>
                        <td class="text-center">
                            <a href="{{route('roles.edit',$role->id)}}" class="edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>
                            <a href="#" class="float-right">
                                <form action="{{route('roles.destroy',$role->id)}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button onclick="" type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection

@push('page-js')
    
@endpush