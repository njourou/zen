<?php
include "./includes/header.php";

// Function to fetch list of high rated movies
function getHighRatedMovies($api_key) {
    $url = "https://api.themoviedb.org/3/discover/tv?api_key={$api_key}";
    $json = file_get_contents($url);
    $data = json_decode($json, true);

    if(isset($data['results'])) {
        return $data['results'];
    } else {
        return null;
    }
}

// Function to display list of movies
function displayMovies($movies) {
    if($movies) {
        foreach ($movies as $movie) {
            $title = $movie['title'];
            $poster_path = $movie['poster_path'];
            $poster_url = "https://image.tmdb.org/t/p/w500{$poster_path}";

            echo "<div class='col-lg-3 col-md-6 d-flex align-items-stretch'>";
            echo "<div class='member' data-aos='fade-up' data-aos-delay='100'>";
            echo "<div class='member-img'>";
            echo "<img src='{$poster_url}' class='img-fluid' alt='{$title}'>";
            echo "<div class='social'>";
            echo "<a href='https://vidsrc.to/embed/tv/{$movie['id']}'><i class='bi bi-play'></i></a>";
            echo "<a href=''><i class='bi bi-info'></i></a>";
            echo "<a href=''><i class='bi bi-film'></i></a>";
            echo "</div>";
            echo "</div>";
            echo "<div class='member-info'>";
            echo "<h4>{$title}</h4>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No movies found!</p>";
    }
}

// Example usage
$api_key = '21e8c70b8d8ab44e9ce6e7d707eb4a9f'; // Replace with your actual API key
$movies = getHighRatedMovies($api_key);
?>

<section id="team" class="team section-bg">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <?php
            displayMovies($movies);
            ?>
        </div>
    </div>
</section>

<?php
include "./includes/footer.php";
?>
