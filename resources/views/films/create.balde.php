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
                <input type="text" name="judul" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Sinopsis</label>
                <textarea name="sinopsis" class="w-full border rounded p-2" required></textarea>
            </div>
            <div>
                <label>Genre</label>
                <input type="text" name="genre" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Tahun</label>
                <input type="number" name="tahun" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Poster</label>
                <input type="file" name="poster" class="w-full">
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
