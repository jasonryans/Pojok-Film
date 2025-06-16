@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Edit Aktor</h1>
    <form action="{{ route('actors.update', $actor) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')
        <div>
            <label class="block font-medium">Nama</label>
            <input type="text" name="name" value="{{ old('name', $actor->name) }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="block font-medium">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $actor->tanggal_lahir) }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="block font-medium">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="select select-bordered w-full" required>
                <option value="Laki-laki" {{ old('jenis_kelamin', $actor->jenis_kelamin)=='Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $actor->jenis_kelamin)=='Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div>
            <label class="block font-medium">Deskripsi</label>
            <textarea name="deskripsi" class="textarea textarea-bordered w-full">{{ old('deskripsi', $actor->deskripsi) }}</textarea>
        </div>
        <div>
            <label class="block font-medium">Foto</label>
            <input type="file" name="foto" class="file-input file-input-bordered w-full">
            @if($actor->foto)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $actor->foto) }}" alt="Foto" class="w-20 h-20 rounded-full object-cover">
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('actors.index') }}" class="btn btn-secondary ml-2">Kembali</a>
    </form>
</div>
@endsection
