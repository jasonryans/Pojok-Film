@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
    <h1 class="text-2xl font-bold mb-4">Daftar Aktor</h1>
    <a href="{{ route('actors.create') }}" class="btn btn-primary mb-3">Tambah Aktor</a>
    @if(session('success'))
        <div class="alert alert-success mb-3">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto rounded-xl shadow">
        <table class="table w-full">
            <thead>
                <tr>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($actors as $actor)
                <tr class="border-b hover:bg-gray-50">
                    <td>
                        @if($actor->photo)
                            <img src="{{ asset('storage/' . $actor->photo) }}" alt="Foto" class="w-12 h-12 rounded-full object-cover">
                        @else
                            <span class="italic text-gray-400">No Image</span>
                        @endif
                    </td>
                    <td>{{ $actor->name }}</td>
                    <td>{{ $actor->born_date }}</td>
                    <td>{{ $actor->gender ? "Laki-laki" : "Perempuan" }}</td>
                    <td class="flex gap-1">
                        <a href="{{ route('actors.edit', $actor) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('actors.destroy', $actor) }}" method="POST" onsubmit="return confirm('Yakin hapus aktor?')" class="inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-error btn-sm">Hapus</button>
                        </form>
                        <a href="{{ route('actors.show', $actor) }}" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
