<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie_genre;
use Illuminate\Support\Facades\DB;

class CreateMovieController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $genres = DB::table('genres')->get();

        foreach ($genres as $genre) {
            $movie_genre = $genre->genre_title;


            if (isset($movie[$movie_genre])) {
                $movie_id = $movie->id;
                Movie_genre::create(['movie_id' => $movie_id, 'genre_id' => $genre->id]);
            }
        }

        $attributes = request()->validate([
            "movie_title" => ["required", "max:255", "min:2"],
            // "movie_genre" => ["required"],
            "movie_plot" => ["required", "max:255", "min:10"]
        ]);


        $user_id = Auth::user()->id;

        $attributes["user_id"] = $user_id;

        Movie::create($attributes);

        return redirect("dashboard")->with("newMovieAdded", "Your fantastic movie idea has been added to the database!");

    }
}
