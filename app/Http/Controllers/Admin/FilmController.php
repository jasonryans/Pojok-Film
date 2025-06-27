<?php

namespace App\Http\Controllers\Admin;

use App\Models\Film;
use App\Models\Actor;
use App\Models\Genre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function index()
    {
        $films = Film::with('genres')->get();
        return view('admin.films.index', compact('films'));
    }

    public function create()
    {
        $genres = Genre::all();
        $actors = Actor::all();
        return view('admin.films.create', compact('genres', 'actors'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'genre' => 'required|array',
        'release_date' => 'required|date',
        'duration' => 'required|integer',
        'link_trailer' => 'required|string',
        'poster' => 'nullable|image|mimes:jpg,jpeg,png',
        'actor' => 'required|array', // TAMBAHAN: wajib pilih minimal 1 aktor
    ]);


        $film = new Film();
        $film->name = $request->name;
        $film->description = $request->description;
        $film->release_date = $request->release_date;
        $film->duration = $request->duration;
        $film->link_trailer = $request->link_trailer;
        $film->rating = 0;

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
            $film->poster = $path;
        }

        $film->save();
        $film->genres()->attach($request->genre);
        $film->actors()->attach($request->actor); // TAMBAHAN: simpan relasi aktor


        return redirect()->route('admin.films.index')->with('success', 'Film berhasil ditambahkan.');
    }

    public function edit(Film $film)
    {
        $genres = Genre::all();
        $actors = Actor::all();
        $film->load('actors');
        $film->load('genres');
        return view('admin.films.edit', compact('film', 'genres', 'actors'));
    }
   

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'genre' => 'required|array',
            'release_date' => 'required|date',
            'duration' => 'required|integer',
            'link_trailer' => 'required|string',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png',
            'actor' => 'required|array',
        ]);

        $film->name = $request->name;
        $film->description = $request->description;
        $film->release_date = $request->release_date;
        $film->duration = $request->duration;
        $film->link_trailer = $request->link_trailer;

        if ($request->hasFile('poster')) {
            $path = $request->file('poster')->store('posters', 'public');
            $film->poster = $path;
        }

        $film->save();

        // Sync untuk update relasi
        $film->genres()->sync($request->genre);
        $film->actors()->sync($request->actor);

        return redirect()->route('admin.films.index')->with('success', 'Film berhasil diperbarui.');
    }


    public function destroy(Film $film)
    {
        $film->genres()->detach();
        $film->actors()->detach();
        $film->delete();
        return redirect()->route('admin.films.index')->with('success', 'Film berhasil dihapus.');
    }

    public function show(Film $film)
    {
        // Eager load relasi (genres, actors)
        $film->load(['genres', 'actors']);
        $film->link_trailer = preg_replace('/.*(?:youtu\.be\/|v=|\/v\/|embed\/|watch\?v=|&v=)([^&\n?#]+)/', '$1', $film->link_trailer);
        return view('admin.films.show', compact('film')); 
    }
}
