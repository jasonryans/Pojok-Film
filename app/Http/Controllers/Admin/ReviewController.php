<?php

namespace App\Http\Controllers\Admin;

use App\Models\Film;
use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // ✅ Admin: View all reviews
    public function index()
    {
        $reviews = Review::with('film', 'user')->latest()->get();
        return view('admin.reviews.index', compact('reviews'));
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
        $film->rating = $average ? round($average, 2) : 0;
        $film->save();

        return redirect()->back()->with('success', 'Komentar berhasil dihapus.');
    }
}
