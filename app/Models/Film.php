<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
