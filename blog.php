<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>High Rated Movies</title>
    <style>
        .movie-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .movie {
            margin: 20px;
            text-align: center;
        }
        .movie img {
            width: 200px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>High Rated Movies</h1>
    <div id="movies-list">
        <?php
        // Set your API key here
        $api_key = '21e8c70b8d8ab44e9ce6e7d707eb4a9f';

        // Function to fetch list of high rated movies
        function getHighRatedMovies($api_key) {
            $url = "https://api.themoviedb.org/3/discover/movie?api_key={$api_key}&sort_by=vote_average.desc&vote_count.gte=1000";
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
                echo "<div class='movie-container'>";
                foreach ($movies as $movie) {
                    $title = $movie['title'];
                    $poster_path = $movie['poster_path'];
                    $poster_url = "https://image.tmdb.org/t/p/w500{$poster_path}";

                    echo "<div class='movie'>";
                    echo "<h2>{$title}</h2>";
                    echo "<img src='{$poster_url}' alt='{$title} Poster'>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "<p>No movies found!</p>";
            }
        }

        // Example usage
        $movies = getHighRatedMovies($api_key);
        displayMovies($movies);
        ?>
    </div>
</body>
</html>
