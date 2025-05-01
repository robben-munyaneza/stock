<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showRegisterForm(){
        return view('auth.signup');
    }

    public function signup(Request $request){

        $request->validate([
        'username'=>'required|string',
        'password'=>'required|min:3',

        ]);

        $data = $request->only('username', 'password');
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return redirect()->route('login.form')->with('success', 'user registered successfully');
    }

    public function showLoginForm()
{
    return view('auth.login'); // Make sure this Blade file exists
}
public function login(Request $request){
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|min:3',
    ]);

    $user = User::where('username', $request->username)->first(); // Get one user

    if ($user && Hash::check($request->password, $user->password)) {
        Session::put('userId', $user->id);
        Session::put('name', $user->username);

        return redirect()->route('dashboard');
    }
    return back()->with('error','Invalid credentials'); 

}




public function logout(){
    session()->forget('userId');

    return redirect('/login')->with('success', 'Logged out successfully');
}



}

