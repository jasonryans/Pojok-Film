<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $id){
        
        $validated = $request->validate([
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:10,',
        ], [
            'review.required' => 'Review tidak boleh kosong.',
            'rating.required' => 'Rating wajib diisi.',
            'rating.integer' => 'Rating harus berupa angka.',
            'rating.min' => 'Rating minimal adalah 1.',
            'rating.max' => 'Rating maksimal adalah 10.',
        ]);

        if ($validated){
            $review = $request->review;
            $rating = $request->rating;
            $user_id = Auth::id();
            $film_id = $id;

            Review::create([
                "review" => $review,
                "rating" => $rating,
                "user_id" => $user_id,
                "film_id" => $film_id
            ]);

            return redirect()->route('detailfilm', $id)->with('success', 'Review berhasil dibuat!');
        } else {
            return back()->withInput();
        }

    }
}
