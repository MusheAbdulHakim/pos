<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'user roles';
        $roles = Role::get();
        return view('admin.roles.index',compact(
            'title','roles'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'create roles';
        $permissions = Permission::get();
        return view('admin.roles.create',compact(
            'title','permissions'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'role' => 'required|min:2|max:255',
            'permission' => 'required'
        ]);
        $role = Role::create(['name' => $request->role]);
        $role->syncPermissions($request->permission);
        $notification = notify('role created successfully');
        return redirect()->route('roles.index')->with($notification);
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  model $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $title = 'edit role';
        $permissions = Permission::get();
        return view('admin.roles.edit',compact(
            'title','permissions','role'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  model  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->validate($request,[
            'role' => 'required|min:2|max:255',
            'permission' => 'required'
        ]);
        $role->update([
            'name' => $request->role,
        ]);
        $role->syncPermissions($request->permission);
        return redirect()->route('roles.index')->with(notify('Role updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  model $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with(notify('Role deleted successfully'));
    }
}
