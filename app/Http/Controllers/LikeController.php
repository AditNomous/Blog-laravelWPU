<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Post $post)
    {
        $user = Auth::user();
    
        if ($post->likedBy($user)) {
            $post->likes()->where('user_id', $user->id)->delete();
    
            return response()->json([
                'status' => 'unliked',
                'likeCount' => $post->likes()->count(),
            ]);
        }
    
        $post->likes()->create([
            'user_id' => $user->id,
        ]);
    
        return response()->json([
            'status' => 'liked',
            'likeCount' => $post->likes()->count(),
        ]);
    }
    
}
