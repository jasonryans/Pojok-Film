@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Tambah Aktor</h1>
    <form action="{{ route('actors.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium">Nama</label>
            <input type="text" name="name" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="block font-medium">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="block font-medium">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="select select-bordered w-full" required>
                <option value="">Pilih</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div>
            <label class="block font-medium">Deskripsi</label>
            <textarea name="deskripsi" class="textarea textarea-bordered w-full"></textarea>
        </div>
        <div>
            <label class="block font-medium">Foto</label>
            <input type="file" name="foto" class="file-input file-input-bordered w-full">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('actors.index') }}" class="btn btn-secondary ml-2">Kembali</a>
    </form>
</div>
@endsection
