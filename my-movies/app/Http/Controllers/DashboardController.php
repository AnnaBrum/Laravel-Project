<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        /* $movies = DB::table("movies")->get(); */

        $movies = Movie::with("user")->get();

        return view("dashboard", ["user" => $user, "movies" => $movies]);

    }

}
