
  <!-- ======= Footer ======= -->
  <footer id="footer">


    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; <strong><span>ZENFLIX</span></strong>.<?php
echo " " . date("F j, Y");
?>. 
      We do not store any media.

        </div>
        <div class="credits">  
        </div>
      </div>
      <div class="social-links text-center text-md-end pt-3 pt-md-0">
      <?php
// Generate a random number between 1076 and 1099
$randomNumber = rand(1076, 1099);
echo $randomNumber;
?>




      
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/video.js"></script>

  <script>
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
</script>

</body>

</html>