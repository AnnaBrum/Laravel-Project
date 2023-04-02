<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Genre;
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

    public function genres(): HasMany
    {
        return $this->hasMany(Genre::class);
    }
}
