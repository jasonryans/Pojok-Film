<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Aktor
        </h2>
    </x-slot>
<div class="max-w-xl mx-auto py-8">
    <form action="{{ route('admin.actors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium dark:text-gray-200">Nama</label>
            <input type="text" name="name" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>
        <div>
            <label class="block font-medium dark:text-gray-200">Tanggal Lahir</label>
            <input type="date" name="born_date" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
        </div>
        <div>
            <label class="block font-medium dark:text-gray-200">Jenis Kelamin</label>
            <select name="gender" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                <option value="">Pilih</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div>
            <label class="block font-medium dark:text-gray-200">Deskripsi</label>
            <textarea name="description" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
        </div>
        <div>
            <label class="block font-medium dark:text-gray-200">Foto</label>
            <input type="file" name="photo" class="file-input file-input-bordered w-full dark:text-gray-200">
        </div>
        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('admin.actors.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded ml-2">Kembali</a>
    </form>
</div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#d33',
        });
    </script>
    @endif
</x-app-layout>