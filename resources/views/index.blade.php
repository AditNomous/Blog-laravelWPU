<x-layout>
    <body class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 min-h-screen flex flex-col justify-between">
        
        <!-- Header -->
        <header class="container mx-auto flex justify-between items-center p-6">
            <div class="flex items-center space-x-3">
                <h1 class="text-white text-2xl font-bold">TechWire</h1>
                <div class="flex space-x-6 text-white text-lg font-medium">
                    @foreach ($categories as $item)
                        <a href="posts?category={{ $item->slug }}" class="hover:underline transition duration-300 ease-in-out transform hover:scale-105">{{ $item->name }}</a>
                    @endforeach
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="container mx-auto flex flex-col lg:flex-row p-6 lg:space-x-8 space-y-6 lg:space-y-0">
            
            <!-- Main Content (Featured Post) -->
            <div class="w-full lg:w-2/3 bg-white rounded-lg shadow-lg overflow-hidden transition duration-300 transform hover:scale-105">
                <img src="{{ asset('cover/' . $featuredPost->cover) }}" alt="{{ $featuredPost->title }}" class="w-full h-64 object-cover hover:opacity-90 transition duration-300">
                <div class="p-6">
                    <p class="text-purple-600 font-semibold uppercase">{{ $featuredPost->category->name }}</p>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $featuredPost->title }}</h2>
                    <div class="text-gray-600 flex items-center space-x-4 mb-4">
                        <span>by {{ $featuredPost->author->name }}</span>
                        <span>|</span>
                        <span>{{ $featuredPost->created_at->format('F j, Y') }}</span>
                        <span>|</span>
                        <span>{{ $featuredPost->comments_count }} Comments</span>
                    </div>
                    <p class="text-gray-700">{{ Str::limit(strip_tags($featuredPost->body), 150, '...') }}</p>
                    <a href="/posts/{{ $featuredPost->slug }}" class="inline-flex items-center mt-4 font-medium text-primary-600 hover:underline">Read more</a>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="w-full lg:w-1/3 space-y-6">
                @foreach ($posts as $post)
                    <article class="bg-white p-4 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                        <!-- Kategori dan Tanggal -->
                        <div class="flex justify-between items-center text-gray-500 mb-4">
                            <a href="/posts?category={{ $post->category->slug }}" class="bg-{{ $post->category->color }}-100 text-xs font-medium inline-flex items-center px-2.5 rounded">
                                {{ $post->category->name }}
                            </a>
                            <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        
                        <!-- Gambar Cover -->
                        <img src="{{ asset('cover/' . $post->cover) }}" alt="{{ $post->title }}" class="w-full h-32 object-cover rounded-md hover:opacity-90 transition duration-300 mb-4">
                        
                        <!-- Judul dan Konten -->
                        <h3 class="text-lg font-bold text-gray-800">
                            <a href="/posts/{{ $post->slug }}">{{ $post->title }}</a>
                        </h3>
                        <p class="text-gray-500 mt-2">{{ Str::words(strip_tags($post->body), 5, '...') }}</p>
                        
                        <!-- Penulis dan Tombol "Read More" -->
                        <div class="mt-4 flex justify-between items-center">
                            <div class="flex items-center space-x-2">
                                <img src="/profile_pictures/{{ $post->author->profile_picture ?? 'default.png' }}" class="w-6 h-6 rounded-full">
                                <a href="/posts?author={{ $post->author->username }}" class="text-sm font-medium text-gray-700">{{ $post->author->name }}</a>
                            </div>
                            <a href="/posts/{{ $post->slug }}" class="inline-flex items-center font-medium text-primary-600 hover:underline">Read more</a>
                        </div>
                    </article>
                @endforeach
            </aside>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 py-4 text-center text-white font-medium text-sm">
            <div class="container mx-auto">
                &copy; 2024 TechWire. All rights reserved.
            </div>
        </footer>

    </body>
</x-layout>
