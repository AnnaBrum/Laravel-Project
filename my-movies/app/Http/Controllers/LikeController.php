<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $id)
    {
        
            $movie = Movie::find($id);
            $movie->movie_likes += 1;
            $movie->save();

            return redirect("dashboard")->with("likeAdded", "Like added!");
        
    }
}
