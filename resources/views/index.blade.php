<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>

<body class="bg-gradient-to-r from-blue-500 to-purple-600">



    <div class="bg-gradient-to-r from-blue-500 to-yellow-600 p-4">
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 container mx-auto flex justify-center space-x-4 px-6">
        <!-- Categories -->@foreach ($categories as $item)
        <div class="flex space-x-4 overflow-auto " >
            
            <a href="/posts?category={{ $item->slug }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-full transition duration-300">{{$item->name}}</a>
            
        </div>
        @endforeach
    </div>

    <!-- Main Content -->
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 container mx-auto mt-12 flex flex-col lg:flex-row px-6">
        
        <!-- Left Side (Get Started Button) -->
        <div class="flex-grow flex justify-center items-center mb-12 lg:mb-0">
            <a href="/login" class="bg-green-500 hover:bg-green-600 text-white font-bold text-lg py-6 px-12 rounded-full transition duration-300 transform hover:scale-105 shadow-lg">
                Create yourPost
            </a>
        </div>
        
        <!-- Right Side (Popular Posts) -->
        <div class="w-full lg:w-1/4">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Post Populer</h2>
            <div class="space-y-4">
                <div class="bg-white hover:bg-gray-100 p-4 rounded-lg shadow-md transition duration-300">
                    <h3 class="text-gray-800 font-semibold">Post Populer 1</h3>
                    <p class="text-gray-600 text-sm">Deskripsi singkat tentang post...</p>
                </div>
                <div class="bg-white hover:bg-gray-100 p-4 rounded-lg shadow-md transition duration-300">
                    <h3 class="text-gray-800 font-semibold">Post Populer 2</h3>
                    <p class="text-gray-600 text-sm">Deskripsi singkat tentang post...</p>
                </div>
                <div class="bg-white hover:bg-gray-100 p-4 rounded-lg shadow-md transition duration-300">
                    <h3 class="text-gray-800 font-semibold">Post Populer 3</h3>
                    <p class="text-gray-600 text-sm">Deskripsi singkat tentang post...</p>
                </div>
                <div class="bg-white hover:bg-gray-100 p-4 rounded-lg shadow-md transition duration-300">
                    <h3 class="text-gray-800 font-semibold">Post Populer 4</h3>
                    <p class="text-gray-600 text-sm">Deskripsi singkat tentang post...</p>
                </div>
            </div>
        </div>
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