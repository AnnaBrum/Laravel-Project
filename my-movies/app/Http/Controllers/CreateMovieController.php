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
        $genres = DB::table("genres")->get();
        $movie = Movie::with("user")->first();



        foreach ($genres as $genre) {

            $genre_title = $request->input("genre_title");

            if (isset($movie[$genre_title])) {
                $genre_id = $genre->id;
                $movie_id = $movie->id;
                Movie_genre::create([
                    "movie_id" => $movie_id,
                    "genre_id" => $genre_id]);
            }

        }
        dd($genre_id);

        $movie_attributes = request()->validate([
            "movie_title" => ["required", "max:255", "min:2"],
            "movie_plot" => ["required", "max:255", "min:10"]
        ]);


        // $movie_genre_attributes = request()->validate([
        //     "movie_id" => $movie->id,
        //     "genre_id" => $genre->id
        // ]);


        $user_id = Auth::user()->id;
        $movie_attributes["user_id"] = $user_id;

        Movie::create($movie_attributes);
        // Movie_genre::create($movie_genre_attributes);

        return redirect("dashboard")->with("newMovieAdded", "Your fantastic movie idea has been added to the database!");

    }
}
