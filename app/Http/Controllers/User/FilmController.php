<?php

namespace App\Http\Controllers\User;

use App\Models\Film;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function show($id)
    {
        $film = Film::where('id', $id)->firstOrFail();
        $film->release_date = Carbon::parse($film->release_date)->format('Y');

        return view('user.films.show', [
            "film" => $film
        ]);
    }
}
