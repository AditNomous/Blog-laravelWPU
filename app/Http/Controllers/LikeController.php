<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Post $post)
{
    $user = Auth::user(); // Dapatkan user yang login

    // Cek apakah user sudah like post ini
    if ($post->likedBy($user)) {
        // Jika sudah like, kita hapus like
        $post->likes()->where('user_id', $user->id)->delete();

        return response()->json([
            'status' => 'unliked',
            'likeCount' => $post->likes()->count(),
        ]);
    }

    // Jika belum like, tambahkan like
    $post->likes()->create([
        'user_id' => $user->id,
    ]);

    return response()->json([
        'status' => 'liked',
        'likeCount' => $post->likes()->count(),
    ]);
}

}
