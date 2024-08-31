<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-10 back">
      @foreach ($posts as $post)
          <article class="py-10 max-w-screen-md border-b border-gray-600 bg-blue-100 rounded-lg">
              <div class="flex items-center justify-between">
                  <h2 class="text-3xl font-bold text-gray-900">{{$post['title']}}</h2>
                  <p>{{$post->created_at->diffForHumans()}}</p>
              </div>

              <div>
                  <a href="/authors/{{$post->author->username}}" class="text-base text-gray-500 hover:underline italic">{{$post->author->name}} |</a>
                  <a href="/categori" class="text-base text-gray-500 hover:underline italic">{{$post->author->name}}</a>
                  <br>
                  <a>{{$post->created_at->format('l j F Y')}}</a>
              </div>

              <p class="my-4 font-light">{{ Str::limit($post['body'], 150)}}</p>
              <a href="/posts/{{$post['slug']}}" class="font-medium text-blue-500 hover:underline">Read more &raquo;</a>
          </article>
      @endforeach
  </div>
</x-layout>