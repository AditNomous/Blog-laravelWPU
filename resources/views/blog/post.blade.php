<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
   
    <article class="py-8 max-w-screen-md" >
      <h2 class="text-center mb-1 text-3xl font-bold text-gray-900">{{$post['title']}}</h2>
      <div class="text-base text-gray-500">
        <a  href="/posts" >{{$post->author->name}} |{{$post -> created_at ->  format('l j F Y')}}</a>
      </div>
      <p class="my-4 font-light">{!! $post['body']!!}}</p>
      <a href="/posts/" class="font-medium text-blue-500 hover:underline" href="">&laquo; Back to Post</a>
    </article>
  </x-layout>   

