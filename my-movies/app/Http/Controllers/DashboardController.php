<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use App\Models\Movie_genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        $genres = Genre::all();

        $movie_genres = Movie_genre::all();

        foreach ($genres as $genre) {
            $genre_id = $genre->id;
        }

        $movies = Movie::with("user", "movie_genres")->get();

        foreach ($movies as $movie) {
            $movie_id = $movie->id;
        }


        return view("dashboard", ["user" => $user, "movies" => $movies, "genres" => $genres, "movie_genres" => $movie_genres]);

    }

}

