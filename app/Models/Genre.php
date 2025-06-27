<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = ['name'];
    // app/Models/Genre.php
    public function films() 
    {
        return $this->belongsToMany(Film::class, 'films_genres', 'genre_id', 'film_id');
    }


}
