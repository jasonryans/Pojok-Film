@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Tambah Film</h1>

    <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block font-medium">Judul</label>
            <input type="text" name="name" value="{{ old('name') }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="block font-medium">Deskripsi</label>
            <textarea name="description" class="textarea textarea-bordered w-full" required>{{ old('description') }}</textarea>
        </div>
        <div>
            <label class="block font-medium">Genre</label>
            <select name="genre[]" multiple required class="select select-bordered w-full">
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}">{{ $genre->name }}</option>
                @endforeach
            </select>
            <span class="text-sm text-gray-500">Tekan Ctrl/Command untuk pilih lebih dari satu</span>
        </div>
        <div>
            <label class="block font-medium">Tahun Rilis</label>
            <input type="number" name="release_date" value="{{ old('release_date') }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="block font-medium">Durasi (menit)</label>
            <input type="number" name="duration" value="{{ old('duration') }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="block font-medium">Link Trailer</label>
            <input type="text" name="link_trailer" value="{{ old('link_trailer') }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="block font-medium">Poster</label>
            <input type="file" name="poster" class="file-input file-input-bordered w-full">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('films.index') }}" class="btn btn-secondary ml-2">Kembali</a>
    </form>
</div>
@endsection
