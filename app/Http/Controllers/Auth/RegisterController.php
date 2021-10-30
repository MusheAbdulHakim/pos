<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(){
        $title = 'register';
        return view('auth.register',compact(
            'title'
        ));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required|min:5|max:200',
            'email' => 'required|email',
            'username' => 'required|min:5|max:200',
            'password' => 'required|min:3|max:255|confirmed',
        ]);
        
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $authenticate = auth()->attempt(['email' => $request->email, 'password' => $request->password]);
        if($authenticate){
            return redirect()->route('dashboard');
        }
    }
}
