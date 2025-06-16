<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tanggal_lahir',
        'foto',
        'deskripsi',
        'jenis_kelamin'
    ];

    // Relasi ke Film
    public function films()
    {
        return $this->belongsToMany(Film::class, 'actors_films', 'actor_id', 'film_id');
    }
}
