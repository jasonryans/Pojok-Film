<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller
{
    public function show($id){
        $film = Film::where('id', $id)->firstOrFail();
    
        $film->release_date = Carbon::parse($film->release_date)->format('Y');
    
        return view('user.detailfilm', [
            "film" => $film
        ]);
    }
}
