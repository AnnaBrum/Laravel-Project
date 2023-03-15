<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<h1> Register new user</h1>
<form method="POST" action="/register">
    @csrf
    <label for="name">Username</label>
    <input type="text" name="name" id="name" required />

    <br>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required />

    <br>

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required />

    <br>
    
    <button type="submit">Submit</button>

    @include("errors")
</form>

@if (isset($errorInfo))
    <p>Whoops, something went wrong. Maybe the user name is already taken?</p>
@endif

<a href="/">Back</a>
