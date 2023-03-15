<?php

namespace Tests\Feature;

use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LogoutTest extends TestCase
{

    use RefreshDatabase;

    public function test_logout(): void
    {
        $user = new User();
        $user->name = "Runar";
        $user->email = "runar@yrgo.se";
        $user->password = Hash::make("1234567");
        $user->save();

        $response = $this
            ->be($user)
            ->followingRedirects()
            ->get("/logout");

        $response->assertSeeText("Email");
        $response->assertStatus(200);
    }
}



