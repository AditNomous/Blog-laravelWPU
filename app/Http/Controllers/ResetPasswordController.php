<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    
        public function showResetForm($token)
        {
            return view('auth.passwords.reset', ['token' => $token]);
        }
    
        public function reset(Request $request)
        {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8',
                'token' => 'required'
            ]);
    
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->password = Hash::make($password);
                    $user->save();
                    Auth::login($user);
                }
            );
    
            return $status === Password::PASSWORD_RESET
                        ? redirect()->route('home')->with('status', __($status))
                        : back()->withErrors(['email' => [__($status)]]);
        }
}
