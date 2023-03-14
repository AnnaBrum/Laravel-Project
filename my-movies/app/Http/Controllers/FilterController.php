<?php

namespace App\Http\Controllers;

use App\Models\Movie;
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
        
        $movies = DB::table("movies")->where("movie_genre", "=", $request->movie_genre)->get();
 
        if ($movies->isEmpty()):
            $movies = DB::table("movies")->get();
        endif;

        return view("/dashboard", ["user" => $user, "movies" => $movies]);
    }
}
