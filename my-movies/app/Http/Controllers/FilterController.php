<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Movie_genre;
use Hamcrest\Core\IsSame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();


        $movies = Movie_genre::with("user")->where("genre_id", "=", $request->genre_id)->get();

        $noMovie = false;

        $movieGenre = $request->genre_id;


        if ($movies->isEmpty()) :
            if ($request->movie_id != $movies = Movie::with("user")->get()) :
                $noMovie = "Sorry, no movie in this genre was found, maybe add one yourself?";
                $movieGenre = "all";
            endif;

        endif;

        return view("/dashboard", ["user" => $user, "movies" => $movies, "noMovie" => $noMovie, "movieGenre" => $movieGenre]);
    }
}
