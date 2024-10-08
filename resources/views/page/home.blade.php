<x-app-layout>
    <section class="container mx-auto p-8 flex">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center lg:mb-16 mb-8">
                <h2 class="mb-4 text-3xl lg:text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">List of Last Articles</h2>
                <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">
                    We use an agile approach to test assumptions and connect with the needs of your audience early and often.
                </p>
            </div>
            <form method="GET" action="{{route('user.dashboard')}}">
                <label for="category">Select Category:</label>
                <select name="category" id="category">
                    <option value="">-- Select Category --</option>
                    <option value="politik" {{ request('category') == 'politik' ? 'selected' : '' }}>politik</option>
                    <option value="terbaru" {{ request('category') == 'terbaru' ? 'selected' : '' }}>terbaru</option>
                    <option value="olahraga" {{ request('category') == 'olahraga' ? 'selected' : '' }}>Olahraga</option>
                    <option value="teknologi" {{ request('category') == 'teknologi' ? 'selected' : '' }}>Teknologi</option>
                    <option value="hiburan" {{ request('category') == 'hiburan' ? 'selected' : '' }}>Hiburan</option>
                </select>
                <button type="submit">Filter by Category</button>
            </form>
            <h1 class="text-r-500">Berita {{$category}}</h1>
            <div class="grid gap-8 lg:grid-cols-2">
                @if (isset($articles) && !empty($articles))
                    @foreach ($articles as $post)
                        <article class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
                            <div class="flex justify-between items-center mb-5 text-gray-500">
                                <span class="bg-primary-100 text-primary-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-primary-200 dark:text-primary-800">
                                    {{ $post['category'] ?? 'General' }} <!-- Menampilkan kategori jika ada -->
                                </span>
                                <span class="text-sm">
                                    {{ isset($post['pubDate']) ? \Carbon\Carbon::parse($post['pubDate'])->diffForHumans() : 'Unknown Date' }}
                                </span> 
                            </div>
                            <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                <a href="{{ $post['link'] }}">{{ $post['title'] }}</a>
                            </h2>
                            @if (isset($post['thumbnail']))
                                <img src="{{ $post['thumbnail'] }}" alt="Article Image" class="w-full h-48 object-cover rounded-lg mb-4">
                            @else
                                <img src="{{ asset('storage/no_image.jpg') }}" alt="No Image Available" class="w-full h-48 object-cover rounded-lg mb-4">
                            @endif
                            <p class="mb-5 font-light text-gray-500 dark:text-gray-400">
                                {{ $post['description'] ?? 'No description available' }}
                            </p> 
                            <div class="flex justify-between items-center">
                                <div class="flex items-center space-x-4">
                                    <img class="w-7 h-7 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Author avatar" />
                                    <span class="font-medium dark:text-white">
                                        {{ $post['author'] ?? 'Unknown Author' }}
                                    </span>
                                </div>
                                <a href="{{ $post['link'] }}" class="inline-flex items-center font-medium text-primary-600 dark:text-primary-500 hover:underline">
                                    Read more
                                    <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                @else
                    <div class="text-center text-gray-500 dark:text-gray-400">
                        <p>{{ $message }}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
