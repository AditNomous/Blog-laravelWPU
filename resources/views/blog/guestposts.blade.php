<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

    @if (Session::has('createsuccess'))
        <div id="create-success-alert" class="mb-4 p-3 bg-green-500 text-white rounded fade-out success-alert">
            {{ Session::get('createsuccess') }}
        </div>
    @endif
    <script>
        document.addEvenListener("DOMContentLoaded", function(){
        const createSuccessAlert = document.getElementById('create-success-alert')

        if (createSuccessAlert) {
            setTimeout(() => {
                createSuccessAlert.classList.add('opacity-0');
            
                setTimeout(() => {
                    createSuccessAlert.remove();
                },500);
            
            }, 3000);
        }


    });
    </script>


    <body style="background: url('img/bg.jpeg'); background-size: cover; height:fit-content;margin: 0;">


        <form>
            @if (request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            @if (request('author'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search Posts..." name="search" />
                <button type="submit"
                    class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>

        </form>

        <div class="container flex justify-center space-x-4 mt-8 px-6">
            <!-- Categories -->
            @foreach ($categories as $item)
                <div class="flex space-x-4 ">

                    <a href="/posts?category={{ $item->slug }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-full transition duration-300">{{ $item->name }}</a>

                </div>
            @endforeach
        </div>




        <div>
            <div class="mt-10 grid gap-8 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($posts as $post)
                <article class="rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 flex flex-col justify-between">
                    <!-- Bagian Kategori dan Tanggal -->
                    <div>
                        <div class="bg-red-50 flex justify-between items-center text-gray-500 p-2">
                            <a href="/posts?category={{ $post->category->slug }}"
                                class="bg-{{ $post->category->color }}-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                {{ $post->category->name }}
                            </a>
                            <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                
                        <!-- Gambar cover dengan 60% dari tinggi artikel -->
                        <div style="background-image: url('cover/{{ $post->cover }}'); background-size: cover; background-position: center;"
                            class="w-full aspect-[3/2]"> <!-- Ratio aspect bisa disesuaikan -->
                        </div>
                
                        <!-- Judul dan Konten Post -->
                        <h2 class="my-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white px-4">
                            <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
                        </h2>
                        <p class="px-4 text-gray-500 dark:text-gray-400">
                            {!! \Illuminate\Support\Str::words(strip_tags($post->body), 5, '...') !!}
                        </p>
                    </div>
                
                    <!-- Bagian Penulis dan Tombol Read More -->
                    <div class="bg-blue-200 p-2 flex justify-between items-center mt-auto"> 
                        <div class="flex items-center space-x-4">
                            @if ($post->author->profile_picture)
                                <img src="/profile_pictures/{{ $post->author->profile_picture }}" class="w-7 h-7 rounded-full">
                            @else
                                <img src="/profile_pictures/default.png" class="w-7 h-7 rounded-full">
                            @endif
                            <a href="/posts?author={{ $post->author->username }}" class="font-medium dark:text-white">
                                {{ $post->author->name }}
                            </a>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                            </svg>
                            
                        </div>
                
                        <a href="/posts/{{ $post->slug }}"
                            class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                            Read more
                            <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                    <div>
                        <div class="flex justify-between items-center">
                            <!-- Bagian Like -->
                            <form method="POST" action="{{ route('posts.like', $post) }}">
                                @csrf
                                @if ($post->likedBy(auth()->user()))
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                        </svg> Unlike
                                    </button>
                                @else
                                    <button type="submit" class="text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                        </svg> Like
                                    </button>
                                @endif
                            </form>
                            <span>{{ $post->likes->count() }} likes</span>
                        
                            <!-- Bagian Comment -->
                            <form method="POST" action="{{ route('posts.comment', $post) }}" class="w-full">
                                @csrf
                                <textarea name="body" class="w-full p-2 mt-2 border rounded" placeholder="Add a comment"></textarea>
                                <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded">Comment</button>
                            </form>
                        
                            <ul class="mt-4">
                                @foreach ($post->comments as $comment)
                                    <li class="border-b border-gray-200 py-2">
                                        <span class="font-semibold">{{ $comment->user->name }}:</span> {{ $comment->body }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        
                    </div>
                </article>
                
            
                @endforeach

            </div>
        </div>


        <!-- Footer -->
        <footer class="mt-16 bg-white py-4 shadow-lg">
            <div class="container mx-auto text-center text-gray-600">
                &copy; 2024 Your Website. All rights reserved.
            </div>
        </footer>

    </body>

    </html>

</x-layout>
