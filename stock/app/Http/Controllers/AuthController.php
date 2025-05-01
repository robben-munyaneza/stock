<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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

        return redirect()->route('auth.login')->with('success', 'user registered successfully');
    }

    public function showLoginForm()
{
    return view('auth.login'); // Make sure this Blade file exists
}

public function login(Request $request){
    
}

}
