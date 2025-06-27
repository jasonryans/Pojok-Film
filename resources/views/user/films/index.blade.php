
@extends('user.base')
@section('user.content')

    @php
        use Carbon\Carbon;

        $genreColors = [
            'Action' => 'bg-red-500',
            'Adventure' => 'bg-green-500',
            'Comedy' => 'bg-yellow-500',
            'Drama' => 'bg-purple-500',
            'Horror' => 'bg-gray-800',
            'Romance' => 'bg-pink-500',
            'Sci-Fi' => 'bg-cyan-500',
            'Thriller' => 'bg-orange-500',
            'Fantasy' => 'bg-teal-500',
        ];

        function getGenreColor($genre, $colors)
        {
            return isset($colors[$genre]) ? $colors[$genre] : 'bg-gray-500';
        }

        $sortedfilm = $film->sortByDesc(function ($item) {
            return Carbon::parse($item->release_date)->timestamp;
        });

        $groupedfilm = collect();
        foreach ($sortedfilm as $movie) {
            $movieGenres = [];
            
            if ($movie->genres && $movie->genres->count() > 0) {
                $movieGenres = $movie->genres->pluck('name')->toArray();
            } elseif ($movie->genre_names) {
                $movieGenres = array_map('trim', explode(', ', $movie->genre_names));
            } elseif ($movie->primary_genre) {
                $movieGenres = [$movie->primary_genre];
            } else {
                $movieGenres = ['Unknown'];
            }
            
            foreach ($movieGenres as $genre) {
                if (!$groupedfilm->has($genre)) {
                    $groupedfilm->put($genre, collect());
                }
                $groupedfilm->get($genre)->push($movie);
            }
        }
        
        $groupedfilm = $groupedfilm->map(function ($movies) {
            return $movies->sortByDesc(function ($item) {
                return Carbon::parse($item->release_date)->timestamp;
            });
        });
    @endphp

    <div class="bg-gradient-to-br from-gray-100 via-blue-50 to-gray-100 min-h-screen">
        <div class="pt-24 pb-8">
            <div class="container mx-auto px-4">
                <!-- Search and Filter Section -->
                <div class="max-w-6xl mx-auto mb-12">
                    <form method="GET" action="{{ route('films.index') }}" class="space-y-6">
                        <!-- Main Search Bar -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-search text-gray-600 text-lg"></i>
                            </div>
                            <input
                                class="w-full pl-12 pr-4 py-4 text-lg bg-white border border-gray-300 rounded-2xl text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 shadow-md"
                                type="search" name="search" placeholder="Search movies by title..."
                                value="{{ request('search') }}">
                        </div>

                        <!-- Filter Controls -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Genre Filter -->
                            <select
                                class="bg-white border border-gray-300 rounded-xl py-3 px-4 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 shadow-md"
                                name="genre">
                                <option value="" class="text-gray-800">All Genres</option>
                                @if (isset($availableGenres))
                                    @foreach ($availableGenres as $genre)
                                        <option value="{{ $genre }}" class="text-gray-800"
                                            {{ request('genre') == $genre ? 'selected' : '' }}>
                                            {{ $genre }}
                                        </option>
                                    @endforeach
                                @else
                                    @foreach ($genreColors as $genre => $color)
                                        <option value="{{ $genre }}" class="text-gray-800"
                                            {{ request('genre') == $genre ? 'selected' : '' }}>
                                            {{ $genre }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>

                            <!-- Year Filter -->
                            @if (isset($availableYears))
                                <select
                                    class="bg-white border border-gray-300 rounded-xl py-3 px-4 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 shadow-md"
                                    name="year">
                                    <option value="" class="text-gray-800">All Years</option>
                                    @foreach ($availableYears as $year)
                                        <option value="{{ $year }}" class="text-gray-800"
                                            {{ request('year') == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            @endif

                            <!-- Sort By -->
                            <select
                                class="bg-white border border-gray-300 rounded-xl py-3 px-4 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300 shadow-md"
                                name="sort">
                                <option value="release_date" class="text-gray-800"
                                    {{ request('sort') == 'release_date' ? 'selected' : '' }}>By Year</option>
                                <option value="title" class="text-gray-800"
                                    {{ request('sort') == 'title' ? 'selected' : '' }}>By Title</option>
                                <option value="genre" class="text-gray-800"
                                    {{ request('sort') == 'genre' ? 'selected' : '' }}>By Genre</option>
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-center space-x-4">
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold transform hover:scale-105 transition-all duration-300 shadow-lg">
                                <i class="fas fa-search mr-2"></i>Search
                            </button>
                            @if (request('search') || request('genre') || request('year') || request('sort'))
                                <a href="{{ route('films.index') }}"
                                    class="bg-gray-600 hover:bg-gray-700 text-white px-8 py-3 rounded-xl font-semibold transform hover:scale-105 transition-all duration-300 shadow-lg">
                                    <i class="fas fa-times mr-2"></i>Clear
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Filter Results Info -->
                @if (request('search') || request('genre') || request('year'))
                    <div class="max-w-4xl mx-auto mb-8">
                        <div class="bg-blue-100 border border-blue-300 rounded-xl p-4 shadow-md">
                            <div class="flex items-center text-blue-800">
                                <i class="fas fa-info-circle mr-3 text-lg"></i>
                                <span>Showing results for:</span>
                                @if (request('search'))
                                    <span class="font-bold ml-1">"{{ request('search') }}"</span>
                                @endif
                                @if (request('genre'))
                                    @if (request('search'))
                                        <span class="ml-1">in</span>
                                    @endif
                                    <span class="font-bold ml-1">{{ request('genre') }}</span> genre
                                @endif
                                @if (request('year'))
                                    @if (request('search') || request('genre'))
                                        <span class="ml-1">from</span>
                                    @endif
                                    <span class="font-bold ml-1">{{ request('year') }}</span>
                                @endif
                                <span class="ml-2">({{ $film->count() }} {{ $film->count() == 1 ? 'movie' : 'movies' }}
                                    found)</span>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- View Toggle -->
                <div class="flex items-center justify-between max-w-6xl mx-auto mb-8">
                    <h2 class="text-3xl font-bold text-gray-800">Browse Movies</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700 font-medium">View by:</span>
                        <button id="genre-toggle"
                            class="genre-toggle-btn bg-gray-200 hover:bg-blue-600 hover:text-white text-gray-800 px-6 py-2 rounded-lg font-medium transition-all duration-300 transform hover:scale-105 shadow-md">
                            Genre
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Movies Grid Section -->
        <div class="container mx-auto px-4 pb-16">
            <!-- All View -->
            <div id="all-view" class="view">
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    @forelse ($film as $movie)
                        <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transform hover:-translate-y-2 transition-all duration-500 border border-gray-200">
                            <!-- Movie Poster Container -->
                            <div class="relative bg-gradient-to-br from-gray-200 to-gray-300 overflow-hidden aspect-[2/3]">
                                @if ($movie->poster)
                                    <img src="{{ Str::startsWith($movie->poster, 'http') ? $movie->poster : asset('storage/' . $movie->poster) }}"
                                        alt="{{ $movie->name }} Poster"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <i class="fas fa-film text-4xl text-yellow-600"></i>
                                    </div>
                                @endif

                                <!-- Duration Badge (Top Left) -->
                                @if ($movie->duration)
                                    <div class="absolute top-2 left-2">
                                        <span class="bg-black/70 text-white px-2 py-1 rounded-lg text-xs font-medium flex items-center backdrop-blur-sm">
                                            <i class="far fa-clock mr-1"></i>{{ $movie->duration }}m
                                        </span>
                                    </div>
                                @endif

                                <!-- Rating Badge (Top Right) -->
                                @if ($movie->rating)
                                    <div class="absolute top-2 right-2">
                                        <span class="bg-yellow-500 text-black px-2 py-1 rounded-lg text-xs font-bold flex items-center">
                                            <i class="fas fa-star mr-1"></i>{{ $movie->rating }} / 10
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Movie Info -->
                            <div class="p-4">
                                <h3 class="text-base font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300 leading-tight">
                                    {{ $movie->name }}
                                </h3>

                                <!-- Release Year -->
                                <div class="flex items-center text-sm text-gray-600 mb-3">
                                    <i class="far fa-calendar-alt mr-2 text-blue-500"></i>
                                    {{ \Carbon\Carbon::parse($movie->release_date)->format('Y') }}
                                </div>

                                <!-- Description -->
                                @if ($movie->description)
                                    <p class="text-gray-600 text-xs mb-4 line-clamp-3 leading-relaxed">
                                        {{ Str::limit($movie->description, 80, '...') }}
                                    </p>
                                @endif

                                <!-- Genres (Bottom of card, before buttons) -->
                                @if ($movie->genres && $movie->genres->count() > 0)
                                    <div class="mb-4">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach ($movie->genres->take(2) as $genre)
                                                <span class="px-2 py-1 text-xs font-medium text-white rounded-full {{ getGenreColor($genre->name, $genreColors) }}">
                                                    {{ $genre->name }}
                                                </span>
                                            @endforeach
                                            @if ($movie->genres->count() > 2)
                                                <span class="px-2 py-1 text-xs font-medium text-gray-600 bg-gray-200 rounded-full">
                                                    +{{ $movie->genres->count() - 2 }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @elseif ($movie->genre_names)
                                    @php
                                        $genreArray = array_map('trim', explode(', ', $movie->genre_names));
                                    @endphp
                                    <div class="mb-4">
                                        <div class="flex flex-wrap gap-1">
                                            @foreach (array_slice($genreArray, 0, 2) as $genreName)
                                                <span class="px-2 py-1 text-xs font-medium text-white rounded-full {{ getGenreColor($genreName, $genreColors) }}">
                                                    {{ $genreName }}
                                                </span>
                                            @endforeach
                                            @if (count($genreArray) > 2)
                                                <span class="px-2 py-1 text-xs font-medium text-gray-600 bg-gray-200 rounded-full">
                                                    +{{ count($genreArray) - 2 }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <!-- Action Buttons -->
                                <div class="flex space-x-2">
                                    <a href="{{ route('films.show', $movie->id) }}"
                                        class="flex-1 bg-blue-400 hover:bg-purple-700 text-white text-center py-2 px-3 rounded-lg font-medium transition-all duration-300 transform hover:scale-105 text-sm">
                                        <i class="fas fa-eye mr-1"></i>Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full">
                            <div class="text-center py-20">
                                <div class="bg-white rounded-2xl p-12 max-w-md mx-auto shadow-lg border border-gray-200">
                                    <i class="fas fa-film text-6xl text-gray-400 mb-6"></i>
                                    @if (request('search') || request('genre'))
                                        <h3 class="text-2xl font-bold text-gray-800 mb-4">No Movies Found</h3>
                                        <p class="text-gray-600 mb-6">Try adjusting your search criteria or browse all
                                            movies.</p>
                                        <a href="{{ route('films.index') }}"
                                            class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-3 rounded-xl font-semibold transform hover:scale-105 transition-all duration-300">
                                            View All Movies
                                        </a>
                                    @else
                                        <h3 class="text-2xl font-bold text-gray-800 mb-4">No Movies Available</h3>
                                        <p class="text-gray-600">Check back later for new movie releases!</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Genre Filter View -->
            <div id="filter-view" class="view hidden">
                @forelse ($groupedfilm as $genre => $movies)
                    <div class="mb-16">
                        <!-- Genre Header -->
                        <div class="mb-8">
                            <h2 class="text-3xl font-bold text-gray-800 flex items-center">
                                <span class="px-4 py-2 rounded-xl text-white mr-4 {{ getGenreColor($genre, $genreColors) }}">
                                    {{ $genre }}
                                </span>
                                <span class="text-gray-600 text-lg">({{ $movies->count() }} movies)</span>
                            </h2>
                        </div>

                        <!-- Movies Grid -->
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                            @foreach ($movies as $movie)
                                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transform hover:-translate-y-2 transition-all duration-500 border border-gray-200">
                                    <!-- Movie Poster Container -->
                                    <div class="relative bg-gradient-to-br from-gray-200 to-gray-300 overflow-hidden aspect-[2/3]">
                                        @if ($movie->poster)
                                            <img src="{{ $movie->posterUrl() }}"
                                                alt="{{ $movie->name }} Poster"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                        @else
                                            <div class="flex items-center justify-center h-full">
                                                <i class="fas fa-film text-4xl text-yellow-600"></i>
                                            </div>
                                        @endif

                                        <!-- Duration Badge (Top Left) -->
                                        @if ($movie->duration)
                                            <div class="absolute top-2 left-2">
                                                <span class="bg-black/70 text-white px-2 py-1 rounded-lg text-xs font-medium flex items-center backdrop-blur-sm">
                                                    <i class="far fa-clock mr-1"></i>{{ $movie->duration }}m
                                                </span>
                                            </div>
                                        @endif

                                        <!-- Rating Badge (Top Right) -->
                                        @if ($movie->rating)
                                            <div class="absolute top-2 right-2">
                                                <span class="bg-yellow-500 text-black px-2 py-1 rounded-lg text-xs font-bold flex items-center">
                                                    <i class="fas fa-star mr-1"></i>{{ $movie->rating }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Movie Info -->
                                    <div class="p-4">
                                        <h3 class="text-base font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300 leading-tight">
                                            {{ $movie->name }}
                                        </h3>

                                        <!-- Release Year -->
                                        <div class="flex items-center text-sm text-gray-600 mb-3">
                                            <i class="far fa-calendar-alt mr-2 text-blue-500"></i>
                                            {{ \Carbon\Carbon::parse($movie->release_date)->format('Y') }}
                                        </div>

                                        <!-- Description -->
                                        @if ($movie->description)
                                            <p class="text-gray-600 text-xs mb-4 line-clamp-3 leading-relaxed">
                                                {{ Str::limit($movie->description, 80, '...') }}
                                            </p>
                                        @endif

                                        <!-- Genres (Bottom of card, before buttons) -->
                                        @if ($movie->genres && $movie->genres->count() > 0)
                                            <div class="mb-4">
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach ($movie->genres->take(2) as $genre)
                                                        <span class="px-2 py-1 text-xs font-medium text-white rounded-full {{ getGenreColor($genre->name, $genreColors) }}">
                                                            {{ $genre->name }}
                                                        </span>
                                                    @endforeach
                                                    @if ($movie->genres->count() > 2)
                                                        <span class="px-2 py-1 text-xs font-medium text-gray-600 bg-gray-200 rounded-full">
                                                            +{{ $movie->genres->count() - 2 }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @elseif ($movie->genre_names)
                                            @php
                                                $genreArray = array_map('trim', explode(', ', $movie->genre_names));
                                            @endphp
                                            <div class="mb-4">
                                                <div class="flex flex-wrap gap-1">
                                                    @foreach (array_slice($genreArray, 0, 2) as $genreName)
                                                        <span class="px-2 py-1 text-xs font-medium text-white rounded-full {{ getGenreColor($genreName, $genreColors) }}">
                                                            {{ $genreName }}
                                                        </span>
                                                    @endforeach
                                                    @if (count($genreArray) > 2)
                                                        <span class="px-2 py-1 text-xs font-medium text-gray-600 bg-gray-200 rounded-full">
                                                            +{{ count($genreArray) - 2 }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif

                                        <!-- Action Buttons -->
                                        <div class="flex space-x-2">
                                            <a href="{{ route('films.show', $movie->id) }}"
                                                class="flex-1 bg-gradient-to-r from-blue-400 to-blue-500 hover:from-purple-600 hover:to-purple-700 text-white text-center py-2 px-3 rounded-lg font-medium transition-all duration-300 transform hover:scale-105 text-sm">
                                                <i class="fas fa-eye mr-1"></i>Details
                                            </a>
                                            @if ($movie->link_trailer)
                                                <a href="{{ $movie->link_trailer }}" target="_blank"
                                                    class="bg-red-600 hover:bg-red-700 text-white py-2 px-3 rounded-lg font-medium transition-all duration-300 transform hover:scale-105 text-sm">
                                                    <i class="fab fa-youtube"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20">
                        <div class="bg-white rounded-2xl p-12 max-w-md mx-auto shadow-lg border border-gray-200">
                            <i class="fas fa-film text-6xl text-gray-400 mb-6"></i>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">No Movies Available</h3>
                            <p class="text-gray-600">Check back later for new movie releases!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        const toggleButton = document.getElementById('genre-toggle');
        const allView = document.getElementById('all-view');
        const filterView = document.getElementById('filter-view');

        toggleButton.addEventListener('click', () => {
            if (allView.classList.contains('hidden')) {
                allView.classList.remove('hidden');
                filterView.classList.add('hidden');
                toggleButton.textContent = 'Genre';
                toggleButton.classList.remove('bg-blue-600', 'text-white');
                toggleButton.classList.add('bg-gray-200', 'text-gray-800');
            } else {
                allView.classList.add('hidden');
                filterView.classList.remove('hidden');
                toggleButton.textContent = 'All';
                toggleButton.classList.remove('bg-gray-200', 'text-gray-800');
                toggleButton.classList.add('bg-blue-600', 'text-white');
            }
        });
    </script>
@endsection
