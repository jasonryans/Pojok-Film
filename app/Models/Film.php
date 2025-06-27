<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'release_date',
        'link_trailer',
        'duration',
        'poster',
        'rating',
    ];

    public function reviewers()
    {
        return $this->belongsToMany(User::class, 'reviews', 'film_id', 'user_id')
            ->withPivot('rating', 'review')
            ->withTimestamps();
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'films_genres', 'film_id', 'genre_id');
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'actor_film', 'film_id', 'actor_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function posterUrl()
    {
        if (!$this->poster) {
            return null;
        }

        // Return the poster URL if it is an absolute URL
        if (str_starts_with($this->poster, 'http')) {
            return $this->poster;
        }
        // Otherwise, return the URL from storage
        return Storage::url($this->poster);
    }
}
