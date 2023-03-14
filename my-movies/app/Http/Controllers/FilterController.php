<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {

        $movies = DB::table("movies")->where("movie_genre", "=", $request->movie_genre)->get();



        return view("/dashboard", ["movies" => $movies]);
    }
}
