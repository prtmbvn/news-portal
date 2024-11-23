<nav class="bg-gradient-to-r from-gray-900 via-purple-900 to-violet-900 text-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <div class="flex justify-between h-18">
            <!-- Logo and site name -->
            <div class="flex items-center animate-slide-in">
                <a href="#" class="flex items-center space-x-3 group">
                    <div class="relative">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-pink-600 to-purple-600 rounded-lg blur opacity-0 group-hover:opacity-100 transition duration-5000 group-hover:duration-100 animate-spin"></div>
                        <img src="{{ asset('img/logo.png') }}" class="relative h-10 w-10 rounded-lg shadow-lg transform group-hover:scale-105 transition-transform duration-300 animate-pulse" alt="Logo" />
                    </div>
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white via-purple-300 to-gray-100 animate-gradient hover:underline hover:decoration-2 hover:underline-offset-4 transition-all duration-300">WinniCode Technology</span>
                </a>
            </div>
            
            <style>
                @keyframes gradient {
                    0% {background-position: 0% 50%;}
                    50% {background-position: 100% 50%;}
                    100% {background-position: 0% 50%;}
                }
                .animate-gradient {
                    background-size: 200%;
                    animation: gradient 3s ease infinite;
                }
            
                @keyframes slideIn {
                    from {transform: translateX(-100%); opacity: 0;}
                    to {transform: translateX(0); opacity: 1;}
                }
                .animate-slide-in {
                    animation: slideIn 0.5s ease-out;
                }
            
                @media (prefers-reduced-motion: reduce) {
                    .animate-gradient, .animate-pulse, .animate-slide-in, .animate-spin {
                        animation: none;
                    }
                }
            </style>

            <!-- Navigation Links -->
            <div class="flex items-center">
                @guest
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('home') }}" class="relative px-6 py-2 rounded-full group overflow-hidden">
                            <span class="absolute inset-0 w-0 bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 transition-all duration-300 ease-out group-hover:w-full"></span>
                            <span class="relative text-white group-hover:text-white transition-colors duration-300 ease-in-out">Home</span>
                        </a>
                        <a href="{{ route('blog') }}" class="relative px-6 py-2 rounded-full group overflow-hidden">
                            <span class="absolute inset-0 w-0 bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 transition-all duration-300 ease-out group-hover:w-full"></span>
                            <span class="relative text-white group-hover:text-white transition-colors duration-300 ease-in-out">Blog</span>
                        </a>
                        <a href="{{ route('login') }}" class="relative px-6 py-2 rounded-full group overflow-hidden">
                            <span class="absolute inset-0 w-0 bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 transition-all duration-300 ease-out group-hover:w-full"></span>
                            <span class="relative text-white group-hover:text-white transition-colors duration-300 ease-in-out">Login</span>
                        </a>
                    </div>
                @endguest
                @auth
                @if(auth()->user()->role == 'employee')
                    <div class="hidden md:flex items-center space-x-4">
                        <a href="{{ route('home') }}" class="relative px-6 py-2 rounded-full group overflow-hidden">
                            <span class="absolute inset-0 w-0 bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 transition-all duration-300 ease-out group-hover:w-full"></span>
                            <span class="relative text-white group-hover:text-white transition-colors duration-300 ease-in-out">Home</span>
                        </a>
                        <a href="{{ route('blog') }}" class="relative px-6 py-2 rounded-full group overflow-hidden">
                            <span class="absolute inset-0 w-0 bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 transition-all duration-300 ease-out group-hover:w-full"></span>
                            <span class="relative text-white group-hover:text-white transition-colors duration-300 ease-in-out">Blog</span>
                        </a>
                    </div>
                    @endif
                @endauth

                @auth 
                    
                    <!-- Dropdown menu for authenticated users -->
                    <div x-data="{ open: false }" class="ml-3 relative">
                        <button @click="open = !open" class="flex items-center space-x-3 focus:outline-none">
                            <img class="h-10 w-10 rounded-full border-2 border-white shadow-lg transform hover:scale-105 transition-transform duration-300" src="{{ asset('img/avatar.png') }}" alt="User avatar">
                            <span class="hidden md:block text-sm font-medium">{{ Auth::user()->name }}</span>
                            <svg class="h-5 w-5 transform transition-transform duration-200" :class="{'rotate-180': open}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown content -->
                        <div x-show="open" @click.away="open = false" 
                            class="origin-top-right absolute right-0 mt-2 w-48 rounded-xl shadow-lg bg-white ring-1 ring-black ring-opacity-5 divide-y divide-gray-100" 
                            x-transition:enter="transition ease-out duration-200" 
                            x-transition:enter-start="opacity-0 scale-95" 
                            x-transition:enter-end="opacity-100 scale-100" 
                            x-transition:leave="transition ease-in duration-75" 
                            x-transition:leave-start="opacity-100 scale-100" 
                            x-transition:leave-end="opacity-0 scale-95">
                            <div class="px-4 py-3">
                                <p class="text-sm leading-5 text-gray-900">Signed in as</p>
                                <p class="text-sm leading-5 font-medium text-gray-900 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-1">
                                @if(auth()->user()->role == 'employee')
                                <a href="{{ route('about') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                    <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                    About
                                </a>
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                    <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                    </svg>
                                    Settings
                                </a>
                                <a href="{{ route('admin.posts.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                    <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                    </svg>
                                    ss
                                </a>
                                @elseif(auth()->user()->role == 'user')
                                <a href="{{ route('admin.posts.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600">
                                    <svg class="mr-3 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                                    </svg>
                                    ss
                                </a>
                                @else
                                @endif
                            </div>
                            <div class="py-1">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center px-4 py-2 text-sm text-red-700 hover:bg-red-50">
                                        <svg class="mr-3 h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 000 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>