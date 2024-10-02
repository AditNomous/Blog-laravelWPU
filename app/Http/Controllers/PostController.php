<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;





class PostController extends Controller
{
    

    public function loadpostsguest()
    {
      
        $users = User::all();
        $categories = Category::all(); 
        $posts = Post::with(['author', 'category'])->filter(request(['search','category', 'author']))
        ->latest()->paginate(12)->withQueryString();
        $title = 'Posts';
        return view('blog/guestposts', compact('posts','title','categories','users'));
    }
 
    public function loadindex()
    {
        $users = User::all();
        $categories = Category::all(); // Mengambil semua kategori
       
        $posts = Post::latest()->take(4)->get();
        return view('index', compact('categories','users','posts'));
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
            'category' => 'required',
            'body' => 'required'
        ]);

        try {
            $new_post = new Post();
            $new_post->title = $request->title;
            $new_post->author_id = Auth::id();
            $new_post->category_id = $request->category; // Menyimpan ID kategori
            $new_post->slug = Str::slug($request->input('title'), '-');
            $new_post->body = $request->body;
            $new_post->cover = $request->cover;
            $new_post->save();

            if ($request->hasFile('cover')){
            $fileName = time(). '.' . $request->cover->extension();
            $request->cover->move(public_path('cover'), $fileName);
            $new_post->cover=$fileName;
            $new_post->save();
            }

            return redirect('/posts')->with('createsuccess', ' New Post Success');
        } catch (\Exception $e) {
            return redirect('/create')->with('fail', $e->getMessage());
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
                'body' => $request->body,
                'slug' => Str::slug($request->input('title'), '-'),
                'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
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

    
    public function like(Post $post){
        if (!$post->likedBy(Auth::user())){
            $post->likes()->create([
                'user_id' => Auth::id()
            ]);
        }
        return back();
    }

    public function unlike(Post $post)
{
    $post->likes()->where('user_id', Auth::id())->delete();

    return back();
}
public function comment(Request $request, Post $post)
{
    $request->validate([
        'body' => 'required',
    ]);

    $post->comments()->create([
        'user_id' => auth::id(),
        'body' => $request->body,
    ]);

    return back();
}


}
