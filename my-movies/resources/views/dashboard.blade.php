<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@if (isset($user))
<p>Signed in user: {{ $user->name }}</p>
@endif

<a href="logout">Log out</a>

<form action="createMovie" method="post" id="movieForm">
    @csrf

    <label for="movieTitle">Title:</label>
    <input type="text" name="movie_title" id="movieTitle">

    <label for="movieGenre">Genre:</label>
    <select id="genre" name="movie_genre" form="movieForm">
        <option value="comedy">Comedy</option>
        <option value="drama">Drama</option>
        <option value="thriller">Thriller</option>
        <option value="action">Action</option>
        <option value="horror">Horror</option>
    </select>

    <label for="moviePlot">Plot:</label>
    <textarea type="text" name="movie_plot" id="moviePlot" rows="20" cols="50"></textarea>

    <button type="submit">Submit</button>

    @include("errors")
</form>




@foreach ($movies as $movie)
<div class="movieBox">
    <h2>Movie Title: {{ucfirst($movie->movie_title)}}</h2>
    <p>Genre: {{ucfirst($movie->movie_genre)}}</p>
    <p>Plot: {{$movie->movie_plot}}</p>
    <p>User Id: {{$movie->user_id}}</p>
    <p>Number of Likes: {{$movie->movie_likes}}</p>
    <form action="like" method="post">
    <button type="submit"><img src="{{ asset('images/ThumbsUp.svg') }}" alt="thumbs up"></button>
    </form>
</div>

@endforeach
