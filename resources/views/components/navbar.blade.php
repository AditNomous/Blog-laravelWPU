<nav class="bg-gradient-to-r from-blue-400 to-blue-500" x-data="{ isOpen: false }">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
          <div class="flex items-center">
              <div class="flex-shrink-0">
                  <img class="w-10" src="img\icon.png">
                </div>
                <div class=" ml-2 font-bold">WhatPost</div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                      <x-nav-link href="/" :active="request()->is('home')">Home</x-nav-link>
                      <x-nav-link href="/posts" :active="request()->is('posts')">Blog</x-nav-link>
                      @auth
                      <x-nav-link href="/yourposts" :active="request()->is('yourposts')">My Posts</x-nav-link>
                  @endauth
                      <x-nav-link href="/about" :active="request()->is('about')">About</x-nav-link>
                      <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
                  </div>
              </div>
          </div>

          <div class="hidden md:block">
              <div class="ml-4 flex items-center md:ml-6">
      

                  <!-- Profile dropdown -->
                  <div class="relative ml-3">
                      <div>
                          <button type="button" @click="isOpen = !isOpen" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                              <span class="absolute -inset-1.5"></span>
                              <span class="sr-only">Open user menu</span>
                              <img class="h-8 w-8 rounded-full" 
                              src="{{ auth()->check() && auth()->user()->profile_picture ? asset('profile_pictures/' . auth()->user()->profile_picture) : asset('profile_pictures/default.png') }}" 
                              alt="Profile Picture">
                          </button>
                      </div>

                      <!-- Dropdown items -->
                      <div x-show="isOpen"
                          x-transition:enter="transition ease-out duration-100 transform"
                          x-transition:enter-start="opacity-0 scale-95"
                          x-transition:enter-end="opacity-100 scale-100"
                          x-transition:leave="transition ease-in duration-75 transform"
                          x-transition:leave-start="opacity-100 scale-100"
                          x-transition:leave-end="opacity-0 scale-95"
                          class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                          role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                          @if(auth()->check())
                              <div class="block px-4 py-2 text-sm text-gray-700">{{ auth()->user()->username }}</div>
                              <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                              <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                              <form action="{{ route('logout') }}" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button class="block w-full px-4 py-2 text-sm text-gray-700 text-left" role="menuitem">Logout</button>
                              </form>
                          @else
                              <div class="block px-4 py-2 text-sm text-gray-700">Guest</div>
                              <a href="/login" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">Login</a>
                          @endif
                      </div>
                    </div>
                </div>
            </div>
            
            <div class="-mr-2 flex md:hidden">
                <div class="mr-4">
                 @guest 
                 <a href="/login" class="bg-blue-700 block rounded-md px-3 py-2 text-base font-medium text-white hover:bg-gray-700 hover:text-white">Login</a>
                @endguest
                </div>
              <!-- Mobile menu button -->
              <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
                  <span class="absolute -inset-0.5"></span>
                  <span class="sr-only">Open main menu</span>
                  <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                  </svg>
                  <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>
              </button>
          </div>
      </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div x-show="isOpen" class="md:hidden" id="mobile-menu">
      <div class="flex flex-col space-y-1 px-2 pb-3 pt-2 sm:px-3">
          <x-nav-link href="/" :active="request()->is('home')">Home</x-nav-link>
          <x-nav-link href="/posts" :active="request()->is('posts')">Blog</x-nav-link>
          @auth
          <x-nav-link href="/yourposts" :active="request()->is('yourposts')">My Posts</x-nav-link>
      @endauth
          <x-nav-link href="/about" :active="request()->is('about')">About</x-nav-link>
          <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
      </div>

      <div class="border-t border-gray-700 pb-3 pt-4">
          <div class="flex items-center px-5">
              @if(auth()->check())
                  <div class="flex-shrink-0">
                      <img class="h-10 w-10 rounded-full" 
                      src="{{ auth()->user()->profile_picture ? asset('profile_pictures/' . auth()->user()->profile_picture) : asset('profile_pictures/default.png') }}" 
                      alt="Profile Picture">
                  </div>
                  <div class="ml-3">
                      <div class="text-base font-medium leading-none text-white">{{ auth()->user()->name }}</div>
                      <div class="text-sm font-medium leading-none text-gray-400">{{ auth()->user()->email }}</div>
                  </div>
              @else
                  <div class="ml-3">
                      <div class="text-base font-medium leading-none text-white">Guest</div>
                      <div class="text-sm font-medium leading-none text-gray-400">Not logged in</div>
                  </div>
              @endif
          </div>
          <div class="mt-3 space-y-1 px-2">
              @if(auth()->check())
                  <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
                  <a href="" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
                  <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="block w-full px-4 py-2 text-sm text-gray-700 text-left" role="menuitem">Logout</button>
                </form>
              @endif
          </div>
      </div>
  </div>
</nav>
