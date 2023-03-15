<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_view_login_form()
    {
        $response = $this->get("/");
        $response->assertSeeText("Email");
        $response->assertStatus(200);
    }

    public function test_login_user()
    {
        $user = new User();
        $user->name = "Runar";
        $user->email = "runar@yrgo.se";
        $user->password = Hash::make("1234567");
        $user->save();

        $response = $this
            ->followingRedirects()
            ->post("login", [
                "email" => "runar@yrgo.se",
                "password" => "1234567",
            ]);
        
        $response = $this->get("/dashboard");
        $response->assertSeeText("Signed in user: Runar");
    }

    public function test_login_user_without_password()
    {
        $response = $this
            ->followingRedirects()
            ->post("login", [
                "email" => "runar@yrgo.se",
            ]);

        $response->assertSeeText("The password field is required.");
    }
}
