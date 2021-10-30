<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);
    }
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

    public function locked(){
        $title = 'lock screen';
        if(!session('lock-expires-at')){
            return redirect('/');
        }
        if(session('lock-expires-at') > now()){
            return redirect('/');
        }
        return view('auth.lockscreen',compact('title'));
    }

    public function unlock(Request $request)
    {
        $check = Hash::check($request->input('password'), $request->user()->password);

        if(!$check){
            return redirect()->route('login.locked')->withErrors([
                'Your password does not match your profile.'
            ]);
        }

        session(['lock-expires-at' => now()->addMinutes($request->user()->getLockoutTime())]);

        return redirect('/');
    }
}
