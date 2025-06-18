<x-app-layout>
<div class="max-w-xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Edit Film</h1>

    <form action="{{ route('films.update', $film) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf @method('PUT')

        <div>
            <label class="block font-medium">Judul</label>
            <input type="text" name="name" value="{{ old('name', $film->name) }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="block font-medium">Deskripsi</label>
            <textarea name="description" class="textarea textarea-bordered w-full" required>{{ old('description', $film->description) }}</textarea>
        </div>
        <div>
            <label class="block font-medium">Genre</label>
            <select name="genre[]" multiple required class="select select-bordered w-full">
                @foreach($genres as $genre)
                    <option value="{{ $genre->id }}"
                        {{ in_array($genre->id, $film->genres->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $genre->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-medium">Tahun Rilis</label>
            <input type="date" name="release_date" value="{{ old('release_date', $film->release_date) }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="block font-medium">Durasi (menit)</label>
            <input type="number" name="duration" value="{{ old('duration', $film->duration) }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="block font-medium">Link Trailer</label>
            <input type="text" name="link_trailer" value="{{ old('link_trailer', $film->link_trailer) }}" class="input input-bordered w-full" required>
        </div>
        <div>
            <label class="block font-medium">Poster</label>
            <input type="file" name="poster" class="file-input file-input-bordered w-full">
            @if($film->poster)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $film->poster) }}" alt="Poster" class="w-24 rounded shadow">
                </div>
            @endif
        </div>

        <div>
            <label class="block font-medium">Actor</label>
            <select name="actor[]" multiple required class="select select-bordered w-full">
                @foreach($actors as $actor)
                    <option value="{{ $actor->id }}"
                        {{ in_array($actor->id, $film->actors->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $actor->name }}
                    </option>
                @endforeach
            </select>
            <span class="text-sm text-gray-500">Tekan Ctrl/Command untuk pilih lebih dari satu</span>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('films.index') }}" class="btn btn-secondary ml-2">Kembali</a>
    </form>
</div>
</x-app-layout>
