<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Contracts\Service\Attribute\Required;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['Required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8','confirmed'],
            
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);
        return redirect('/')->with('success', 'Register successfully!');
        
      
    //     if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
    //         $request->session()->regenerate();

    //         return redirect()->intended('home');
    // }
}

}