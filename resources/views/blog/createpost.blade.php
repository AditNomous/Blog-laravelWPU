<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Post</title>
    @vite('resources/css/app.css', 'resources/js/app.js')

    <!-- TinyMCE Script -->
    <script src="https://cdn.tiny.cloud/1/r7azwtc5roa920sr7t2vhsjex6x4ttghrxaqtxqsq03uf4uh/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
          selector: 'textarea#body',
          plugins: 'advlist autolink lists link image charmap print preview anchor',
          toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image',
          height: 300,
          menubar: false
        });
    </script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg">
            <div class="bg-blue-600 text-white p-4 rounded-t-lg font-semibold text-center">Add New Post</div>
            <div class="p-6">
                <!-- Flash message for success or failure -->
                @if (Session::has('fail'))
                    <div class="mb-4 p-3 bg-red-500 text-white rounded">{{ Session::get('fail') }}</div>
                @endif

                <!-- Form to add a new post -->
                <form action="{{ route('createpost') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Title -->
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700 font-medium">Post Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" class="w-full p-2 border border-gray-300 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" id="title" placeholder="Enter post title">
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Category Dropdown -->
                    <div class="mb-4">
                        <label for="category" class="block text-gray-700 font-medium">Select Category</label>
                        <select name="category" class="w-full p-2 border border-gray-300 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" id="category">
                            <option value="" disabled selected>Choose category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Post Body (TinyMCE Editor) -->
                    <div class="mb-4">
                        <label for="body" class="block text-gray-700 font-medium">Post Content</label>
                        <textarea name="body" id="body" class="w-full p-2 border border-gray-300 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="10">{{ old('body') }}</textarea>
                        @error('body')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-medium">Upload Cover</label>
                        <input type="file" id="cover" name="cover" accept="image/*" class="w-full p-2 border border-gray-300 rounded mt-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @error('image')
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
