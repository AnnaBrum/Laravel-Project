<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use App\Models\Genre;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        "movie_title",
        "movie_genre",
        "movie_plot",
        "user_id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function genres()
    {
        return $this->hasMany(Genre::class);
    }
}
