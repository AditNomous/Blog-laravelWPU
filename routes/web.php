<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Post;

Route::get('/', function () {
    return view('home', ['title' => 'Home page']);
});
Route::get('welcome', function () {
    return view('welcome');
});

Route::get('about', function () {
    return view('about', ['title' => 'About']);
});

Route::get('home', function () {
    return view('home', ['title' => 'Home page']);
});

Route::get('/posts', function () {
    return view('posts', ['title' => 'Blog', 'posts' => Post::all()]);
});  

Route::get('/posts/{slug}', function($slug){

        $post = Post::find($slug);

        return view('post',['title' => 'Single Post', 'post' => $post]);
});

Route::get('contact', function () {
    return view('contact', ['title' => 'contact']);
});