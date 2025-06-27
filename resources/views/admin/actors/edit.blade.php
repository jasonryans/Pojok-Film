<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Aktor
        </h2>
    </x-slot>
<div class="max-w-xl mx-auto py-8">
    <form action="{{ route('admin.actors.update', $actor) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block font-medium dark:text-gray-200">Nama</label>
            <input type="text" name="name" value="{{ old('name', $actor->name) }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="block font-medium dark:text-gray-200">Tanggal Lahir</label>
            <input type="date" name="born_date" value="{{ old('born_date', $actor->born_date) }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="block font-medium dark:text-gray-200">Jenis Kelamin</label>
            <select name="gender" class="select select-bordered w-full" required>
                <option value="Laki-laki" {{ old('gender', $actor->gender) ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('gender', $actor->gender) ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div>
            <label class="block font-medium dark:text-gray-200">Deskripsi</label>
            <textarea name="description" class="textarea textarea-bordered w-full">{{ old('description', $actor->description) }}</textarea>
        </div>
        <div>
            <label class="block font-medium dark:text-gray-200">Foto</label>
            <input type="file" name="photo" class="file-input file-input-bordered w-full dark:text-gray-200">
            @if($actor->photo)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $actor->photo) }}" alt="Foto" class="w-20 h-20 rounded-full object-cover">
                </div>
            @endif
        </div>
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Update</button>
        <a href="{{ route('admin.actors.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded ml-2">Kembali</a>
    </form>
</div>
</x-app-layout>