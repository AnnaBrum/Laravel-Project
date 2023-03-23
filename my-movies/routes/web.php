<?php

use App\Http\Controllers\CreateMovieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\FilterController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name("login")->middleware("guest");

Route::post('/login', LoginController::class);

Route::get("/dashboard", DashboardController::class)->middleware("auth");

Route::post("/createMovie", CreateMovieController::class)->middleware("auth");;

Route::get("/logout", LogoutController::class);

Route::get("register", [RegisterController::class, "create"]);
Route::post("register", [RegisterController::class, "store"]);

Route::post("like/{id}", LikeController::class)->name("like");

Route::post("genre_title", FilterController::class)->name("genre_title");

