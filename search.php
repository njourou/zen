<?php include "./includes/header.php"; ?>

<?php
function displayResults($results, $type) {
    if ($results) {
        echo "<h2>$type</h2>";
        echo "<div class='row'>";
        foreach ($results as $item) {
            $title = isset($item['original_name']) ? $item['original_name'] : $item['title']; // Use 'title' for movies
            $poster_path = $item['poster_path'];
            $poster_url = "https://image.tmdb.org/t/p/w500{$poster_path}";
            $year_released = isset($item['release_date']) ? substr($item['release_date'], 0, 4) : "";  // Adjust for movies
            $rating = $item['vote_average'];

            // Link target based on type
            $target_page = $type === "TV Series" ? "video.php?series_id={$item['id']}" : "watch.php?movie_id={$item['id']}";

            echo "<div class='col-lg-3 col-md-6 d-flex align-items-stretch'>";
            echo "<div class='member' data-aos='fade-up' data-aos-delay='100'>";
            echo "<img src='$poster_url' class='img-fluid' alt='$title'>";
            echo "<div class='member-info'>";
            echo "<h4>$title</h4>";
            echo "<span>Released: $year_released</span>";
            echo "<p>Rating: $rating</p>";
            echo "<a href='$target_page' class='btn btn-primary'>Watch Now</a>";
            echo "</div></div></div>";
        }
        echo "</div>";
    } else {
        echo "<p>No $type found!</p>";
    }
}

if (isset($_GET['query'])) {
    $search_query = $_GET['query'];
    $search_query = urlencode($search_query);
    $api_key = '21e8c70b8d8ab44e9ce6e7d707eb4a9f';  // Remember to replace with your actual API key

    // Construct API URLs for both TV series and movies
    $url_tv_series = "https://api.themoviedb.org/3/search/tv?api_key={$api_key}&query={$search_query}";
    $url_movies = "https://api.themoviedb.org/3/search/movie?api_key={$api_key}&query={$search_query}";

    // Perform API requests
    $response_tv_series = file_get_contents($url_tv_series);
    $response_movies = file_get_contents($url_movies);

    if ($response_tv_series === false || $response_movies === false) {
        echo "Error fetching search results.";
    } else {
        // Decode JSON responses
        $data_tv_series = json_decode($response_tv_series, true);
        $data_movies = json_decode($response_movies, true);

        // Extract results
        $tv_series = $data_tv_series['results'];
        $movies = $data_movies['results'];

        // Display both TV series and movies
        echo "<section id='team' class='team section-bg'>";
        echo "<div class='container' data-aos='fade-up'>";

        displayResults($tv_series, "TV Series");
        displayResults($movies, "Movies");

        echo "</div>";
        echo "</section>";
    }
} else {
    echo "No search query provided.";
}
?>
<?php include "./includes/footer.php"; ?>
