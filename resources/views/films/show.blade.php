@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
    <div class="flex items-start gap-6">
        @if($film->poster)
            <img src="{{ asset('storage/' . $film->poster) }}" class="w-32 h-44 object-cover rounded shadow" alt="{{ $film->name }}">
        @endif
        <div>
            <h1 class="text-3xl font-bold mb-2">{{ $film->name }} ({{ $film->release_date }})</h1>
            <div class="mb-1">
                <span class="font-semibold">Genre: </span>
                @foreach($film->genres as $genre)
                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mr-1">{{ $genre->name }}</span>
                @endforeach
            </div>
            <div class="mb-1">
                <span class="font-semibold">Link Trailer: </span>
                <a href="{{ $film->link_trailer }}" class="text-blue-500 underline" target="_blank">{{ $film->link_trailer }}</a>
            </div>
            <div class="mb-1">
                <span class="font-semibold">Durasi: </span>{{ $film->duration }} menit
            </div>
            <div class="mb-1">
                <span class="font-semibold">Rating: </span>{{ $film->rating }}/10
            </div>
        </div>
    </div>

    <div class="mt-6">
        <span class="font-semibold">Aktor:</span>
        <div class="flex gap-2 mt-2 flex-wrap">
            @foreach($film->actors->take(4) as $actor)
                <div class="flex flex-col items-center">
                    @if($actor->photo)
                        <img src="{{ asset('storage/' . $actor->photo) }}" class="w-10 h-10 rounded-full object-cover mb-1" alt="{{ $actor->name }}">
                    @endif
                    <span class="text-xs text-center">{{ $actor->name }}</span>
                </div>
            @endforeach
            @if($film->actors->count() > 4)
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-200">+{{ $film->actors->count() - 4 }}</div>
            @endif
        </div>
    </div>

    <div class="mt-6">
        <span class="font-semibold">Deskripsi:</span>
        <p class="text-gray-800 mt-2">{{ $film->description }}</p>
    </div>

    <!-- Review Section (opsional, placeholder saja) -->
    <div class="mt-8">
        <span class="font-semibold">Review:</span>
        <form action="#" method="POST" class="flex gap-2 mt-2">
            <textarea name="review" rows="2" class="textarea textarea-bordered w-full" placeholder="Tulis review kamu..."></textarea>
            <input type="number" name="rating" min="1" max="10" class="input input-bordered w-20" placeholder="Rating">
            <button class="btn btn-primary">Submit</button>
        </form>
        <div class="mt-4">
            <!-- Loop review di sini -->
            {{-- @foreach($film->reviews as $review)
                <div class="border p-2 rounded mb-2">
                    <div class="flex justify-between">
                        <span class="font-semibold">{{ $review->user->username }}</span>
                        <span class="text-yellow-600">{{ $review->rating }}/10</span>
                    </div>
                    <p class="text-gray-700">{{ $review->review }}</p>
                </div>
            @endforeach --}}
        </div>
    </div>
</div>
@endsection
