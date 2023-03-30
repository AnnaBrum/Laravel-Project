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


        $movie_attributes = request()->validate([
            "movie_title" => ["required", "max:255", "min:2"],
            "movie_plot" => ["required", "max:255", "min:10"]
        ]);
        Movie::create($movie_attributes);

        $genres = DB::table("genres")->get();
        $movie_id = DB::table("movies")->latest()->value('id');


        foreach ($genres as $genre) {

            $genre_title = $request->input("genre_title");

            if (isset($movie_id[$genre_title])) {
                $genre_id = $genre->id;
                Movie_genre::create([
                    "movie_id" => $movie_id,
                    "genre_id" => $genre_id]);
            }

        }

        // $movie_genre_attributes = request()->validate([
        //     "movie_id" => $movie->id,
        //     "genre_id" => $genre->id
        // ]);


        $user_id = Auth::user()->id;
        $movie_attributes["user_id"] = $user_id;


        // Movie_genre::create($movie_genre_attributes);

        return redirect("dashboard")->with("newMovieAdded", "Your fantastic movie idea has been added to the database!");

    }
}
