<x-app-layout>
    {{-- <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 -mx-4 -my-2 px-4 py-6">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Moderasi Komentar
            </h2>
            <p class="text-blue-100 mt-2">Kelola dan moderasi ulasan film dari pengguna</p>
        </div>
    </x-slot> --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Moderasi Komentar
        </h2>
    </x-slot>

    <div class="py-8 px-6">
        @if(session('success'))
            <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <p class="text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Reviews</p>
                        <p class="text-2xl font-bold text-gray-900">{{ count($reviews) }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Rata-rata Rating</p>
                        <p class="text-2xl font-bold text-gray-900">
                            {{ count($reviews) > 0 ? number_format($reviews->avg('rating'), 1) : '0' }}/10
                        </p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Unique Users</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $reviews->unique('user_id')->count() }}</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Table -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-7H5m14 14H5"></path>
                    </svg>
                    Daftar Review
                </h3>
            </div>
            
            @if(count($reviews) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Film</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Komentar</th>
                                <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($reviews as $review)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                @if($review->user->profile_picture)
                                                    <img class="h-10 w-10 rounded-full object-cover" 
                                                        src="{{ asset('storage/' . $review->user->profile_picture) }}" 
                                                        alt="{{ $review->user->username }}'s profile picture"
                                                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-400 to-purple-500 items-center justify-center hidden">
                                                        <span class="text-white font-semibold text-sm">
                                                            {{ strtoupper(substr($review->user->username, 0, 2)) }}
                                                        </span>
                                                    </div>
                                                @else
                                                    <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center">
                                                        <span class="text-white font-semibold text-sm">
                                                            {{ strtoupper(substr($review->user->username, 0, 2)) }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $review->user->username }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $review->film->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            @for($i = 1; $i <= 5; $i++)
                                                <svg class="w-4 h-4 {{ $i <= ($review->rating / 2) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            @endfor
                                            <span class="ml-2 text-sm font-medium text-gray-700">{{ $review->rating }}/10</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $review->review }}">
                                            {{ $review->review }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Apakah Anda yakin ingin menghapus komentar ini?')" 
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10m0 0V6a2 2 0 00-2-2H9a2 2 0 00-2 2v2m10 0v10a2 2 0 01-2 2H9a2 2 0 01-2-2V8m10 0H7"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada review</h3>
                    <p class="mt-1 text-sm text-gray-500">Belum ada review yang perlu dimoderasi.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>