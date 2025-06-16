@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Daftar Film</h1>
    <a href="{{ route('films.create') }}" class="mb-4 inline-block">
        <button class="btn btn-primary">Tambah Film</button>
    </a>

    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto rounded-xl shadow">
    <table class="table w-full text-left text-gray-600">
        <thead class="bg-gray-100 text-gray-800">
            <tr>
                <th class="py-3 px-4">Poster</th>
                <th class="py-3 px-4">Judul</th>
                <th class="py-3 px-4">Genre</th>
                <th class="py-3 px-4">Durasi</th>
                <th class="py-3 px-4">Tahun</th>
                <th class="py-3 px-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($films as $film)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4">
                        @if($film->poster)
                            <img src="{{ asset('storage/' . $film->poster) }}" alt="Poster" class="w-16 rounded shadow">
                        @else
                            <span class="italic text-gray-400">No Image</span>
                        @endif
                    </td>
                    <td class="py-2 px-4 font-medium">{{ $film->name }}</td>
                    <td class="py-2 px-4">
                        @if($film->genres)
                            @foreach($film->genres as $genre)
                                <span class="badge badge-info mr-1 mb-1">{{ $genre->name }}</span>
                            @endforeach
                        @endif
                    </td>
                    <td class="py-2 px-4">{{ $film->duration }} mnt</td>
                    <td class="py-2 px-4">{{ $film->release_date }}</td>
                    <td class="py-2 px-4 flex gap-1">
                        <a href="{{ route('films.edit', $film) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('films.destroy', $film) }}" method="POST" onsubmit="return confirm('Yakin hapus film?')" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-error btn-sm">Hapus</button>
                        </form>
                        <a href="{{ route('films.show', $film) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
@endsection
