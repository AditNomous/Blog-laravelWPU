<?php
use App\Http\Controllers\PostController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', function () {
    return view('login');
});

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
    return view('blog/posts', ['title' => 'Blog', 'posts' => Post::filter(request
    (['search','category', 'author']))->latest()->get()]);
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
