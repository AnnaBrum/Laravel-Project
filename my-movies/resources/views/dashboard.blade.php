<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<a href="logout">Sign out</a>

@if (isset($user))
<p>Signed in user: {{ $user->name }}</p>
@endif

@if(session("newMovieAdded"))
    <p> {{ session("newMovieAdded") }} </p>
@endif

@if(session("likeAdded"))
    <p> {{ session("likeAdded") }} </p>
@endif

@if(session("test"))
    <p> {{ session("test") }} </p>
@endif

<hr>

<h2>Add your movie idea below</h2>

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
    <textarea type="text" name="movie_plot" id="moviePlot" rows="5" cols="35"></textarea><br>

    <button type="submit">Submit</button>

    @include("errors")
</form>

<hr>

<h2>Check out our users' movie ideas below, and leave a thumbs up if you find an idea that you really like!</h2>

@if (isset($movies))
@foreach ($movies as $movie)
<form action="/movie_genre" method="post" id="movie_genre">
@endforeach
@endif
@csrf
<label for="movie_genre">Sort movie ideas by genre:</label><br>
    <select id="movie_genre" name="movie_genre" form="movie_genre">
        <option value="all">All</option>
        <option value="comedy">Comedy</option>
        <option value="drama">Drama</option>
        <option value="thriller">Thriller</option>
        <option value="action">Action</option>
        <option value="horror">Horror</option>
    </select>
    <br>
    <button type="submit">Show movies</button>
</form>

@if (isset($noMovie))
    <p>{{ $noMovie }}</p>
@endif

@if (isset($movieGenre))
    <p> Showing {{ $movieGenre }} movie ideas </p>
@endif

<div class="movie-container">
    @if (isset($movies))
        @foreach ($movies as $movie)
            <div class="movieBox">
                <h2>Movie Title: {{ucfirst($movie->movie_title)}}</h2>
                <p>Genre: {{ucfirst($movie->movie_genre)}}</p>
                <p>Plot: {{$movie->movie_plot}}</p>
                <p>User: {{$movie->user->name}}</p>
                <p>Number of Likes: {{$movie->movie_likes}}</p>

                <form action="{{ route('like', ['id' => $movie->id]) }}" method="post">
                    @csrf
                    <button type="submit"><img src="{{ asset('images/ThumbsUp.svg') }}" alt="thumbs up"></button>
                </form>
            </div>
        @endforeach
    @endif
</div>


