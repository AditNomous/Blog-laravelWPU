<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function loadpost()
    {
        $posts = Post::all();
        return view('blog/tablepost', compact('posts'));
    }

    public function loadcreatepost()
    {
        $users = User::all();
        $categories = Category::all(); // Mengambil semua kategori
        return view('blog/createpost', compact('categories','users'));
    }

    public function createpost(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'slug' => 'required|unique:posts',
            'body' => 'required'
        ]);

        try {
            $new_post = new Post();
            $new_post->title = $request->title;
            $new_post->author_id = $request->author; // Menyimpan ID author (penulis)
            $new_post->category_id = $request->category; // Menyimpan ID kategori
            $new_post->slug = $request->slug;
            $new_post->body = $request->body;
            $new_post->save();

            return redirect('/posts')->with('success', ' New Post Success');
        } catch (\Exception $e) {
            return redirect('/createpost')->with('fail', $e->getMessage());
        }
    }
}
