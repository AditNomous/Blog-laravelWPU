<x-layout>
    <body style="background: url('img/bg.jpeg') no-repeat center center fixed; background-size: cover; min-height: 100vh;">

        <div class="p-4">
            <div class="container mx-auto flex justify-center space-x-4 px-6">
                <!-- Categories --> 
                @foreach ($categories as $item)
                <div class="flex space-x-4 overflow-auto">
                    <a href="/posts?category={{ $item->slug }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-full transition duration-300">
                        {{ $item->name }}
                    </a>
                </div>
                @endforeach
            </div>
    
            <!-- Main Content -->
            <div class="container mx-auto mt-12 flex flex-col lg:flex-row px-6">
                <!-- Left Side (Create Post Button) -->
                @guest
                <div class="flex-grow flex justify-center items-center mb-12 lg:mb-0">
                    <a href="/login" class="bg-green-500 hover:bg-green-600 text-white font-bold text-lg py-6 px-12 rounded-full transition duration-300 transform hover:scale-105 shadow-lg">
                        Create yourPost
                    </a>
                </div>
                @endguest
    
                <!-- Right Side (Popular Posts) -->
                @auth
                <div class="flex-grow flex justify-center items-center mb-12 lg:mb-0">
                    <a href="/create" class="bg-green-500 hover:bg-green-600 text-white font-bold text-lg py-6 px-12 rounded-full transition duration-300 transform hover:scale-105 shadow-lg">
                        Create yourPost
                    </a>
                </div>
                @endauth
                <div class="w-full lg:w-1/4">
                    <h2 class="text-xl font-bold text-white mb-6">Post Latest</h2>
                    <div class="space-y-4">
                        @foreach($posts as $post)
                        <a href="/posts/{{$post->slug}}">
                            <div class="bg-white hover:bg-gray-100 p-4 rounded-lg shadow-md transition duration-300 ">
                                <h3 class="text-gray-800 font-normal">{{ $post->title }}</h3>
                                <p class="text-gray-600 text-sm">
                                    {!! \Illuminate\Support\Str::words(strip_tags($post->body), 5, '...') !!}
                                </p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Footer -->
        <footer class="rounded mt-10 bg-white py-2 shadow-lg">
            <div class="container mx-auto text-center text-gray-600">
                &copy; 2024 whatposts. All rights reserved.
            </div>
        </footer>
    </body>
    
    
</html>

</x-layout>