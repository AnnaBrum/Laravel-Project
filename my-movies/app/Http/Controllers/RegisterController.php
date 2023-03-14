<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function create()
    {
        return view("create");
    }

    public function store()
    {
        // if the validation fails, the user automatically gets redirected back to the form
        $attributes = request()->validate([
            "name" => ["required", "max:255", "min:2"],
            "email" => ["required", "email", "max:150"],
            "password" => ["required", "min:7", "max:255"]
        ]);

        $attributes["password"] = bcrypt($attributes["password"]);

        try {
            User::create($attributes);
        } catch (\Illuminate\Database\QueryException $exception) {
            $errorInfo = $exception->errorInfo;
            
            return view("create", ["errorInfo" => $errorInfo]);
           
        };

        return redirect("/")->with("newUserGreeting", "New user added!");
    }
}



            // $this->validate($request, [
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:8|confirmed',
        // ]);

        // $user = $request->all(['name', 'email', 'password']);

        // if ($validator->fails()) {
        // return back()->withErrors([
        //     'name' => 'Please enter a valid username',
        //     'email' => 'Please enter a valid email',
        //     'password' => 'Please enter a valid password',
        // ])->onlyInput('name', 'email', 'password');



        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // return redirect("/login");
