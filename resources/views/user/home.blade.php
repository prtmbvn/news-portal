<x-app-layout>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    animation: {
                        'gradient': 'gradient 3s ease infinite',
                        'fade-in': 'fadeIn 1s ease-out forwards',
                        'fade-up': 'fadeInUp 0.5s ease-out forwards',
                        'bounce-twice': 'bounceTwice 0.6s ease-in-out',
                        'rotate-slow': 'rotateSlow 4s linear infinite',
                    },
                    keyframes: {
                        gradient: {
                            '0%, 100%': {
                                'background-size': '200% 200%',
                                'background-position': 'left center'
                            },
                            '50%': {
                                'background-size': '200% 200%',
                                'background-position': 'right center'
                            }
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' }
                        },
                        fadeInUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(20px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        bounceTwice: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' }
                        },
                        rotateSlow: {
                            '0%': { transform: 'rotate(0deg)' },
                            '100%': { transform: 'rotate(360deg)' }
                        }
                    }
                }
            }
        }
    </script>

    <section class="container mx-auto p-6 md:p-12">
        <!-- Header dengan animasi Tailwind -->
        <div class="text-center mb-16 animate-fade-in">
            <h2 class="mb-4 text-4xl lg:text-6xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-600 animate-gradient">
                Latest News
            </h2>
            <p class="font-medium text-gray-600 dark:text-gray-300 sm:text-xl max-w-3xl mx-auto transition transform hover:scale-105 hover:text-blue-500">
                Stay informed with our curated selection of top stories across various categories.
            </p>
        </div>

        <form method="GET" action="{{ route('user.dashboard') }}" class="mb-8">
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                <select name="category" id="category" class="w-full sm:w-auto px-4 py-2 rounded-lg border-2 border-blue-500 focus:border-purple-500 focus:ring focus:ring-purple-200 transition-all duration-300 bg-white dark:bg-gray-800 text-gray-800 dark:text-white">
                    <option value="">All Categories</option>
                    <option value="politik" {{ request('category') == 'politik' ? 'selected' : '' }}>Politics</option>
                    <option value="terbaru" {{ request('category') == 'terbaru' ? 'selected' : '' }}>Latest</option>
                    <option value="olahraga" {{ request('category') == 'olahraga' ? 'selected' : '' }}>Sports</option>
                    <option value="teknologi" {{ request('category') == 'teknologi' ? 'selected' : '' }}>Technology</option>
                    <option value="hiburan" {{ request('category') == 'hiburan' ? 'selected' : '' }}>Entertainment</option>
                </select>
                <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold rounded-lg hover:from-blue-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                    Filter News
                </button>
            </div>
        </form>

        @if($category)
        <h1 class="text-2xl md:text-3xl font-bold mb-6 text-center text-gray-800 dark:text-white">
            <span class="border-b-4 border-blue-500"></span>
        </h1>
        @endif
        
        <!-- Grid Layout untuk Artikel dengan animasi -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @if (isset($articles) && !empty($articles))
                @foreach ($articles as $index => $post)
                    <article class="group p-6 bg-white rounded-xl border border-gray-200 shadow-xl dark:bg-gray-800 dark:border-gray-700 transition-all duration-300 hover:shadow-2xl hover:scale-105 animate-fade-up" style="animation-delay: {{ $index * 150 }}ms">
                        <div class="flex justify-between items-center mb-5 text-gray-500">
                            <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-3 py-1 rounded-full dark:bg-primary-200 dark:text-primary-800 transition transform group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white">
                                {{ $post['category'] ?? 'General' }}
                            </span>
                            <span class="text-sm transition group-hover:text-blue-500">
                                {{ isset($post['pubDate']) ? \Carbon\Carbon::parse($post['pubDate'])->diffForHumans() : 'Unknown Date' }}
                            </span>
                        </div>

                        <!-- Thumbnail image dengan efek hover -->
                        <div class="relative overflow-hidden rounded-lg mb-4 group-hover:shadow-lg transform transition duration-500 group-hover:scale-[1.05]">
                            @if (isset($post['thumbnail']))
                                <img src="{{ $post['thumbnail'] }}" alt="Article Image" class="w-full h-48 object-cover rounded-md transition duration-500 group-hover:rotate-slow">
                            @else
                                <img src="{{ asset('storage/no_image.jpg') }}" alt="No Image Available" class="w-full h-48 object-cover rounded-md transition duration-500 group-hover:rotate-slow">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300"></div>
                        </div>

                        <!-- Deskripsi Artikel -->
                        <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white transition group-hover:text-blue-600 dark:group-hover:text-blue-400">
                            <a href="{{ $post['link'] }}">{{ $post['title'] }}</a>
                        </h2>
                        
                        <p class="mb-5 font-light text-gray-500 dark:text-gray-400 line-clamp-3 transition-all duration-300 group-hover:line-clamp-none">
                            {{ $post['description'] ?? 'No description available' }}
                        </p>

                        <!-- Footer Artikel -->
                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-4 transition group-hover:translate-x-2">
                                <img class="w-8 h-8 rounded-full ring-2 ring-blue-500 transition group-hover:scale-110" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Author avatar" />
                                <span class="font-medium dark:text-white transition group-hover:text-blue-500">
                                    {{ $post['author'] ?? 'Unknown Author' }}
                                </span>
                            </div>
                            <a href="{{ $post['link'] }}" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 transition group-hover:translate-x-2">
                                Read more
                                <svg class="ml-2 w-4 h-4 transition group-hover:translate-x-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            @else
                <div class="text-center text-gray-500 dark:text-gray-400 col-span-full animate-fade-in">
                    <p>{{ $message }}</p>
                </div>
            @endif
        </div>

        <!-- Tambahan tombol scroll ke atas -->
        <div class="fixed bottom-6 right-6">
            <button class="bg-blue-500 text-white p-4 rounded-full shadow-lg hover:bg-blue-700 transition-all duration-300 animate-bounce-twice">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 011.414 0L10 15.414l5.293-5.707a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L10 13.414 3.293 8.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </section>
</x-app-layout>
