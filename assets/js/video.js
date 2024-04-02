document.addEventListener('DOMContentLoaded', function () {
    var episodeLinks = document.querySelectorAll('#episode-list a');
    episodeLinks.forEach(function (link) {
      link.addEventListener('click', function (event) {
        event.preventDefault();
        var episodeNumber = this.getAttribute('data-episode-number');
        var season = this.getAttribute('data-season');
        var episodeUrl = "https://vidsrc.to/embed/tv/<?php echo $selected_series; ?>/" + season + "/" + episodeNumber;
        document.getElementById('video-player').src = episodeUrl;
      });
    });
  });

  document.addEventListener('DOMContentLoaded', function () {
    var seasonForm = document.getElementById('season-form');
    var episodeList = document.getElementById('episode-list');
    var videoPlayer = document.getElementById('video-player');

    seasonForm.addEventListener('change', function () {
      var selectedSeason = this.querySelector('#season').value;
      var selectedSeries = this.querySelector('input[name="series_id"]').value;

      fetchEpisodes(selectedSeries, selectedSeason);
    });

    function fetchEpisodes(seriesId, seasonNumber) {
      var url = "https://api.themoviedb.org/3/tv/" + seriesId + "/season/" + seasonNumber + "?api_key=21e8c70b8d8ab44e9ce6e7d707eb4a9f";
      
      fetch(url)
        .then(function(response) {
          return response.json();
        })
        .then(function(data) {
          episodeList.innerHTML = ''; // Clear existing episodes

          if (data.episodes && data.episodes.length > 0) {
            data.episodes.forEach(function(episode) {
              var episodeNumber = episode.episode_number;
              var episodeName = episode.name;
              var listItem = document.createElement('li');
              var link = document.createElement('a');
              link.href = "https://vidsrc.to/embed/tv/" + seriesId + "/" + seasonNumber + "/" + episodeNumber;
              link.textContent = episodeName;
              link.addEventListener('click', function(event) {
                event.preventDefault();
                var episodeUrl = this.href;
                videoPlayer.src = episodeUrl;
              });
              listItem.appendChild(link);
              episodeList.appendChild(listItem);
            });
          } else {
            episodeList.innerHTML = "<p>No episodes available.</p>";
          }
        })
        .catch(function(error) {
          console.error('Error fetching episodes:', error);
        });
    }

    // Automatically play the video when the source changes
    videoPlayer.addEventListener('load', function () {
      videoPlayer.contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}', '*');
    });

    // Initial fetch of episodes
    var selectedSeason = document.querySelector('#season').value;
    var selectedSeries = document.querySelector('input[name="series_id"]').value;
    fetchEpisodes(selectedSeries, selectedSeason);
  });


  document.addEventListener('DOMContentLoaded', function() {
    var episodeList = document.getElementById('episode-list');
    var nowPlayingBtn = document.getElementById('now-playing-btn');
    var nowPlayingEpisode = document.getElementById('now-playing-episode');

    episodeList.addEventListener('click', function(event) {
        var target = event.target;
        if (target.tagName.toLowerCase() === 'a') {
            event.preventDefault();
            var episodeLinks = episodeList.getElementsByTagName('a');
            for (var i = 0; i < episodeLinks.length; i++) {
                episodeLinks[i].classList.remove('now-playing');
            }
            target.classList.add('now-playing');
            var episodeName = target.textContent;
            nowPlayingEpisode.textContent = episodeName;
            nowPlayingBtn.style.display = 'inline-block';
        }
    });
});

function updateRandomNumber() {
  // Fetch the updated random number using AJAX
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          document.getElementById("onlineUsers").innerText = "Online Users: " + this.responseText;
      }
  };
  xhttp.open("GET", "random.php", true);
  xhttp.send();
}

// Initial call to fetch the random number
updateRandomNumber();

// Periodically update the random number every 4 seconds
setInterval(updateRandomNumber, 4000);
