<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    
    public function index(){
        $title = 'login';
        return view('auth.login',compact(
            'title'
        ));
    }

    public function login(Request $request){
        $this->validate($request,[
            'username' => 'required',
            'password' => 'required'
        ]);
        $authenticate = auth()->attempt($request->only('username','password'),$request->rememberme);
        if(!$authenticate){
            return back()->withErrors(['Incorrect user credentials']);
        }
        return redirect()->route('dashboard');
        
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }

    
}
