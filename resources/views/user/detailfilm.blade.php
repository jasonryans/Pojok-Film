@extends('user.base')
<div class="min-h-screen bg-gray-50 pt-24 pb-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="" class="inline-flex items-center text-gray-600 hover:text-gray-900 transition-colors">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="text-sm font-medium">Back</span>
            </a>
        </div>

        <!-- Main Content -->
                <!-- Header -->
                <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between mb-8">
                    <div class="flex items-start space-x-4 lg:space-x-6 mb-4 lg:mb-0">
                        <!-- Movie Poster -->
                        <div class="flex-shrink-0">
                            <div class="w-24 h-36 lg:w-32 lg:h-48 bg-gray-200 rounded-lg border-2 border-gray-300 flex items-center justify-center">
                                <svg class="w-8 h-8 lg:w-12 lg:h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Movie Info -->
                        <div class="flex-1">
                            <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-3">Judul (2025)</h1>
                            <div class="space-y-2 text-sm text-gray-600">
                                <p><span class="font-medium">Genre:</span> Action, Drama</p>
                                <p><span class="font-medium">Link Trailer:</span> 
                                    <a href="#" class="text-blue-600 hover:text-blue-800 underline">Watch Trailer</a>
                                </p>
                                <div class="flex items-center">
                                    <span class="font-medium mr-2">Rating:</span>
                                    <div class="flex items-center">
                                        <span class="text-yellow-500 text-lg font-bold">10/10</span>
                                        <div class="flex ml-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                                                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                                </svg>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cast -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Actors:</h3>
                    <div class="flex flex-wrap gap-3">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="bg-gray-100 rounded-lg p-3 text-center w-20 lg:w-24">
                                <div class="w-14 h-14 lg:w-16 lg:h-16 bg-gray-300 rounded-full mx-auto mb-2"></div>
                                <p class="text-sm font-medium text-gray-700">Actor {{ $i }}</p>
                            </div>
                        @endfor
                        <button class="bg-gray-100 rounded-lg p-3 text-center w-20 lg:w-24 hover:bg-gray-200 transition-colors">
                            <div class="w-14 h-14 lg:w-16 lg:h-16 bg-gray-300 rounded-full mx-auto mb-2 flex items-center justify-center">
                                <span class="text-gray-600 text-xs">See more</span>
                            </div>
                        </button>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Deskripsi:</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    </p>
                </div>

                <!-- Reviews Section -->
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Reviews</h3>
                    
                    <!-- Review Form -->
                    <div class="mb-6">
                        <textarea 
                            class="w-full p-3 border border-gray-300 rounded-lg resize-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                            rows="3" 
                            placeholder="Type your review here">
                        </textarea>
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-3 gap-3">
                            <div class="flex items-center space-x-4">
                                <span class="text-sm text-gray-600">Rating</span>
                                <div class="flex items-center space-x-2">
                                    <input type="number" class="w-12 px-2 py-1 border border-gray-300 rounded text-center text-sm" placeholder="8" min="1" max="10">
                                    <span class="text-sm text-gray-600">/10</span>
                                </div>
                            </div>
                            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-medium">
                                Submit
                            </button>
                        </div>
                    </div>

                    <!-- Reviews List -->
                    <div class="space-y-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">User 123</span>
                                <span class="text-yellow-600 font-bold">7/10</span>
                            </div>
                            <p class="text-gray-700 text-sm leading-relaxed">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>