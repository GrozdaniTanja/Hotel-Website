<?php

// uporaba sej (jih uporablja celotna stran)
session_start();

// preverjanje in nastavljanje spremenljive $page_title - naslov strani
if (!isset($page_title)) {
	$page_title = 'User Registration';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $page_title; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: TheEvent - v4.7.0
  * Template URL: https://bootstrapmade.com/theevent-conference-event-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>
  <header id="header" class="d-flex align-items-center ">
    <div class="container-fluid container-xxl d-flex align-items-center">

      <div id="logo" class="me-auto">
        <a href="index.html" class="scrollto"><img src="assets/img/logo.png" alt="" title=""></a>
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#speakers">Rooms&Suites</a></li>
          <li><a class="nav-link scrollto" href="#schedule">Events</a></li>
          <li><a class="nav-link scrollto" href="#venue">Location</a></li>         
          <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
		  <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
		  <?php

// prikaz povezav glede na status uporabnika ("prijavljenost")
if (isset($_SESSION['id'])) {
	echo ' prijavljen';
	echo '<li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i><ul><li class="nav-item"><a href="logout.php" title="Logout" class="nav-link">Logout</a></li>
		  <li class="nav-item"><a href="change_password.php" title="Change Your Password" class="nav-link">Change Password</a></li>
		  <li class="nav-item"><a href="#" class="nav-link">Some Non-Admin Page</a></li></ul>';

	// dodajanje povezav, če je uporabnik administrator
	if (@$_SESSION['user_level'] == 1) {
		echo '<li class="nav-item"><a href="view_users.php" title="View All Users" class="nav-link">View Users</a></li>
			  <li class="nav-item"><a href="#" class="nav-link">Some Admin Page</a></li>';
	}
 

}
else { 
// če uporabnik ni prijavljen
echo ' ni prijavljen';
	echo ' <li class="nav-item"><a href="login.php" title="Login" class="nav-link">Login</a></li>';
}
?>         
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    <!--  <a class="buy-tickets scrollto" href="#buy-tickets">Book now</a> -->
   <!--   <a class="buy-tickets scrollto" href="login.php">Log in</a> -->

    </div>
  </header>






