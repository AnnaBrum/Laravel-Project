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

        $user_id = Auth::user()->id;
        $genres = DB::table("genres")->get();

        $this->validate($request, [
            "movie_title" => ["required", "max:255", "min:2"],
            "movie_plot" => ["required", "max:255", "min:10"]
        ]);

        $movie_attributes = [ "movie_title", "movie_plot"];
        foreach ($genres as $genre) {
            $movie_attributes[] = $genre->genre_title;
        }


        $movie = $request->only($movie_attributes);

        $movie["user_id"] = $user_id;

        Movie::create($movie);

        $movie_id = DB::table("movies")->latest()->value('id');

        foreach ($genres as $genre) {

            $genre_title = $genre->genre_title;

            if (isset($movie[$genre_title])) {

                Movie_genre::create([
                    "movie_id" => $movie_id,
                    "genre_id" => $genre->id]);
            }

        }

        return redirect("dashboard")->with("newMovieAdded", "Your fantastic movie idea has been added to the database!");

    }
}
