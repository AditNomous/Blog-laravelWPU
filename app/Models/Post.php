<?php



namespace App\Models;
use Illuminate\Support\Arr;
class Post
{
    public static function all(){
        return [
            [
                'id' => 1,
                'slug' => 'judul Artikel-1' ,
                'title' => 'judul Artikel 1' ,
                'author' => 'Aditya Nugroho',
                'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.
                           Provident porro eum similique inventore dolorem ad sit officia est assumenda,
                           consectetur, perferendis atque tempore nostrum reiciendis sequi veritatis nam quam ex.'
            ],
            [
                'id' => 2,
                'slug' => 'judul Artikel-2' ,
                'title' => 'judul Artikel 2' ,
                'author' => 'Aditya Nugroho',
                'body' => 'ipsum dolor sit amet consectetur adipisicing elit .
                           Provident porro eum similique inventore dolorem ad sit officia est assumenda,
                           consectetur',
            ]
            ];
    }
        public static function find($slug)
        {
        // return Arr::first(static::all(), function($post) use ($slug){
        //         return $post['slug'] == $slug;
        //     });    

        $post = Arr::first(static::all(), fn($post) => $post['slug'] == $slug);

        if(!$post){
            abort(404);
        }

        return $post;
     }
     
}
