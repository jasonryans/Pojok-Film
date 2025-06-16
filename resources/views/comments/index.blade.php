<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Daftar Komentar Pengguna
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif

        <table class="min-w-full bg-white rounded">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Film</th>
                    <th class="px-4 py-2 border">User</th>
                    <th class="px-4 py-2 border">Isi Komentar</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <td class="border px-4 py-2">{{ $comment->film->judul }}</td>
                        <td class="border px-4 py-2">{{ $comment->user->name }}</td>
                        <td class="border px-4 py-2">{{ $comment->isi }}</td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin hapus komentar ini?')" class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
