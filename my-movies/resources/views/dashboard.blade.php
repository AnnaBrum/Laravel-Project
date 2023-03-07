<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<a href="logout">Log out</a>

@if (isset($user))
<p>Signed in user: {{ $user->name }}</p>
@endif

@if(session("newMovieAdded"))
    <p> {{ session("newMovieAdded") }} </p>
@endif

<br>
<form action="createMovie" method="post" id="movieForm">
    @csrf

    <label for="movieTitle">Title:</label><br>
    <input type="text" name="movie_title" id="movieTitle"><br><br>

    <label for="movieGenre">Genre:</label><br>
    <select id="genre" name="movie_genre" form="movieForm">
        <option value="comedy">Comedy</option>
        <option value="drama">Drama</option>
        <option value="thriller">Thriller</option>
        <option value="action">Action</option>
        <option value="horror">Horror</option>
    </select><br><br>

    <label for="moviePlot">Plot:</label><br>
    <textarea type="text" name="movie_plot" id="moviePlot" rows="20" cols="50"></textarea><br>

    <button type="submit">Submit</button>

    @include("errors")
</form>

@if (isset($movies))
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
@endif
