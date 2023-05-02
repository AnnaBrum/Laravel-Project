<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Movie_genre;
use Hamcrest\Core\IsSame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Genre;

class FilterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        $filteredGenres = $request->input("genre");

        $moviesExist = Movie_genre::where("genre_id", "=", $filteredGenres)->exists();

        $noMovie = false;

        $request->validate([
            'genre' => ['required'],
        ]);

        $genresArr = [];
        foreach ($filteredGenres as $filteredGenre) :
            $genresByName = Genre::where("id", "=", $filteredGenre)->get();
            foreach ($genresByName as $genreByName) :
                array_push($genresArr, $genreByName->genre_title);
            endforeach;
        endforeach;

        $movieGenre = $genresArr;

        if (!$moviesExist) :
            $noMovie = "Sorry, no movie in this genre was found, maybe add one yourself?";
            $movieGenre = "all";
            $filteredGenres = null;
        endif;

        $movies = Movie::with("user")->get();
        $genres = Genre::all();

        return view("/dashboard", ["genres" => $genres, "user" => $user, "movies" => $movies, "noMovie" => $noMovie, "movieGenre" => $movieGenre, "filteredGenres" => $filteredGenres]);
    }
}
