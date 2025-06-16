<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Aktor
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <form action="{{ route('actors.update', $actor) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label>Nama</label>
                <input type="text" name="nama" value="{{ $actor->nama }}" class="w-full border rounded p-2" required>
            </div>
            <div>
                <label>Biografi</label>
                <textarea name="biografi" class="w-full border rounded p-2">{{ $actor->biografi }}</textarea>
            </div>
            <div>
                <label>Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" value="{{ $actor->tanggal_lahir }}" class="w-full border rounded p-2">
            </div>
            <div>
                <label>Foto Saat Ini:</label><br>
                @if($actor->foto)
                    <img src="{{ asset('storage/' . $actor->foto) }}" width="150" class="rounded mb-2">
                @else
                    <p>(Belum ada foto)</p>
                @endif
            </div>
            <div>
                <label>Ganti Foto (opsional):</label>
                <input type="file" name="foto" class="w-full">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</x-app-layout>
