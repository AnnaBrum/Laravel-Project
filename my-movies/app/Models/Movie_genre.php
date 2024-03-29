<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie_genre extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'movie_id',
        'genre_id'

    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

}
