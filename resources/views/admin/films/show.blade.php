<x-app-layout>
    <div class="max-w-2xl mx-auto py-8">
        <div class="flex items-start gap-6">
            @if ($film->poster)
                <img src="{{ asset('storage/' . $film->poster) }}" class="w-32 h-44 object-cover rounded shadow"
                    alt="{{ $film->name }}">
            @endif
            <div>
                <h1 class="text-3xl font-bold mb-2 dark:text-gray-200">{{ $film->name }} ({{ $film->release_date }})
                </h1>
                <div class="mb-1">
                    <span class="font-semibold dark:text-gray-200">Genre: </span>
                    @foreach ($film->genres as $genre)
                        <span
                            class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mr-1">{{ $genre->name }}</span>
                    @endforeach
                </div>
                <div class="mb-1">
                    <span class="font-bold mb-2 dark:text-gray-200">Link Trailer: </span>
                    <a href="{{ $film->link_trailer }}" class="text-blue-500 underline"
                        target="_blank">{{ $film->link_trailer }}</a>
                </div>
                <div class="mb-1 dark:text-gray-500 mt-2">
                    <span class="font-bold mb-2 dark:text-gray-200">Durasi: </span>{{ $film->duration }} menit
                </div>
                <div class="mb-1 dark:text-gray-500 mt-2">
                    <span class="font-bold mb-2 dark:text-gray-200">Rating: </span>{{ $film->rating }}/10
                </div>
            </div>
        </div>

        <div class="mt-6">
            <span class="font-bold mb-2 dark:text-gray-200">Aktor:</span>
            <div class="flex gap-2 mt-2 flex-wrap">
                @foreach ($film->actors->take(4) as $actor)
                    <div class="flex flex-col items-center">
                        @if ($actor->photo)
                            <img src="{{ asset('storage/' . $actor->photo) }}"
                                class="w-10 h-10 rounded-full object-cover mb-1" alt="{{ $actor->name }}">
                        @endif
                        <span class="text-xs text-center dark:text-gray-500 mt-2">{{ $actor->name }}</span>
                    </div>
                @endforeach
                @if ($film->actors->count() > 4)
                    <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200">
                        +{{ $film->actors->count() - 4 }}</div>
                @endif
            </div>
        </div>

        <div class="mt-6">
            <span class="font-bold mb-2 dark:text-gray-200">Deskripsi:</span>
            <p class="dark:text-gray-500 mt-2">{{ $film->description }}</p>
        </div>

        <div class="mt-6">
            <iframe width="100%" height="500" 
                src="https://www.youtube.com/embed/{{ $film->link_trailer }}" 
                title="YouTube video player" frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                allowfullscreen>
            </iframe>                 
        </div>
    </div>
</x-app-layout>
