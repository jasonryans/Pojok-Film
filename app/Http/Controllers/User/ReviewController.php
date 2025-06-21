<?php

namespace App\Http\Controllers\User;

use App\Models\Film;
use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'film_id' => 'required|exists:films,id',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:10',
        ], [
            'review.required' => 'Review tidak boleh kosong.',
            'rating.required' => 'Rating wajib diisi.',
            'rating.integer' => 'Rating harus berupa angka.',
            'rating.min' => 'Rating minimal adalah 1.',
            'rating.max' => 'Rating maksimal adalah 10.',
        ]);

        if ($validated) {
            Review::create([
                'review' => $request->review,
                'rating' => $request->rating,
                'user_id' => Auth::id(),
                'film_id' => $request->film_id,
            ]);

            // Update film rating average
            $film = Film::findOrFail($request->film_id);
            $average = Review::where('film_id', $request->film_id)->avg('rating');
            $film->rating = round($average, 2);
            $film->save();

            return (
                redirect()
                ->route('films.show', $request->film_id)
                ->with('success', 'Review berhasil dibuat!')
            );
        } else {
            return back()->withInput();
        }
    }
}
