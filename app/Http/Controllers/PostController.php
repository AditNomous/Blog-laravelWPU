<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function loadpostguest()
    {
        $posts = Post::all();
        $title = 'Posts';
        return view('blog/guestposts', compact('posts', 'title') );
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
            'body' => 'required'
        ]);

        try {
            $new_post = new Post();
            $new_post->title = $request->title;
            $new_post->author_id = $request->author; // Menyimpan ID author (penulis)
            $new_post->category_id = $request->category; // Menyimpan ID kategori
            $new_post->slug = Str::slug($request->input('title'), '-');
            $new_post->body = $request->body;
            $new_post->save();

            return redirect('/posts')->with('success', ' New Post Success');
        } catch (\Exception $e) {
            return redirect('/createpost')->with('fail', $e->getMessage());
        }
    }
    public function editpost(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'body' => 'required'
        ]);

        
        try {
            Post::where('id',$request->post_id)->update([
                'title' => $request->title,
                'category_id' => $request->category, // Update category_id
                'body' => $request->body,
                'slug' => Str::slug($request->input('title'), '-')
            ]);
            return redirect('/posts')->with('success', 'Post updated successfully!');
        } catch (\Exception $e) {
            return back()->with('fail', 'Failed to update post.');
        }
            


       
    }

    public function loadeditpost($id){
        $post = Post::find($id);
        $users = User::all();
        $categories = Category::all();

    
    
    return view('blog/editpost', compact('post', 'users', 'categories'));

    }



    public function deletepost($id){
    try {
        Post::where('id',$id)->delete();
        return redirect('/posts')->with('success', 'Post deleted successfully!');
    } catch (\Exception $e) {
        return redirect('/posts')->with('fail', 'Failed to delete post.');
    }
}
}
