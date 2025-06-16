<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    // App\Models\Film.php
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
        return $this->belongsToMany(User::class, 'reviews')
            ->withPivot('rating', 'comment')
            ->withTimestamps();
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function actor()
    {
        return $this->belongsToMany(Actor::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


}