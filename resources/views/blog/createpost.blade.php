<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
 
</head>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link rel="stylesheet" href="https://rsms.me/inter/inter.css">
<body>
  <h2 class="text-center mt-6 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">new post</h2>
    <form action="" method="POST" class="ms-10">

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-2 sm:grid-cols-6">
            <div class="sm:col-span-4">
              <label for="title" class="block text-sm font-medium leading-6 text-gray-900">Title</label>
              <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                  <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">/</span>
                  <input type="text" name="title" id="title" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="enter Title">
                </div>
              </div>
            </div>


            <div class="sm:col-span-4">
              <label for="category" class="block text-sm font-medium leading-6 text-gray-900">Category</label>
              <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                  <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">workcation.com/</span>
                  <select name="category" id="category" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 focus:ring-0 sm:text-sm sm:leading-6">
                   @foreach ($categories as $item)
                    
                   <option value="travel">{{$item->name}}</option>
                   <!-- Tambahkan kategori lain sesuai kebutuhan -->
                   @endforeach
                  
                  </select>
                </div>
              </div>
            </div>
            

            <div class="sm:col-span-4">
              <label for="author" class="block text-sm font-medium leading-6 text-gray-900">Author</label>
              <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                  <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">workcation.com/</span>
                  <input type="text" name="author" id="author" autocomplete="username" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="janesmith">
                </div>
              </div>
            </div>
            
            <div class="sm:col-span-4">
              <label for="slug" class="block text-sm font-medium leading-6 text-gray-900">Slug</label>
              <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                  <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">workcation.com/</span>
                  <input type="text" name="slug" id="slug" autocomplete="username" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="janesmith">
                </div>
              </div>
            </div>
            
            <div class="sm:col-span-4">
              <label for="body" class="block text-sm font-medium leading-6 text-gray-900">Body</label>
              <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                  <span class="flex select-none items-center pl-3 text-gray-500 sm:text-sm">workcation.com/</span>
                  <input type="text" name="body" id="body" autocomplete="username" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" placeholder="janesmith">
                </div>
              </div>
            </div>

            <div class="sm:col-span-5 mt-2">
             <a href="posts" class="rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600">Cencel</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
              </div>
            </form>
</body>
</html>