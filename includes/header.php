<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/css/hover.css" rel="stylesheet">


</head>
<script>
    document.addEventListener('contextmenu', function (event) {
      event.preventDefault();
    });
  </script>
<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center"> 
      <h1 class="logo me-auto"><a href="index.php">ZENFLIX<span>.</span></a></h1>
      <form action="search.php" method="GET">
      <input type="text" name="query" placeholder="Search here">
      <button type="submit" class="get-started-btn scrollto">Search</button>
    </form>


      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
        <li><a class="nav-link scrollto" href="./series.php">Series</a></li>
        <li><a class="nav-link scrollto" href="./index.php">Movies</a></li>
        <li class="dropdown"><a href="#"><span>Genre</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="./adult-anime.php">Animation</a></li>
              <li><a href="./action.php">Action</a></li>
              <li><a href="./comedy.php">Comedy</a></li>
              <li><a href="./drama.php">Drama</a></li>
              <li><a href="./documentary.php">Documentary</a></li>
              <li><a href="./marvel.php">Marvel Series</a></li>
              <li><a href="./horror.php">Mystery</a></li>
            </ul>
          </li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <?php
       date_default_timezone_set('Africa/Nairobi');
    $hour = date('G');
    $greeting = '';
    
    if ($hour >= 0 && $hour < 12) {
        $greeting = 'Good Morning';
    } elseif ($hour >= 12 && $hour < 18) {
        $greeting = 'Good Afternoon';
    } else {
        $greeting = 'Good Evening';
    }
?>




    </div>
  </header><!-- End Header -->