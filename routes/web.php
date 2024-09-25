<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\auth;
use App\Models\Post;


Route::get('/', [PostController::class, 'loadindex']);
Route::get('/guest', [PostController::class, 'loadpostguest']);
Route::get('/index', [PostController::class, 'loadindex']);


Route::get('/home', function () {
    return view('home', ['title' => 'Home page']);
});

Route::get('welcome', function () {
    return view('welcome');
});

Route::get('about', function () {
    return view('about', ['title' => 'About']);
});

Route::get('/posts', function () {
    return view('blog/guestposts', ['title' => 'Blog', 'posts' => Post::filter(request
    (['search','category', 'author']))->latest()->paginate(12)->withQueryString()]);
});  

Route::get('/categories/{category:slug}', function(Category $category){
    return view('blog/posts', ['title' => 'Articles by category ' . $category->name, 'posts' => $category->posts]);
});

Route::get('/posts/{post:slug}', function(Post $post){
    return view('blog/post', ['title' => 'Single Post', 'post' => $post]);
});

Route::get('/authors/{user:username}', function(User $user){
    return view('blog/posts', ['title' => count($user->posts) . ' Articles by ' . $user->name, 'posts' => $user->posts]);
});


Route::get('contact', function () {
    return view('contact', ['title' => 'Contact']);
});

Route::get('/table', [PostController::class, 'loadpost']);

Route::get('/create', [PostController::class, 'loadcreatepost'])->name('loadcreatepost');

Route::post('/create', [PostController::class, 'createpost'])->name('createpost');

Route::get('/delete/{id}', [PostController::class, 'deletepost'])->name('deletepost');

Route::get('/edit/{id}', [PostController::class, 'loadeditpost'])->name('loadeditpost');

Route::post('/edit', [PostController::class, 'editpost'])->name('editpost');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'loginPost'])->name('login.store');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function () {
        return view('home', ['title' => 'Home page']);
    });
    Route::delete('/logout', [LoginController::class, 'logout'])->name('logout');
    });

    Route::get('/yourposts', function () {
        return view('yourposts', [
            'title' => 'Your Posts',
            'yourposts' => Post::where('author_id', Auth::id()) // Ambil postingan milik user yang sedang login
                ->filter(request(['search', 'category', 'author'])) // Masih bisa menggunakan filter search, category, dll.
                ->latest()
                ->paginate(12)
                ->withQueryString()
        ]);
    })->middleware('auth');


    