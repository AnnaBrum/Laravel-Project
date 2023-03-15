<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CreateMovieIdeaTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_movie_idea()
    {
        $user = new User();
        $user->name = "Runar";
        $user->email = "runar@yrgo.se";
        $user->password = Hash::make("1234567");
        $user->save();

        $dbData = [
            "movie_title" => "Toy Story 324",
            "movie_genre" => "action",
            "movie_plot" => "Something something something"
        ];

        $this
            ->actingAs($user)
            ->post(
                "createMovie", $dbData);

        $this->assertDatabaseHas(
            "movies", $dbData);
    }
}