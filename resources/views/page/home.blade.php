<x-app-layout>
    <section class="container mx-auto p-4 md:p-8">
        <!-- Header with animation -->
        <div class="mx-auto max-w-screen-xl text-center mb-12 animate-fade-in-down">
            <h2 class="mb-4 text-4xl lg:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 animate-gradient">
                Latest News
            </h2>
            <p class="font-medium text-gray-600 dark:text-gray-300 sm:text-xl max-w-2xl mx-auto">
                Stay informed with our curated selection of top stories across various categories.
            </p>
        </div>

        <!-- Category filter with smooth transitions -->
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
            <span class="border-b-4 border-blue-500">{{ ucfirst($category) }} News</span>
        </h1>
        @endif

        <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            @if (isset($articles) && !empty($articles))
                @foreach ($articles as $post)
                    <article class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-shadow duration-300 transform hover:-translate-y-2 animate-fade-in-down">
                        <div class="relative overflow-hidden">
                            @if (isset($post['thumbnail']))
                                <img src="{{ $post['thumbnail'] }}" alt="Article Image" class="w-full h-48 object-cover transition-transform duration-300 transform hover:scale-110">
                            @else
                                <img src="{{ asset('storage/no_image.jpg') }}" alt="No Image Available" class="w-full h-48 object-cover">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold dark:bg-blue-900 dark:text-blue-200">
                                    {{ $post['category'] ?? 'General' }}
                                </span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ isset($post['pubDate']) ? \Carbon\Carbon::parse($post['pubDate'])->diffForHumans() : 'Unknown Date' }}
                                </span>
                            </div>
                            
                            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200 transform hover:scale-105">
                                <a href="{{ $post['link'] }}">{{ $post['title'] }}</a>
                            </h2>
                            
                            <p class="mb-4 text-gray-600 dark:text-gray-300 line-clamp-3">
                                {{ $post['description'] ?? 'No description available' }}
                            </p>
                            
                            <div class="flex justify-between items-center mt-4">
                                <div class="flex items-center space-x-3">
                                    <div class="relative">
                                        <img class="w-10 h-10 rounded-full border-2 border-blue-500" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Author avatar" />
                                        <div class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-white rounded-full"></div>
                                    </div>
                                    <span class="font-medium text-gray-900 dark:text-white">
                                        {{ $post['author'] ?? 'Unknown Author' }}
                                    </span>
                                </div>
                                <a href="{{ $post['link'] }}" class="inline-flex items-center px-4 py-2 text-blue-600 bg-blue-100 rounded hover:bg-blue-200 transition-colors duration-200 shadow-md hover:shadow-lg">
                                    Read more
                                    <svg class="ml-2 w-4 h-4 transform group-hover:translate-x-2 transition-transform duration-200" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            @else
                <div class="col-span-full text-center p-8 bg-gray-100 dark:bg-gray-700 rounded-lg">
                    <p class="text-gray-600 dark:text-gray-300 text-lg">{{ $message }}</p>
                </div>
            @endif
        </div>
        
        <style>
            @keyframes gradient {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            .animate-gradient {
                background-size: 200% 200%;
                animation: gradient 4s ease infinite;
            }
            .animate-fade-in-down {
                animation: fadeInDown 1s ease-out;
            }
            @keyframes fadeInDown {
                0% {
                    opacity: 0;
                    transform: translateY(-20px);
                }
                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
        </style>
        
</x-app-layout>
