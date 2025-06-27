<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Film
        </h2>
    </x-slot>

    <div class="py-6 px-6">
        <form action="{{ route('admin.films.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="dark:text-gray-200">Judul</label>
                <input type="text" name="name"
                    class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>
            <div>
                <label class="dark:text-gray-200">Sinopsis</label>
                <textarea name="description" class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    required></textarea>
            </div>
            <div>
                <label class="block mb-2 font-medium dark:text-gray-200">Genre</label>
                <div
                    class="grid grid-cols-2 md:grid-cols-3 gap-3 p-4 border rounded bg-gray-50 dark:bg-gray-800 dark:border-gray-600">
                    @foreach ($genres as $genre)
                        <label
                            class="flex items-center space-x-2 dark:text-gray-200 cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 p-2 rounded">
                            <input type="checkbox" name="genre[]" value="{{ $genre->id }}"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <span class="text-sm">{{ $genre->name }}</span>
                        </label>
                    @endforeach
                </div>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Pilih satu atau lebih genre untuk film ini.</p>
            </div>
            <div>
                <label class="dark:text-gray-200">Tahun</label>
                <input type="date" name="release_date"
                    class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>
            <div>
                <label class="dark:text-gray-200">Link trailer</label>
                <input type="text" name="link_trailer"
                    class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>
            <div>
                <label class="dark:text-gray-200">Durasi (menit)</label>
                <input type="number" name="duration"
                    class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>
            <div>
                <label class="dark:text-gray-200">Poster</label>
                <input type="file" name="poster" class="w-full dark:text-gray-200">
            </div>

            <div>
                <label class="block mb-2 font-medium dark:text-gray-200">Actor</label>
                <select name="actor[]" multiple required
                    class="w-full border rounded p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    size="6">
                    @foreach ($actors as $actor)
                        <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Gunakan Ctrl (Windows) / Cmd (Mac) untuk
                    memilih lebih dari satu actor.</p>
            </div>

            <div class="flex space-x-2">
                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
                <a href="{{ route('admin.dashboard') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">Kembali</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validasi Gagal',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#d33',
        });
    </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const genreContainer = document.querySelector('.grid');
            if (genreContainer) {
                const selectAllDiv = document.createElement('div');
                selectAllDiv.className = 'col-span-full mb-2';
                selectAllDiv.innerHTML = `
                    <label class="flex items-center space-x-2 dark:text-gray-200 cursor-pointer">
                        <input type="checkbox" id="select-all-genres" class="w-4 h-4 text-blue-600">
                        <span class="text-sm font-medium">Pilih Semua Genre</span>
                    </label>
                `;
                genreContainer.insertBefore(selectAllDiv, genreContainer.firstChild);

                const selectAllCheckbox = document.getElementById('select-all-genres');
                const genreCheckboxes = document.querySelectorAll('input[name="genre[]"]');

                selectAllCheckbox.addEventListener('change', function() {
                    genreCheckboxes.forEach(checkbox => {
                        checkbox.checked = this.checked;
                    });
                });

                genreCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        const checkedCount = document.querySelectorAll(
                            'input[name="genre[]"]:checked').length;
                        selectAllCheckbox.checked = checkedCount === genreCheckboxes.length;
                        selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount <
                            genreCheckboxes.length;
                    });
                });
            }
        });
    </script>
</x-app-layout>
