<?php
include "./includes/header.php";

// Function to fetch list of high rated movies
function getHighRatedMovies($api_key) {
    $url = "https://api.themoviedb.org/3/discover/movie?api_key={$api_key}&vote_average.gte=6";
    $json = file_get_contents($url);
    $data = json_decode($json, true);

    $movies = [];

    if(isset($data['results'])) {
        foreach ($data['results'] as $result) {
            $movies[$result['id']] = $result['title'];
        }
    }

    return $movies;
}

// Function to fetch movie details by ID
function getMovieDetails($api_key, $movie_id) {
    $url = "https://api.themoviedb.org/3/movie/{$movie_id}?api_key={$api_key}";
    $json = file_get_contents($url);
    return json_decode($json, true);
}

$api_key = '21e8c70b8d8ab44e9ce6e7d707eb4a9f'; // Replace with your actual API key
$selected_movie = isset($_GET['movie_id']) ? $_GET['movie_id'] : '';

$movie_list = getHighRatedMovies($api_key);
$movie_details = [];

if (!empty($selected_movie)) {
    $movie_details = getMovieDetails($api_key, $selected_movie);
}
?>


<main id="main">

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">
        <ol>
            <li><a href="index.php">Home</a></li>
            <li>Movies</li>
        </ol>
        <?php
        if (!empty($movie_details)) {
            echo "<h2>{$movie_details['title']}</h2>";
        }
        ?>
    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Portfolio Details Section ======= -->
<section id="portfolio-details" class="portfolio-details ">
    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-8">
                <div class="portfolio-details-slider swiper">
                    <div class="swiper-wrapper align-items-center">

                        <!-- Video Here -->
                        <div class="video-container">
                            <?php
                            if (!empty($selected_movie)) {
                                $video_url = "https://vidsrc.to/embed/movie/{$selected_movie}";
                                echo "<iframe src='{$video_url}' frameborder='0' scrolling='no' width='700' height='400' id='video-player'></iframe>";
                            } else {
                                echo "<p>No video ID provided.</p>";
                            }
                            ?>
                        </div>

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-info">
                    <h3>Movie Details</h3>
                    <?php
                    if (!empty($movie_details)) {
                        $rating = $item['vote_average'];
                        //Poster 
                        echo "<p>{$movie_details['overview']}</p>";
                        echo "<p>Release Date: {$movie_details['release_date']}</p>";
                        echo "<p>Rating: {$movie_details['vote_average']}</p>";
                        echo "<img src='{$poster_url}' class='img-fluid' alt='{$title}'>";
                    }
                    ?>
                </div>
            </div>

        </div>

    </div>
</section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

<?php
include "./includes/footer.php";
?>
