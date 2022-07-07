<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\If_;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'users';
        If($request->ajax()){
            $data = User::get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('avatar',function($user){
                        $img = !empty($user->avatar) ? asset('storage/users/'.$user->avatar): asset('assets/images/users/avatar-1.jpg');
                        return '<img src="'.$img.'" class="rounded-circle avatar-md" />';
                    })
                    ->addColumn('action',function ($user){
                        $editbtn = '<a href="'.route('users.edit',$user->id).'" class="edit"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a>';
                        $deletebtn = '<a data-id="'.$user->id.'" data-route="'.route('users.destroy',$user->id).'" href="javascript:void(0)" id="deletebtn"><button class="btn btn-danger"><i class="fas fa-trash"></i></button></a>';
                        if(!auth()->user()->hasPermissionTo('edit-user')){
                            $editbtn = '';
                        }
                        if(!auth()->user()->hasPermissionTo('destroy-user')){
                            $deletebtn = '';
                        }
                        $btn = $editbtn.' '.$deletebtn;
                        return $btn;
                    })
                    ->rawColumns(['avatar','action'])
                    ->make(true);
        }
        return view('admin.users.index',compact(
            'title'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'create user';
        $roles = Role::get();
        return view('admin.users.create',compact(
            'title','roles'
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
            'name' => 'required|min:5|max:200',
            'email' => 'required|email',
            'username' => 'required|min:3|max:200',
            'password' => 'required|min:3|max:255|confirmed',
            'avatar' => 'nullable|file|image|mimes:jpg,jpeg,png,gif'
        ]);
        $imageName = null;
        if($request->hasFile('avatar')){
            $imageName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('storage/users'), $imageName);
        }
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'avatar' => $imageName,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($request->role);
        $notifiation = notify('user created successfully');
        return redirect()->route('users.index')->with($notifiation);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  model $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $title = 'edit user';
        $roles = Role::get();
        return view('admin.users.edit',compact(
            'title','user','roles'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  model $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'name' => 'required|min:5|max:200',
            'email' => 'required|email',
            'username' => 'nullable|min:3|max:200',
            'password' => 'nullable|min:3|max:255|confirmed',
            'avatar' => 'nullable|file|image|mimes:jpg,jpeg,png,gif'
        ]);
        $imageName = $user->avatar;
        $password = $user->password;
        if($request->hasFile('avatar')){
            $imageName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('storage/users'), $imageName);
        }
        if(!empty($request->password)){
            $password = Hash::make($request->password);
        }
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'avatar' => $imageName,
            'password' => $password,
        ]);
        foreach($user->getRoleNames() as $userRole){
            $user->removeRole($userRole);
        }
        $user->assignRole($request->role);
        $notification = notify('user updated successfully');
        return redirect()->route('users.index')->with($notification);
    }
    
    public function profile(){
        $title = 'user profile';
        return view('admin.users.profile',compact(
            'title'
        ));
    }

    public function updateProfile(Request $request,User $user){
        $this->validate($request,[
            'name' => 'required|min:5|max:200',
            'email' => 'required|email',
            'username' => 'nullable|min:3|max:200',
            'avatar' => 'nullable|file|image|mimes:jpg,jpeg,png,gif'
        ]);
        $imageName = $user->avatar;
        if($request->hasFile('avatar')){
            $imageName = time().'.'.$request->avatar->extension();
            $request->avatar->move(public_path('storage/users'), $imageName);
        }
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'avatar' => $imageName,
        ]);
        $notification = notify('profile updated successfully');
        return redirect()->route('profile')->with($notification);
    }

    /**
     * Update current user password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        $this->validate($request, [
            'current_password'=>'required',
            'password'=>'required|max:200|confirmed',
        ]);

        if (password_verify($request->current_password, $user->password)) {
            $user->update(['password'=>Hash::make($request->password)]);
            $notification = notify('User password updated successfully!!!');
            $logout = auth()->logout();
            return back()->with($notification, $logout);
        } else {
            $notification = notify("Old Password do not match!!!",'danger');
            return back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       return User::findOrFail($request->id)->delete();
         
    }
}
