<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateMovieController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $attributes = request()->validate([
            "movie_title" => ["required", "max:255", "min:2"],
            "movie_genre" => ["required"],
            "movie_plot" => ["required", "max:255", "min:10"]
        ]);

        $user_id = Auth::user()->id;

        $attributes["user_id"] = $user_id;

        Movie::create($attributes);
        
        return view("dashboard");

    }
}
