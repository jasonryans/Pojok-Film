<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Actor extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'tanggal_lahir', 'jenis_kelamin', 'biografi', 'foto'];

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
}
