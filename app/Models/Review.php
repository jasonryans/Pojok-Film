<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
