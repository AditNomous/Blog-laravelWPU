<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
    return view('auth/login');
    }
    public function loginPost(Request $request)
    {
    $credetials = [
    'email' => $request->email,
    'password' => $request->password,
    ];
    if (Auth::attempt($credetials)) {
    return redirect('/home')->with('success', 'Login berhasil');
    }
    return back()->with('error', 'Email or Password salah');
    }

    public function logout()
{
  Auth::logout();
  return redirect()->route('login');
}
}
