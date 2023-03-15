<?php

namespace Tests\Feature;

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{

    use RefreshDatabase;

    public function test_register_view(): void
    {
        $response = $this->get("register");
        $response->assertStatus(200);
    }

    public function test_create_new_user(): void
    {

        $response = $this
            ->followingRedirects()
            ->post("register", [
            "name" => "Runar",
            "email" => "runar@yrgo.se",
            "password" => Hash::make("1234567")
        ]);


       
        $response->assertSeeText("New user added!");
        $response->assertStatus(200);

    }
}
