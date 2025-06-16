<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Aktor
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <form action="{{ route('actors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label>Nama</label>
                <input type="text" name="nama" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Biografi</label>
                <textarea name="biografi" class="w-full border rounded p-2"></textarea>
            </div>
            <div>
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="w-full border rounded p-2">
            </div>
            <div>
                <label>Foto Aktor</label>
                <input type="file" name="foto" class="w-full">
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
