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
