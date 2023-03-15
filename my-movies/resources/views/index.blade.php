<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<h1>Movie ideas database</h1>

<form method="post" action="/login">
@csrf

    <div>
        <label for="email">Email</label>
        <input name="email" id="email" type="email" />
    </div>
    <div>
        <label for="password">Password</label>
        <input name="password" id="password" type="password" />
    </div>
    <button type="submit">Login</button>
</form>

@include('errors')

<a href="register">Register new user</a>

@if (session("newUserGreeting"))
    <p> {{ session("newUserGreeting") }} </p>
@endif

@if(session("loggedOut"))
    <p> {{ session("loggedOut") }} </p>
@endif