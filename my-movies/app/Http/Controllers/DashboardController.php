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
        $movies = Movie::with("user")->get();
        $movie_genres = Movie_genre::with("genre")->get();
        $movieGenre = "all";

        $selectedGenre = $request->get("genre_title");
        if ($selectedGenre) {
            $movies = $genres->where("genre_title", $selectedGenre)->first()->movies;
        }; 

        return view("dashboard", ["user" => $user, "movies" => $movies, "genres" => $genres, "movie_genres" => $movie_genres, "movieGenre" => $movieGenre]);

    }

}

