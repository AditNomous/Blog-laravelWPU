<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function update(Request $request)
{
    // Validasi input
    $request->validate([
        'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
    ]);

    // Ambil user yang sedang login
    $user = auth::user();

    // Cek apakah ada file gambar yang diupload
    if ($request->hasFile('profile_picture')) {
        // Simpan gambar ke direktori storage/app/public/profile_pictures
        $fileName = time() . '.' . $request->profile_picture->extension();
        $request->profile_picture->move(public_path('profile_picturesD:\repo git\Blog-laravelWPU\public\img\profile_pictures'), $fileName);

        // Simpan path gambar di database
        $user->profile_picture = $fileName;
    }

    // Simpan perubahan user
    $user->save();

    return redirect()->back()->with('success', 'Profile updated successfully.');
}

}
