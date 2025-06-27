<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'born_date',
        'photo',
        'description',
        'gender'
    ];

    // Relasi ke Film
    public function films()
    {
        return $this->belongsToMany(Film::class, 'actor_film', 'actor_id', 'film_id');
    }

    public function photoUrl()
    {
        if (!$this->photo) {
            return null;
        }

        // Return the photo URL if it is an absolute URL
        if (str_starts_with($this->photo, 'http')) {
            return $this->photo;
        }
        // Otherwise, return the URL from storage
        return Storage::url($this->photo);
    }
}
