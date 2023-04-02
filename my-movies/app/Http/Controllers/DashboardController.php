<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
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

        foreach ($genres as $genre) {
            $genre_id = $genre->id;
        }

        $movies = Movie::with("user")->get();

        foreach ($movies as $movie) {
            $movie_id = $movie->id;
        }


        return view("dashboard", ["user" => $user, "movies" => $movies, "genres" => $genres]);

    }

}

