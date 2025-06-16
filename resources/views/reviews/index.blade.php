<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">Moderasi Komentar</h2>
    </x-slot>

    <div class="py-6 px-6">
        @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        <table class="w-full bg-white rounded">
            <thead>
                <tr>
                    <th class="border px-4 py-2">User</th>
                    <th class="border px-4 py-2">Film</th>
                    <th class="border px-4 py-2">Rating</th>
                    <th class="border px-4 py-2">Komentar</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td class="border px-4 py-2">{{ $review->user->name }}</td>
                        <td class="border px-4 py-2">{{ $review->film->judul }}</td>
                        <td class="border px-4 py-2">{{ $review->rating }}/10</td>
                        <td class="border px-4 py-2">{{ $review->review }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus komentar ini?')" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
