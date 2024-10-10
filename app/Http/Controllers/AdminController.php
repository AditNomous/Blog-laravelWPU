<?php namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Menampilkan halaman postingan
    public function showPosts()
    {
        $posts = Post::all();
        return view('admin.posts', compact('posts'));
    }

    // Halaman create post
    public function createPost()
    {
        return view('admin.create-post');
    }

    // Menyimpan post baru
    public function storePost(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required'
        ]);

        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.posts')->with('success', 'Post created successfully!');
    }

    // Halaman create category
    public function createCategory()
    {
        return view('admin.create-category');
    }

    // Menyimpan kategori baru
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'color' => 'required'
        ]);

        Category::create([
            'name' => $request->name,
            'color' => $request->color,
        ]);

        return redirect()->route('admin.posts')->with('success', 'Category created successfully!');
    }

    // Menampilkan halaman mengelola user
    public function manageUsers()
    {
        $users = User::all();
        return view('admin.manage-users', compact('users'));
    }

    // Menghapus user
    public function deleteUser($id)
    {
        User::destroy($id);
        return redirect()->route('admin.manageUsers')->with('success', 'User deleted successfully!');
    }
}
