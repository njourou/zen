<?php
include "./includes/header.php";

// Function to fetch list of high rated TV series
function getHighRatedTVSeries($api_key) {
    $url = "https://api.themoviedb.org/3/discover/tv?api_key={$api_key}&vote_average.gte=6";
    $json = file_get_contents($url);
    $data = json_decode($json, true);

    $series = [];

    if(isset($data['results'])) {
        foreach ($data['results'] as $result) {
            $series[$result['id']] = $result['name'];
        }
    }

    return $series;
}

// Function to fetch series details by ID
function getSeriesDetails($api_key, $series_id) {
    $url = "https://api.themoviedb.org/3/tv/{$series_id}?api_key={$api_key}";
    $json = file_get_contents($url);
    return json_decode($json, true);
}

function getEpisodes($api_key, $series_id, $season_number) {
    $url = "https://api.themoviedb.org/3/tv/{$series_id}/season/{$season_number}?api_key={$api_key}";
    $json = file_get_contents($url);
    return json_decode($json, true);
}


$api_key = 'Key Here'; // Replace with your actual API key
$selected_series = isset($_GET['series_id']) ? $_GET['series_id'] : '';
$selected_season = isset($_GET['season']) ? $_GET['season'] : ($selected_series ? 1 : '');

$series_list = getHighRatedTVSeries($api_key);
$series_details = [];
$episodes = [];

if (!empty($selected_series) && $selected_season !== '') {
    $series_details = getSeriesDetails($api_key, $selected_series);
    $episodes = getEpisodes($api_key, $selected_series, $selected_season);
}
?>



<main id="main">

<!-- ======= Breadcrumbs ======= -->
<section class="breadcrumbs">
    <div class="container">
        <ol>
            <li><a href="index.php">Home</a></li>
            <li>TV Series</li>
        </ol>
        <?php
        if (!empty($series_details)) {
            // echo "<p>{$series_details['overview']}</p>";
            echo "<h2>{$series_details['name']}</h2>";
       
        }
        ?>
        <!-- Add this button wherever you want it to appear on your page -->
            <button id="now-playing-btn" style="display: none;">Now Playing: <span id="now-playing-episode"></span></button> 

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
                            if (!empty($selected_series)) {
                                $video_url = "https://vidsrc.to/embed/tv/{$selected_series}/{$selected_season}";
                                echo "<iframe src='{$video_url}' frameborder='0' scrolling='no' width='700' height='400' id='video-player'></iframe>";
                                echo "<p>{$series_details['overview']}</p>";
                                echo "<p>{$series_details['credits']['cast']}</p>";
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
                    <h3>List of Episodes</h3>
                    <!-- <button id="now-playing-btn" style="display: none;">Now Playing: <span id="now-playing-episode"></span></button> -->
                    <form id="season-form" method="GET">
                        <label for="season">Select Season:</label>
                        <select name="season" id="season">
                            <?php
                            if (!empty($series_details) && isset($series_details['number_of_seasons'])) {
                                $num_seasons = $series_details['number_of_seasons'];
                                for ($i = 1; $i <= $num_seasons; $i++) {
                                    $selected = ($i == $selected_season) ? 'selected' : '';
                               
                                    echo "<option value='{$i}' {$selected}>Season {$i}</option>";
                                }
                            } else {
                                echo "<option value='1'>Season 1</option>"; // Default to Season 1 if series details not available
                            }
                            ?>
                        </select>
                        <input type="hidden" name="series_id" value="<?php echo $selected_series; ?>">
                    </form>
                    <ul id="episode-list">
                        <?php
                        if (!empty($episodes)) {
                            foreach ($episodes['episodes'] as $episode) {
                                $episode_number = $episode['episode_number'];
                                $episode_name = $episode['name'];
                                echo "<li><a href='#' data-episode-number='{$episode_number}' data-season='{$selected_season}'>{$episode_name}</a></li>";
                            }
                        } else {
                            echo "<p>No episodes available.</p>";
                        }
                        ?>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

<?php
include "./includes/footer.php";
?>
