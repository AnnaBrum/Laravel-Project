<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        "movie_title",
        "movie_plot",
        "user_id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

/*     public function movie_genres(): HasMany
    {
        return $this->hasMany(Movie_genre::class);
    } */

    public function genres()
    {
        return $this->belongsToMany(Genre::class, "movie_genres");
    }

    public function movie_genres()
    {
        return $this->hasMany(Movie_genre::class);
    }
}
