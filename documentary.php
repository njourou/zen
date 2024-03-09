<?php
include "./includes/header.php";

// Function to fetch list of high rated TV series
function getHighRatedTVSeries($api_key) {
    $adult_animation_genre_id = 16; // Assuming this is the genre ID for adult animation

    $url = "https://api.themoviedb.org/3/discover/tv?api_key={$api_key}&vote_average.gte=7&with_genres=99";
    $json = file_get_contents($url);
    $data = json_decode($json, true);

    if(isset($data['results'])) {
        return $data['results'];
    } else {
        return null;
    }
}

// Function to display list of TV series
function displayTVSeries($tv_series) {
    if($tv_series) {
        foreach ($tv_series as $series) {
            $title = $series['name'];
            $poster_path = $series['poster_path'];
            $poster_url = "https://image.tmdb.org/t/p/w500{$poster_path}";
            $year_released = substr($series['first_air_date'], 0, 4); // Extracting year from first_air_date
            $rating = $series['vote_average']; // Rating of the TV series

            echo "<div class='col-lg-3 col-md-6 d-flex align-items-stretch'>";
            echo "<div class='member' data-aos='fade-up' data-aos-delay='100'>";
            echo "<div class='member-img'>";
            echo "<img src='{$poster_url}' class='img-fluid' alt='{$title}'>";
            echo "<div class='social'>";
            echo "<a href='https://vidsrc.to/embed/tv/{$series['id']}'><i class='bi bi-play'></i></a>";
            echo "</div>";
            echo "</div>";
            echo "<div class='member-info'>";
            
            echo "<p>{$title}-{$year_released}</p>"; // Displaying year released

            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No TV series found!</p>";
    }
}

// Example usage
$api_key = '21e8c70b8d8ab44e9ce6e7d707eb4a9f'; // Replace with your actual API key
$tv_series = getHighRatedTVSeries($api_key);
?>

<section id="team" class="team section-bg">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <?php
            displayTVSeries($tv_series);
            ?>
        </div>
    </div>
</section>

<?php
include "./includes/footer.php";
?>
