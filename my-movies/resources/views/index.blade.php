<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<h1>Movie idea database</h1>

<div class="login-wrapper">
<form class="login" method="post" action="/login">
@csrf

    <div class="email input">
        <label for="email">Email</label>
        <input name="email" id="email" type="email" />
    </div>
    <div class="password input">
        <label for="password">Password</label>
        <input name="password" id="password" type="password" />
    </div>
    <button type="submit">Login</button>
</form>
@include('errors')
</div>

<a href="register">Register new user</a>

@if (session("newUserGreeting"))
    <p> {{ session("newUserGreeting") }} </p>
@endif

@if(session("loggedOut"))
    <p> {{ session("loggedOut") }} </p>
@endif
