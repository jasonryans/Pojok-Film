<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Film
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <form action="{{ route('films.update', $film) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label>Judul</label>
                <input type="text" name="name" value="{{ $film->name }}" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Sinopsis</label>
                <textarea name="description" class="w-full border rounded p-2" required>{{ $film->description }}</textarea>
            </div>
            <div>
                <label>Genre</label>
                <input type="text" name="genre" value="{{ $film->genre }}" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Tahun</label>
                <input type="number" name="tahun" value="{{ $film->release_date }}" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Poster Saat Ini:</label><br>
                @if($film->poster)
                    <img src="{{ asset('storage/' . $film->poster) }}" width="150" class="rounded mb-2">
                @else
                    <p>(Belum ada poster)</p>
                @endif
            </div>
            <div>
                <label>Ganti Poster (opsional):</label>
                <input type="file" name="poster" class="w-full">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
