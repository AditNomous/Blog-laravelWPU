<x-layout>
    <div>
        <!-- Success & Fail Alerts -->
        @if (Session::has('success'))
            <div class="mb-4 p-3 bg-green-500 text-white rounded fade-out success-alert">
                {{ Session::get('success') }}
            </div>
        @elseif (Session::has('fail'))
            <div class="mb-4 p-3 bg-red-500 text-white rounded fade-out fail-alert">
                {{ Session::get('fail') }}
            </div>
        @endif

        <!-- Search Form -->
        <form>
            <!-- Search Fields -->
            <input type="search" id="search" placeholder="Search Posts..." name="search" class="input-field">
            <button type="submit" class="btn btn-search">Search</button>
        </form>

        <!-- Toggle Button -->
        <button id="toggle-view" class="btn bg-blue-600 text-white px-4 py-2 rounded">
            Toggle View
        </button>

        <!-- Button for creating new post -->
        <a href="/create" class="btn btn-primary">Create Post</a>

        <!-- Grid View for Posts -->
        <div id="posts-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
            @foreach ($posts as $post)
                <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex justify-between items-center mb-5 text-gray-500">
                        <a href="/posts?category={{ $post->category->slug }}"
                           class="badge bg-{{ $post->category->color }}-100 text-primary-800">{{ $post->category->name }}</a>
                        <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
                        <a href="/edit/{{$post->id}}" class="btn btn-edit">Edit</a>
                        <a href="/delete/{{$post->id}}" class="btn btn-delete">Delete</a>
                    </div>
                    <h2 class="mb-2 text-2xl font-bold tracking-tight"><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h2>
                    <p class="mb-5">{{ $post->body }}</p>
                    <div class="flex items-center">
                        <img class="h-8 w-8 rounded-full" src="{{ $post->author->profile_picture ? asset('profile_pictures/' . $post->author->profile_picture) : asset('profile_pictures/default.png') }}">
                        <a href="/posts?author={{ $post->author->username }}" class="ml-4">{{ $post->author->name }}</a>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Table View for Posts (hidden by default) -->
        <div id="posts-table" class="hidden mt-8">
            <div class="grid grid-cols-4 gap-4 font-bold bg-gray-200 p-4 rounded-lg">
                <div>Title</div>
                <div>Category</div>
                <div>Author</div>
                <div>Actions</div>
            </div>

            @foreach ($posts as $post)
                <div class="grid grid-cols-4 gap-4 p-4 border-b border-gray-300">
                    <div><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></div>
                    <div>{{ $post->category->name }}</div>
                    <div>{{ $post->author->name }}</div>
                    <div>
                        <a href="/edit/{{$post->id}}" class="text-blue-500">Edit</a> |
                        <a href="/delete/{{$post->id}}" class="text-red-500">Delete</a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination (only for grid view) -->
        <div id="pagination">
            @if($posts->count())
                {{ $posts->links() }}
            @else
                <p>No posts found.</p>
            @endif
        </div>
    </div>

    <script>
        // Toggle between grid and table view
        document.getElementById('toggle-view').addEventListener('click', function () {
            const gridView = document.getElementById('posts-grid');
            const tableView = document.getElementById('posts-table');
            const pagination = document.getElementById('pagination');

            // Toggle visibility of grid and table
            if (gridView.classList.contains('hidden')) {
                gridView.classList.remove('hidden');
                tableView.classList.add('hidden');
                pagination.classList.remove('hidden');
            } else {
                gridView.classList.add('hidden');
                tableView.classList.remove('hidden');
                pagination.classList.add('hidden'); // Hide pagination in table view
            }
        });
    </script>
</x-layout>
