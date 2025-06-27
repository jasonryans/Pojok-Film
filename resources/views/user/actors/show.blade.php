
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
                <span class="text-xl font-semibold">Back to Home</span>
            </a>
        </div>

        <!-- Actor Header -->
        <div class="flex flex-col lg:flex-row gap-8 lg:gap-12 mb-12">
            <!-- Actor Photo -->
            <div class="flex-shrink-0">
                <div class="w-80 h-[480px] bg-white/20 rounded-3xl overflow-hidden shadow-2xl backdrop-blur-sm border border-white/30 hover:scale-105 transition-transform duration-300">
                    @if ($actor->photo)
                        <img src="{{ Str::startsWith($actor->photo, 'http') ? $actor->photo : asset('storage/' . $actor->photo) }}" 
                             alt="{{ $actor->name }} photo" 
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-200 to-blue-200">
                            <svg class="w-32 h-32 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actor Info -->
            <div class="flex-1 text-white">
                <h1 class="text-5xl lg:text-6xl font-bold mb-6 leading-tight">
                    {{ $actor->name }}
                </h1>
                
                <div class="space-y-4 text-lg lg:text-xl mb-8">
                    <div class="flex items-center gap-4">
                        <span class="font-semibold text-blue-200">Gender:</span>
                        <div class="flex items-center gap-2">
                            @if($actor->gender == 0)
                                <span class="px-4 py-2 bg-pink-500/20 rounded-full backdrop-blur-sm flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L12 2L3 7V9H5V20H19V9H21Z"/>
                                    </svg>
                                    Female
                                </span>
                            @else
                                <span class="px-4 py-2 bg-blue-500/20 rounded-full backdrop-blur-sm flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 2L13 5H11V8H9V5H7L10 2ZM10 18L7 15H9V12H11V15H13L10 18Z"/>
                                    </svg>
                                    Male
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <span class="font-semibold text-blue-200">Born:</span>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-2xl font-semibold">{{ \Carbon\Carbon::parse($actor->born_date)->format('F d, Y') }}</span>
                            <span class="text-lg text-blue-200">({{ \Carbon\Carbon::parse($actor->born_date)->age }} years old)</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 mb-8">
                        <div class="p-4 bg-gradient-to-r from-green-100 to-teal-100 rounded-2xl">
                            <svg class="w-8 h-8 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-4xl md:text-5xl font-bold text-gray-200">Biography</h3>
                    </div>
                    <p class="text-xl md:text-2xl text-gray-200 leading-relaxed font-medium">
                            {{ $actor->description ?: 'No biography available for this actor.' }}
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <!-- Filmography Section -->
    <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 mb-12 border border-gray-100">
        <div class="flex items-center gap-4 mb-8">
            <div class="p-4 bg-gradient-to-r from-purple-100 to-pink-100 rounded-2xl">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 110 2h-1v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6H3a1 1 0 110-2h4zM9 6v10h6V6H9z"></path>
                </svg>
            </div>
            <h3 class="text-4xl md:text-5xl font-bold text-gray-900">Filmography</h3>
        </div>

        @if($actor->films && $actor->films->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                @foreach ($actor->films as $film)
                    <a href="{{ route('films.show', $film->id) }}" class="group cursor-pointer transform transition-all duration-300 hover:scale-105">
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200 group-hover:border-purple-300">
                            <div class="aspect-[2/3] bg-gradient-to-br from-purple-200 to-blue-200 overflow-hidden">
                                @if ($film->poster)
                                    <img src="{{ Str::startsWith($film->poster, 'http') ? $film->poster : asset('storage/' . $film->poster) }}" 
                                         alt="{{ $film->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-16 h-16 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 110 2h-1v12a2 2 0 01-2-2V6H3a1 1 0 110-2h4zM9 6v10h6V6H9z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <h4 class="text-lg font-bold text-gray-800 group-hover:text-purple-600 transition-colors duration-300 mb-2">
                                    {{ $film->name }}
                                </h4>
                                <p class="text-sm text-gray-600 mb-2">{{ $film->release_date }}</p>
                                @if($film->rating)
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4 text-yellow-500 fill-current" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <span class="text-sm font-semibold text-gray-700">{{ $film->rating }}/10</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2h4a1 1 0 110 2h-1v12a2 2 0 01-2-2V6H3a1 1 0 110-2h4zM9 6v10h6V6H9z"></path>
                </svg>
                <p class="text-xl text-gray-500">No filmography available for this actor.</p>
            </div>
        @endif
    </div>
</div>

<!-- Custom Styles -->
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
</style>
@endsection