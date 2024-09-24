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
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        ]);
    
        // Buat user terlebih dahulu
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);
    
        // Cek apakah ada file profile_picture yang di-upload
        if ($request->hasFile('profile_picture')) {
            // Simpan gambar ke direktori public/profile_pictures
            $fileName = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->move(public_path('profile_pictures'), $fileName);
    
            // Simpan path gambar di database
            $user->profile_picture = $fileName;
            $user->save(); // Simpan perubahan user
        }
    
        Auth::login($user);

        // Redirect ke halaman yang diinginkan setelah login
        return redirect('/home')->with('success', 'Register successfully, and you are now logged in!');
        // Setelah semuanya selesai, baru redirect
    }
    
    //     if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
    //         $request->session()->regenerate();

    //         return redirect()->intended('home');
    // }
}