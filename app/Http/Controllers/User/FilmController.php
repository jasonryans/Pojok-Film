<?php

namespace App\Http\Controllers\User;

use App\Models\Film;
use App\Models\Genre;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{
    public function show($id)
    {
        $film = Film::where('id', $id)->firstOrFail();
        $film->release_date = Carbon::parse($film->release_date)->format('Y');

        // Gunakan Auth::check() dan Auth::id()
        $userReview = null;
        if (Auth::check()) {
            $userReview = $film->reviews()
                ->where('user_id', Auth::id())
                ->first();
        }

        return view('user.films.show', [
            'film' => $film,
            'userReview' => $userReview,
        ]);
    }
    
    public function index(Request $request)
    {
        $query = Film::with('genres');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%"); 
        }
        
        if ($request->has('genre') && $request->genre != '') {
            $query->whereHas('genres', function($q) use ($request) {
                $q->where('name', $request->genre); 
            });
        }

        if ($request->has('year') && $request->year != '') {
            $query->whereYear('release_date', $request->year);
        }

        $sortBy = $request->get('sort', 'release_date');
        $sortOrder = $request->get('order', 'desc');

        switch ($sortBy) {
            case 'title':
                $query->orderBy('name', $sortOrder); 
                break;
            case 'year':
                $query->orderBy('release_date', $sortOrder);
                break;
            case 'genre':
                break;
            default:
                $query->orderBy('release_date', 'desc');
                break;
        }

        $films = $query->get();

        if ($sortBy === 'genre') {
            $films = $films->sortBy(function($film) {
                return $film->genres->first()->name ?? 'ZZZ'; 
            });
            
            if ($sortOrder === 'desc') {
                $films = $films->reverse();
            }
        }

        $availableYears = Film::selectRaw('YEAR(release_date) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year')
            ->filter();

        $availableGenres = Genre::orderBy('name')->pluck('name');

        $films->transform(function ($film) {
            $film->genre_names = $film->genres->pluck('name')->join(', ');
            $film->primary_genre = $film->genres->first()->name ?? 'Unknown';
            return $film;
        });

        return view('user.films.index', [
            'film' => $films,
            'availableYears' => $availableYears,
            'availableGenres' => $availableGenres,
        ]);
    }
}
