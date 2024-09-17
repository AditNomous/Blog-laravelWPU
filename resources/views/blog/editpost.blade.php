<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Post</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
    
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg ">
            <div class="bg-blue-500 text-white p-4 rounded-t-lg">Edit Post</div>
            <div class="p-6">
                <!-- Flash message for success or failure -->
                @if (Session::has('fail'))
                <div class="mb-4 p-3 bg-red-500 text-white rounded flex items-center">
                    <span>{{ Session::get('fail') }}</span>
                </div>
            @elseif(Session::has('success'))
            
                <div class="mb-4 p-3 bg-green-500 text-white rounded flex items-center">
                    <svg class="w-5 h-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span>{{ Session::get('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
    <div class="mb-4 p-3 bg-red-500 text-white rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                            
                <!-- Form to add a new post -->
                <form action="{{ route('editpost') }}" method="post">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <!-- Title -->
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-medium">Post Title</label>
                        <input type="text" name="title" value="{{ $post->title }}" class="w-full p-2 border border-gray-300 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" id="title" placeholder="Enter post title">
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <!-- Category Dropdown -->
                    <div class="mb-4">
                        <label for="category" class="block text-gray-700 font-medium">Select Category</label>
                        <select name="category" class="w-full p-2 border border-gray-300 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" id="category">
                            <option value="" disabled>Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <!-- Post Body -->
                    <div class="mb-4">
                        <label for="body" class="block text-gray-700 font-medium">Post Content</label>
                        <textarea name="body" class="w-full p-2 border border-gray-300 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" id="body" rows="5" placeholder="Enter post content">{{ $post->body }}</textarea>
                        @error('body')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                
                    <!-- Submit and Cancel Buttons -->
                    <div class="flex justify-between">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save Post</button>
                        <a href="/posts" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
                    </div>
                </form>
                
                           </div>
        </div>
    </div>
</body>
</html>
