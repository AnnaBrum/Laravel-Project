<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre_title'
    ];

    public function movies()
    {
        return $this->belongsToMany(Movie::class, "movie_genres");
    }

    public function movie_genres()
    {
        return $this->hasMany(Movie_genre::class);
    }
}
