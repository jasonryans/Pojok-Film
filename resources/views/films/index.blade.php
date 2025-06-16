<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Film
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <a href="{{ route('films.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Film
        </a>

        @if(session('success'))
            <div class="mt-4 text-green-600">{{ session('success') }}</div>
        @endif

        <div class="mt-6">
            <table class="min-w-full bg-white rounded">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Judul</th>
                        <th class="px-4 py-2 border">Genre</th>
                        <th class="px-4 py-2 border">Tahun</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($films as $film)
                        <tr>
                            <td class="border px-4 py-2">{{ $film->name }}</td>
                            <td class="border px-4 py-2">
                                @foreach ($film->genres as $genre)
                                    <span class="inline-block bg-gray-200 text-gray-800 text-xs px-2 py-1 rounded mr-1">{{ $genre->name }}</span>
                                @endforeach
                            </td>
                            <td class="border px-4 py-2">{{ $film->release_date }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('films.edit', $film) }}" class="text-blue-600">Edit</a>
                                |
                                <form action="{{ route('films.destroy', $film) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin mau hapus?')" class="text-red-600 ml-2">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
