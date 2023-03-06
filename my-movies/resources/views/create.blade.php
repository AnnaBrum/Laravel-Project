<h1> Register new user</h1>
<form method="POST" action="/register">
    @csrf
    <label for="name">Username</label>
    <input type="text" name="name" id="name" required />

    <label for="email">Email</label>
    <input type="email" name="email" id="email" required />

    <label for="password">Password</label>
    <input type="password" name="password" id="password" required />

    <button type="submit">Submit</button>

    @include("errors")
</form>

<a href="/">Back</a>
