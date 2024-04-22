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


$api_key = '21e8c70b8d8ab44e9ce6e7d707eb4a9f'; // Replace with your actual API key
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
            <li><a href="tv_series.php">TV Series</a></li>
            <?php
            if (!empty($series_details)) {
                echo "<li>{$series_details['name']}</li>";
            }
            if (!empty($episodes)) {
                $current_episode_number = isset($_GET['episode']) ? $_GET['episode'] : '';
                echo "<li>Season {$selected_season}, Episode {$current_episode_number}</li>";
            }
            ?>
        </ol>
        <?php
        if (!empty($episodes) && !empty($current_episode_number)) {
            echo "<p>You are currently watching Season {$selected_season}, Episode {$current_episode_number}. Enjoy!</p>";
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
                        <!-- No video here -->
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <?php
                if (!empty($episodes)) {
                    foreach ($episodes['episodes'] as $episode) {
                        $episode_number = $episode['episode_number'];
                        $episode_name = $episode['name'];
                        $episode_description = $episode['overview'];
                        $episode_poster = "https://image.tmdb.org/t/p/w500" . $episode['still_path']; // Adjust the size as needed
                        echo "<h3>{$episode_name}</h3>";
                        echo "<img src='{$episode_poster}' alt='{$episode_name}' style='max-width: 100%; height: auto;'>";
                        echo "<p>{$episode_description}</p>";
                        echo "<a href='https://vidsrc.to/embed/tv/{$selected_series}/{$selected_season}/{$episode_number}' target='_blank' class='btn btn-primary'>Watch Now</a>";
                    }
                } else {
                    echo "<p>No episodes available.</p>";
                }
                ?>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-info">
                    <h3>List of Episodes</h3>
                    <form id="season-form" method="GET">
                        <label for="season">Select Season:</label>
                        <select name="season" id="season" onchange="this.form.submit()">
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
                </div>
            </div>

        </div>

    </div>
</section><!-- End Portfolio Details Section -->

</main><!-- End #main -->

<?php
include "./includes/footer.php";
?>
