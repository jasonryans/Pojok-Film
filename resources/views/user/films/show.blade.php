@extends('user.base')

@section('user.content')
<!-- Hero Section with Gradient Background -->
<div class="gradient-bg relative overflow-hidden -mx-8 -mt-8 mb-12">
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Back Button -->
        <div class="mb-8 pt-12">
            <a href="{{ route('home') }}" class="inline-flex items-center text-white hover:text-blue-200 transition-all duration-300 transform hover:scale-105 group">
                <div class="p-3 rounded-full bg-white/10 backdrop-blur-sm group-hover:bg-white/20 transition-all duration-300 mr-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                <span class="text-xl font-semibold">Back to Movies</span>
            </a>
        </div>

        <!-- Movie Header -->
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 mb-12">
            <!-- Movie Poster -->
            <div class="flex-shrink-0">
                <div class="w-80 h-[480px] bg-white/20 rounded-3xl overflow-hidden shadow-2xl backdrop-blur-sm border border-white/30 hover:scale-105 transition-transform duration-300">
                    <img src="{{ Str::startsWith($film->poster, 'http') ? $film->poster : ($film->poster ? asset('storage/' . $film->poster) : 'https://via.placeholder.com/320x480?text=Movie+Poster') }}" 
                         alt="{{ $film->name }} poster" 
                         class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Movie Info -->
            <div class="flex-1 text-white">
                <h1 class="text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    {{ $film->name }} 
                    <span class="text-3xl lg:text-4xl font-medium text-blue-200">({{ $film->release_date }})</span>
                </h1>
                
                <div class="space-y-4 text-lg lg:text-xl mb-8">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="font-semibold text-blue-200">Genres:</span>
                        @foreach ($film->genres as $genre)
                            <span class="px-4 py-2 bg-white/20 rounded-full backdrop-blur-sm">{{ $genre->name }}</span>
                        @endforeach
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <span class="font-semibold text-blue-200">Rating:</span>
                        <div class="flex items-center gap-2">
                            <span class="text-3xl font-bold text-yellow-400">{{ $film->rating }}</span>
                            <span class="text-xl text-blue-200">/10</span>
                            <div class="flex ml-4">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-6 h-6 {{ $i <= floor($film->rating/2) ? 'text-yellow-400' : 'text-gray-400' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="font-semibold text-blue-200">Trailer:</span>
                        <a href="{{ Str::startsWith($film->link_trailer, 'http') ? $film->link_trailer : 'https://' . $film->link_trailer }}" 
                           target="_blank" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 rounded-full font-semibold transition-colors duration-300">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                            </svg>
                            Watch Trailer
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Synopsis Section -->
    <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 mb-12 border border-gray-100">
        <div class="flex items-center gap-4 mb-8">
            <div class="p-4 bg-gradient-to-r from-green-100 to-teal-100 rounded-2xl">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <h3 class="text-4xl md:text-5xl font-bold text-gray-900">Synopsis</h3>
        </div>
        
        <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl p-8 border border-gray-200">
            <p class="text-xl md:text-2xl text-gray-700 leading-relaxed font-medium">
                {{ $film->description }}
            </p>
        </div>
    </div>

    <!-- Cast Section -->
    <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 mb-12 border border-gray-100">
        <div class="flex items-center gap-4 mb-8">
            <div class="p-4 bg-gradient-to-r from-purple-100 to-pink-100 rounded-2xl">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
            <h3 class="text-4xl md:text-5xl font-bold text-gray-900">Cast & Crew</h3>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 md:gap-8">
            @foreach ($film->actors as $actor)
                <a href="{{ route('actors.show', $actor->id) }}" class="group cursor-pointer transform transition-all duration-300 hover:scale-110">
                    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200 group-hover:border-purple-300">
                        <div class="w-24 h-24 md:w-28 md:h-28 bg-gradient-to-br from-purple-200 to-blue-200 rounded-full mx-auto mb-4 overflow-hidden shadow-lg group-hover:shadow-xl transition-all duration-300">
                            @if ($actor->photo)
                                <img src="{{ Str::startsWith($actor->photo, 'http') ? $actor->photo : asset('storage/' . $actor->photo) }}" 
                                     alt="{{ $actor->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-10 h-10 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <p class="text-lg md:text-xl font-semibold text-gray-800 group-hover:text-purple-600 transition-colors duration-300 leading-tight">
                            {{ $actor->name }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Trailer Section -->
    <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 mb-12 border border-gray-100">
        <div class="flex items-center gap-4 mb-8">
            <div class="p-4 bg-gradient-to-r from-red-100 to-pink-100 rounded-2xl">
                <svg class="w-8 h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <h3 class="text-4xl md:text-5xl font-bold text-gray-900">Official Trailer</h3>
        </div>
        
        <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-black">
            @if($film->link_trailer)
                @php
                    // Extract YouTube video ID from URL
                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $film->link_trailer, $matches);
                    $videoId = $matches[1] ?? null;
                @endphp
                
                @if($videoId)
                    <iframe
                        class="w-full h-64 md:h-96 lg:h-[500px]"
                        src="https://www.youtube.com/embed/{{ $videoId }}"
                        title="Movie Trailer"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                @else
                    <div class="w-full h-64 md:h-96 lg:h-[500px] flex items-center justify-center bg-gradient-to-br from-gray-800 to-gray-900">
                        <div class="text-center text-white">
                            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-xl">Trailer not available</p>
                        </div>
                    </div>
                @endif
            @else
                <div class="w-full h-64 md:h-96 lg:h-[500px] flex items-center justify-center bg-gradient-to-br from-gray-800 to-gray-900">
                    <div class="text-center text-white">
                        <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-xl">Trailer not available</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 border border-gray-100">
        <div class="flex items-center gap-4 mb-8">
            <div class="p-4 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-2xl">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
            </div>
            <h3 class="text-4xl md:text-5xl font-bold text-gray-900">Reviews & Ratings</h3>
        </div>

        <!-- Review Form -->
        @auth
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8 mb-8 border border-blue-200">
                <h4 class="text-2xl font-bold text-gray-900 mb-6">Share Your Thoughts</h4>
                <form action="{{ route('reviews.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="film_id" value="{{ $film->id }}">
                    
                    <textarea 
                        name="review"
                        rows="5" 
                        class="w-full p-4 border-2 border-blue-200 focus:border-blue-400 rounded-xl resize-none text-lg"
                        placeholder="Write your review here... What did you think about the movie?"
                        required></textarea>
                    
                    <div class="flex flex-col sm:flex-row gap-6 items-start sm:items-end">
                        <div class="space-y-2">
                            <label class="text-lg font-medium text-gray-700">Your Rating</label>
                            <div class="flex items-center gap-3">
                                <input
                                    type="number"
                                    name="rating"
                                    placeholder="8.5"
                                    min="1"
                                    max="10"
                                    step="0.1"
                                    class="w-20 text-center text-lg font-semibold border-2 border-blue-200 focus:border-blue-400 rounded-lg p-2"
                                    required
                                />
                                <span class="text-lg text-gray-600 font-medium">/10</span>
                                <svg class="w-6 h-6 text-yellow-500 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <button 
                            type="submit"
                            class="bg-blue-600 hover:from-blue-700 hover:to-indigo-700 text-white px-8 py-3 rounded-xl text-lg font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Submit Review
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl p-8 mb-8 border border-amber-200 text-center">
                <p class="text-xl text-gray-700 mb-4">Want to share your thoughts?</p>
                <a href="{{ route('login', ['redirect' => url()->current()]) }}" 
                   class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-xl text-lg font-semibold transition-all duration-300 transform hover:scale-105">
                    Log In to Review
                </a>
            </div>
        @endauth

        <!-- Reviews List -->
        <div class="space-y-6">
            <h4 class="text-2xl font-semibold text-gray-800 mb-6">What Others Are Saying</h4>
            @forelse($film->reviews as $review)
                <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-2xl p-6 md:p-8 shadow-lg border border-gray-200 hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02]">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-blue-400 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                {{ strtoupper(substr($review->user->username, 0, 1)) }}
                            </div>
                            <span class="text-xl font-semibold text-gray-800">{{ $review->user->username }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-yellow-100 px-4 py-2 rounded-full">
                            <svg class="w-5 h-5 text-yellow-500 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span class="text-lg font-bold text-yellow-700">{{ $review->rating }}/10</span>
                        </div>
                    </div>
                    <p class="text-lg text-gray-700 leading-relaxed font-medium">
                        {{ $review->review }}
                    </p>
                </div>
            @empty
                <div class="text-center py-12">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <p class="text-xl text-gray-500">No reviews yet. Be the first to review this movie!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
</style>

<!-- SweetAlert2 for notifications -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6',
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#d33',
    });
</script>
@endif

@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        html: `{!! implode('<br>', $errors->all()) !!}`,
        confirmButtonColor: '#d33',
    });
</script>
@endif
@endsection