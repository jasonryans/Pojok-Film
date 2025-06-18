<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $validated = $request->validate([
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
                'film_id' => $id,
            ]);

            // Update film rating average
            $film = Film::findOrFail($id);
            $average = Review::where('film_id', $id)->avg('rating');
            $film->rating = round($average, 2);
            $film->save();

            return redirect()->route('detailfilmUser', $id)->with('success', 'Review berhasil dibuat!');
        } else {
            return back()->withInput();
        }
    }

    // ✅ Admin: View all reviews
    public function index()
    {
        $reviews = Review::with('film', 'user')->latest()->get();
        return view('reviews.index', compact('reviews'));
    }

    // ✅ Admin: Delete review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $film_id = $review->film_id;
        $review->delete();

        $film = Film::findOrFail($film_id);
        $average = Review::where('film_id', $film_id)->avg('rating');

        // Cek apakah masih ada review yang tersisa
        $film->rating = $average !== null ? round($average, 2) : null;
        $film->save();

        return redirect()->route('reviews.index')->with('success', 'Komentar berhasil dihapus.');
    }

}
