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
        // Validate input
        $validated = $request->validate([
            'film_id' => 'required|exists:films,id',
            'review' => 'required|string|max:1000',
            'rating' => 'required|numeric|min:1|max:10',
        ], [
            'review.required' => 'Review tidak boleh kosong.',
            'review.max' => 'Review maksimal 1000 karakter.',
            'rating.required' => 'Rating wajib diisi.',
            'rating.numeric' => 'Rating harus berupa angka.',
            'rating.min' => 'Rating minimal adalah 1.',
            'rating.max' => 'Rating maksimal adalah 10.',
        ]);

        // Check if user already reviewed this film
        $existingReview = Review::where('user_id', Auth::id())
                               ->where('film_id', $request->film_id)
                               ->first();

        if ($existingReview) {
            return redirect()
                ->route('films.show', $request->film_id)
                ->with('error', 'Anda sudah memberikan review untuk film ini!');
        }

        try {
            // Create new review
            Review::create([
                'review' => $request->review,
                'rating' => $request->rating,
                'user_id' => Auth::id(),
                'film_id' => $request->film_id,
            ]);

            // Update film rating average
            $this->updateFilmRating($request->film_id);

            return redirect()
                ->route('films.show', $request->film_id)
                ->with('success', 'Review berhasil dibuat!');

        } catch (\Exception $e) {
            return redirect()
                ->route('films.show', $request->film_id)
                ->with('error', 'Terjadi kesalahan saat menyimpan review. Silakan coba lagi.');
        }
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $validated = $request->validate([
            'film_id' => 'required|exists:films,id',
            'review' => 'required|string|max:1000',
            'rating' => 'required|numeric|min:1|max:10',
        ], [
            'review.required' => 'Review tidak boleh kosong.',
            'review.max' => 'Review maksimal 1000 karakter.',
            'rating.required' => 'Rating wajib diisi.',
            'rating.numeric' => 'Rating harus berupa angka.',
            'rating.min' => 'Rating minimal adalah 1.',
            'rating.max' => 'Rating maksimal adalah 10.',
        ]);

        try {
            // Find review and check if it belongs to current user
            $review = Review::where('id', $id)
                           ->where('user_id', Auth::id())
                           ->first();

            if (!$review) {
                return redirect()
                    ->route('films.show', $request->film_id)
                    ->with('error', 'Review tidak ditemukan atau Anda tidak memiliki akses untuk mengedit review ini.');
            }

            // Update review
            $review->update([
                'review' => $request->review,
                'rating' => $request->rating,
            ]);

            // Update film rating average
            $this->updateFilmRating($request->film_id);

            return redirect()
                ->route('films.show', $request->film_id)
                ->with('success', 'Review berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()
                ->route('films.show', $request->film_id)
                ->with('error', 'Terjadi kesalahan saat memperbarui review. Silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        try {
            // Find review and check if it belongs to current user
            $review = Review::where('id', $id)
                           ->where('user_id', Auth::id())
                           ->first();

            if (!$review) {
                return back()->with('error', 'Review tidak ditemukan atau Anda tidak memiliki akses untuk menghapus review ini.');
            }

            $filmId = $review->film_id;
            
            // Delete review
            $review->delete();

            // Update film rating average
            $this->updateFilmRating($filmId);

            return redirect()
                ->route('films.show', $filmId)
                ->with('success', 'Review berhasil dihapus!');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus review. Silakan coba lagi.');
        }
    }

    /**
     * Update film rating average
     */
    private function updateFilmRating($filmId)
    {
        $film = Film::findOrFail($filmId);
        $average = Review::where('film_id', $filmId)->avg('rating');
        
        // If no reviews left, set rating to null or 0
        $film->rating = $average ? round($average, 2) : 0;
        $film->save();
    }
}