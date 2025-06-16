<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = ['name', 'born_date', 'photo', 'description', 'gender'];
    public function film()
    {
        return $this->belongsToMany(Film::class);
    }
}