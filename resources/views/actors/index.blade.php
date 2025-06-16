<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Aktor
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <a href="{{ route('actors.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Aktor
        </a>

        @if(session('success'))
            <div class="mt-4 text-green-600">{{ session('success') }}</div>
        @endif

        <div class="mt-6">
            <table class="min-w-full bg-white rounded">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border">Nama</th>
                        <th class="px-4 py-2 border">Tanggal Lahir</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($actors as $actor)
                        <tr>
                            <td class="border px-4 py-2">{{ $actor->nama }}</td>
                            <td class="border px-4 py-2">{{ $actor->tanggal_lahir }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('actors.edit', $actor) }}" class="text-blue-600">Edit</a> |
                                <form action="{{ route('actors.destroy', $actor) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Hapus aktor ini?')" class="text-red-600 ml-2">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
