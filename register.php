<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TheEvent Bootstrap Template - Speaker Details</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="login.css" rel="stylesheet">


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

  <?php

  //------------------------------------------------------------ Register Page-------------------------------------------------//
  

  require('includes/config.inc.php');
  //$page_title = 'Register';
//include ('includes/header.php');
//include 'database.php';// se so sakas da zimas od databazata tuka 
//require ('includes/phpmailer.php');
  

  // processing of registration form data
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // connection to DB is required
    require(MYSQL);

    // "trim" all data
    $trimmed = array_map('trim', $_POST);

    // predvidevamo neveljavne podatke
    $un = $e = $p = FALSE;

    // checking the name and, if necessary, printing an error
    if (preg_match('/^[A-Z \'.-]{2,20}$/i', $trimmed['username'])) {
      $un = mysqli_real_escape_string($dbc, $trimmed['username']);
    } else {
      echo '<div class="alert alert-warning" role="alert">Please enter your first name!</div>';
    }

    // preverjanje e-maila in po potrebi izpis napake
    if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
      $e = mysqli_real_escape_string($dbc, $trimmed['email']);
    } else {
      echo '<div class="alert alert-warning" role="alert">Please enter a valid email address!</div>';
    }

    // checking the e-mail and, if necessary, printing out the error
    if (preg_match('/^\w{4,20}$/', $trimmed['pass'])) {
      if ($trimmed['pass'] == $trimmed['pass2']) {
        $p = mysqli_real_escape_string($dbc, $trimmed['pass']);
      } else {
        echo '<div class="alert alert-warning" role="alert">Your password did not match the confirmed password!</div>';
      }
    } else {
      echo '<div class="alert alert-warning" role="alert">Please enter a valid password!</div>';
    }

    if ($un && $e && $p) {

      // checking whether the email is still available (it must not be already taken)
      $q = "SELECT id FROM uporabnik WHERE email='$e'";
      $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));



      if (mysqli_num_rows($r) == 0) { // e-mail is available
  
        // add new user to the DB
        $q = "INSERT INTO uporabnik (username, email, pass)
			VALUES ('$un','$e', SHA1('$p') )";
        $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

        if (mysqli_affected_rows($dbc) == 1) { // if it's everything okay 
  

          echo '<div class="alert alert-success" role="alert">Thank you for registering! </div>';
          $url = BASE_URL . 'login.php';
          header("Location: $url");

        }

        exit();

      } else { // if e-mail is not available
        echo '<div class="alert alert-danger" role="alert">That email address has already been registered. If you have forgotten your password, use the link at right to have your password sent to you.</div>';
      }

    } else { // if an error occurred while verifying the registration data
      echo '<div class="alert alert-danger" role="alert">Please try again.</div>';
    }

    mysqli_close($dbc);

  }
  ?>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center header-inner">
    <div class="container-fluid container-xxl d-flex align-items-center">
      <div id="logo" class="me-auto">
        <a href="index.html" class="scrollto"><img src="assets/img/logo.png" alt="" title=""></a>
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link scrollto " href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#speakers">Speakers</a></li>
          <li><a class="nav-link scrollto" href="#schedule">Schedule</a></li>
          <li><a class="nav-link scrollto" href="#hotels">Hotels</a></li>
          <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <?php

          // display of links according to user status ("login")
          if (isset($_SESSION['id'])) {

            echo '<li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i><ul><li class="nav-item"><a href="logout.php" title="Logout" class="nav-link">Logout</a></li>
		  <li class="nav-item"><a href="change_password.php" title="Change Your Password" class="nav-link">Change Password</a></li>
		  <li class="nav-item"><a href="#" class="nav-link">Some Non-Admin Page</a></li></ul><i class="bi bi-list mobile-nav-toggle"></i><a class="buy-tickets scrollto" href="#buy-tickets">Book now</a> <a class="buy-tickets scrollto" href="login.php">Log in</a>';

            // adding links if the user is an administrator
            if (@$_SESSION['user_level'] == 1) {
              echo '<li class="nav-item"><a href="view_users.php" title="View All Users" class="nav-link">View Users</a></li>
			  <li class="nav-item"><a href="#" class="nav-link">Some Admin Page</a></li>';
            }

          } else { // if the user is not logged in
            echo ' ';
          }
          ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
      <!--     <a class="buy-tickets scrollto" href="#buy-tickets">Buy Tickets</a>  -->

    </div>
  </header><!-- End Header -->

  <main id="main" class="main-page">

    <!-- ======= Speaker Details Sectionn ======= -->
    <section id="speakers-details">
      <div class="container">
        <div class="section-header">
          <h2>Register</h2>
        </div>

        <div class="login-page">
          <div class="form">
            <form action="register.php" class="register-form" method="post">
              <input type="text" placeholder="username" name="username" value="<?php if (isset($trimmed['username']))
                echo $trimmed['username']; ?>" />
              <input type="text" placeholder="email address" name="email" value="<?php if (isset($trimmed['email']))
                echo $trimmed['email']; ?>" />
              <input type="password" placeholder="password" name="pass" value="<?php if (isset($trimmed['pass']))
                echo $trimmed['pass']; ?>" />
              <input type="password" placeholder="password" name="pass2" value="<?php if (isset($trimmed['pass2']))
                echo $trimmed['pass2']; ?>" />
              <button class="submit-btn" data-bs-toggle="modal" data-bs-target="#buy-ticket-modal"
                data-ticket-type="premium-access" value="register">Register</button>
              <p class="message">Already registered? <a href="login.php">Sign In</a></p>
            </form>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        $('.message a').click(function () {
          $('form').animate({ height: "toggle", opacity: "toggle" }, "slow");
        });

      </script>


    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-info">
            <img src="assets/img/logo.png" alt="TheEvenet" id="logo">

          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>
              A108 Karposh Vojvoda <br>
              Ohrid, Oh 535022<br>
              Macedonia <br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>

            <div class="social-links">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong> Hotel Grozdani </strong>
      </div>
      <div class="credits">
        <!--
        All the links in the footer should remain intact.
        You can delete the links only if you purchased the pro version.
        Licensing information: https://bootstrapmade.com/license/
        Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=TheEvent
      -->
      </div>
    </div>
  </footer><!-- End  Footer -->


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>



  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>