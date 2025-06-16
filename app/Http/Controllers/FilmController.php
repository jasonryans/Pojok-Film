<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Genre; 
class FilmController extends Controller
{
    public function index()
    {
        $films = Film::all();
        return view('films.index', compact('films'));
    }

    public function show($id){
        $film = Film::where('id', $id)->firstOrFail();
    
        $film->updated_at = Carbon::parse($film->release_date)->format('Y');
    
        return view('user.detailfilm', [
            "film" => $film
        ]);
    }

    public function create()
    {
        $genres = Genre::all(); // Ambil semua genre dari database
        return view('films.create', compact('genres')); // Kirim ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'genre' => 'required',
            'release_date' => 'required|date',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png',
            'link_trailer' => 'required',
            'duration' => 'required|integer',
        ]);

        $film = new Film($request->except('poster'));
        $film->rating = 0;

        // Simpan poster jika ada
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $film->poster = $posterPath;
        }

        $film->save();

        // Attach genre (isi tabel pivot film_genre)
        $film->genres()->attach($request->genre);

        return redirect()->route('films.index')->with('success', 'Film berhasil ditambahkan.');
    }

    public function edit(Film $film)
    {
        return view('films.edit', compact('film'));
    }

    public function update(Request $request, Film $film)
    {
        $request->validate([
            'judul' => 'required',
            'sinopsis' => 'required',
            'genre' => 'required',
            'tahun' => 'required|integer',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $film->fill($request->except('poster'));

        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('posters', 'public');
            $film->poster = $posterPath;
        }

        $film->save();

        return redirect()->route('films.index')->with('success', 'Film berhasil diperbarui.');
    }

    public function destroy(Film $film)
    {
        $film->delete();
        return redirect()->route('films.index')->with('success', 'Film berhasil dihapus.');
    }
}
