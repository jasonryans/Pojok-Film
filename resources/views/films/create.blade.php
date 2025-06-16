<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Film
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label>Judul</label>
                <input type="text" name="name" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Sinopsis</label>
                <textarea name="description" class="w-full border rounded p-2" required></textarea>
            </div>
            <div>
                <label class="block mb-2 font-medium">Genre</label>
                <select name="genre[]" multiple required class="w-full border rounded p-2">
                    @foreach ($genres as $genre)
                        <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 mt-1">Gunakan Ctrl (Windows) / Cmd (Mac) untuk memilih lebih dari satu genre.</p>
            </div>
            <div>
                <label>Tahun</label>
                <input type="date" name="release_date" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Link trailer</label>
                <input type="text" name="link_trailer" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Durasi (menit)</label>
                <input type="number" name="duration" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Poster</label>
                <input type="file" name="poster" class="w-full">
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
