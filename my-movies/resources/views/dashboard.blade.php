<?php
use Illuminate\Support\Facades\DB;
?>

<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<h1>Movie ideas database</h1>

@if (isset($user))
<p>Signed in user: {{ $user->name }}</p>
@endif

<a href="logout">Sign out</a>

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

<!------------- ADD MOVIE IDEA ------------------->

<h2>Add your movie idea below</h2>

<form action="createMovie" method="post" id="movieForm">
    @csrf

    <label for="movieTitle">Title:</label><br>
    <input type="text" name="movie_title" id="movieTitle"><br><br>

    <label for="genreTitle">Genre:</label>
    <br>

@if (isset($genres))
    @foreach($genres as $genre)
        <input type="checkbox" name="<?= $genre->genre_title ?>" value="<?= $genre->genre_title ?>" id="<?= $genre->genre_title ?>">
        <label for="<?= $genre->genre_title ?>"><?= $genre->genre_title ?></label><br>
    @endforeach
    @endif
    <br>

    <label for="moviePlot">Plot:</label><br>
    <textarea type="text" name="movie_plot" id="moviePlot" rows="5" cols="35"></textarea><br>

    <button type="submit">Submit</button>

    @include("errors")
</form>
<hr>


<!------------- CHOOSE GENRE TO DISPLAY MOVIES ------------------->

<h2>Check out our users' movie ideas below, and leave a thumbs up if you find an idea that you really like!</h2>

@if (isset($movies))
<h3>Filter movie ideas by genre</h3>
@foreach ($movies as $movie)
<form action="/genre_title" method="post" id="genre_title">
    @endforeach
    @endif
    @csrf

    @if (isset($genres))
    @foreach($genres as $genre)
    <input type="checkbox" value="<?= $genre->id ?>" name="genre[]">
    <label for="<?= $genre->genre_title ?>">
        <?= $genre->genre_title ?>
    </label><br>
    @endforeach
    @endif
    <br>
    <button type="submit">Show movies</button>
</form>

@if (isset($noMovie))
<p>{{ $noMovie }}</p>
@endif

<!-- To make filter-feedback-sentence readable with commas and "ands" -->
@if (isset($movieGenre) && is_array($movieGenre))
    <p>Showing
    @foreach ($movieGenre as $singleGenre)
<!-- If on the last array-element and length of array is >= 2, add an "and" before last element. If on the next to last element, skip ",". -->
        @if (!next($movieGenre) && count($movieGenre)>=2 )
            <span>and <?= $singleGenre ?> </span>
            <?php continue; ?>
        @endif
        @if ($movieGenre[count($movieGenre)-2] === $singleGenre)
        <?php $nextToLast = count($movieGenre)-2; ?>
        <span><?= $singleGenre ?> </span>
        <?php continue; ?>
        @endif
        <span><?= $singleGenre ?>, </span>
    @endforeach
    movie ideas</p>
@elseif (isset($movieGenre))
    <p> Showing {{ $movieGenre }} movie ideas </p>
@endif

<!------------- DISPLAY MOVIE IDEAS ------------------->
@if (isset($filteredGenres))
    <?php $alreadyPosted = []; ?>
    <div class="movie-container">
        @foreach ($filteredGenres as $genreId)
            @foreach ($movies as $movie)
                @foreach ($movie->movie_genres as $movie_genre)
                    @if ($movie_genre->genre_id == $genreId)
                        @if (in_array($movie->id, $alreadyPosted))
                            <?php continue; ?>
                        @endif
                        <?php array_push($alreadyPosted, $movie->id) ?>
                        <div class="movieBox">
                            <h2>Movie Title: {{ucfirst($movie->movie_title)}}</h2>
                            <p>Genre:
                                @foreach ($movie->movie_genres as $movie_genre)
                                    @if ($movie_genre->genre_id === $movie_genre->genre->id)
                                        {{ucfirst($movie_genre->genre->genre_title . ", ")}}
                                    @endif
                                @endforeach
                            </p>
                            <p>Plot: {{ucfirst($movie->movie_plot)}}</p>
                            <p>User: {{$movie->user->name}}</p>
                            <p>Number of Likes: {{$movie->movie_likes}}</p>

                            <form action="{{ route('like', ['id' => $movie->id]) }}" method="post">
                                @csrf
                                <button type="submit"><img src="{{ asset('images/ThumbsUp.svg') }}" alt="thumbs up"></button>
                            </form>
                        </div>
                    @endif
                @endforeach
            @endforeach
        @endforeach
    </div>
@elseif (!isset($filteredGenres))
<div class="movie-container">
    @if (isset($movies) && isset($genres))
        @foreach ($movies as $movie)
            <div class="movieBox">
                <h2>Movie Title: {{ucfirst($movie->movie_title)}}</h2>
                <p>Genre:
                    @foreach ($movie->movie_genres as $movie_genre)
                        @if ($movie_genre->genre_id === $movie_genre->genre->id)
                            {{ucfirst($movie_genre->genre->genre_title . ", ")}}
                        @endif
                    @endforeach
                </p>
                <p>Plot: {{ucfirst($movie->movie_plot)}}</p>
                <p>User: {{$movie->user->name}}</p>
                <p>Number of Likes: {{$movie->movie_likes}}</p>

                <form action="{{ route('like', ['id' => $movie->id]) }}" method="post">
                    @csrf
                    <button type="submit"><img src="{{ asset('images/ThumbsUp.svg') }}" alt="thumbs up"></button>
                </form>
            </div>
        @endforeach
    @endif
@endif
