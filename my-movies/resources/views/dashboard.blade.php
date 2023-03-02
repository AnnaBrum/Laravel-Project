<a href="logout">Log out</a>

<form action="createMovie" method="post" id="movieForm">
    @csrf

    <label for="movieTitle">Title:</label>
    <input type="text" name="movieTitle" id="movieTitle">

    <label for="movieTitle">Genre:</label>
    <select id="genre" name="genreList" form="movieForm">
        <option value="comedy">Comedy</option>
        <option value="drama">Drama</option>
        <option value="thriller">Thriller</option>
        <option value="action">Action</option>
        <option value="horror">Horror</option>
    </select>

    <label for="moviePlot">Plot:</label>
    <textarea type="text" name="moviePlot" id="moviePlot" rows="20" cols="50"></textarea>

    <button type="submit">Submit</button>
</form>
