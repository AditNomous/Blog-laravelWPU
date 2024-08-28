<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h3 class="text-xl">ini adalah blog</h3>
    @foreach ($posts as $post)
    <article class="py-8 max-w-screen-md border-b border-gray-600" >
      <h2 class="mb-1 text-3xl font-bold text-gray-900">{{$post['title']}}</h2>
      <div class="text-base text-gray-500">
        <a  href="/posts/{{$post['slug']}}" >{{$post['author']}} | 26 januari 2024</a>
      </div>
      <p class="my-4 font-light">{{ Str::limit($post['body'],150)}}</p>
      <a href="/posts/{{$post['slug']}}" class="font-medium text-blue-500 hover:underline" href="">Read more &raquo;</a>
    </article>
@endforeach
  </x-layout>   
