<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            List Aktor
        </h2>
    </x-slot>
<div class="max-w-6xl mx-auto py-8">
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 dark:bg-green-800 dark:border-green-600 dark:text-green-100">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif
    <div class="overflow-x-auto rounded-xl shadow">
        <table class="table w-full text-left text-gray-600">
            <thead class="bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                <tr>
                    <th class="py-3 px-4 dark:text-gray-200">Foto</th>
                    <th class="py-3 px-4 dark:text-gray-200">Nama</th>
                    <th class="py-3 px-4 dark:text-gray-200">Tanggal Lahir</th>
                    <th class="py-3 px-4 dark:text-gray-200">Jenis Kelamin</th>
                    <th class="py-3 px-4 dark:text-gray-200">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($actors as $actor)
                <tr class="border-b hover:bg-gray-50 dark:border-gray-600 dark:hover:bg-gray-700">
                    <td class="py-3 px-4">
                        @if($actor->photo)
                            <img src="{{ $actor->photoUrl() }}" alt="Foto" class="w-12 h-12 rounded-full object-cover">
                        @else
                            <span class="italic text-gray-400 dark:text-gray-500">No Image</span>
                        @endif
                    </td>
                    <td class="py-3 px-4 dark:text-gray-200">{{ $actor->name }}</td>
                    <td class="py-3 px-4 dark:text-gray-200">{{ $actor->born_date }}</td>
                    <td class="py-3 px-4 dark:text-gray-200">{{ $actor->gender ? "Laki-laki" : "Perempuan" }}</td>
                    <td class="py-2 px-4 flex gap-1">
                        <a href="{{ route('admin.actors.edit', $actor) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Edit</a>
                        <form action="{{ route('admin.actors.destroy', $actor) }}" method="POST" class="inline delete-form">
                            @csrf @method('DELETE')
                            <button type="button" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm delete-btn" data-actor-name="{{ $actor->name }}">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const actorName = this.getAttribute('data-actor-name');
            const form = this.closest('.delete-form');
            
            Swal.fire({
                title: 'Yakin hapus aktor?',
                text: `Aktor "${actorName}" akan dihapus permanen!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6',
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#d33',
    });
</script>
@endif

@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        html: `{!! implode('<br>', $errors->all()) !!}`,
        confirmButtonColor: '#d33',
    });
</script>
@endif
</x-app-layout>