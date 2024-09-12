<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function loadAllUser(){
        return view('blog/createpost');
    }
}
