<?php

//------------------------------------------------------LOG IN PAGE----------------------------------------------------//
require('includes/config.inc.php');
$page_title = 'Login';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require(MYSQL);

  // check if email field is empty
  if (!empty($_POST['email'])) {
    $e = mysqli_real_escape_string($dbc, $_POST['email']);
  } else {
    $e = FALSE;
    echo '<div class="alert alert-danger" role="alert">You forgot to enter your email address!</div>';
  }

  // check password
  if (!empty($_POST['pass'])) {
    $p = mysqli_real_escape_string($dbc, $_POST['pass']);
  } else {
    $p = FALSE;
    echo '<div class="alert alert-danger" role="alert">You forgot to enter your password!</div>';
  }

  if ($e && $p) { // if checking went good

    // SQL to query user in DB
    $q = "SELECT id, username, administrator FROM uporabnik WHERE (email='$e' AND pass=SHA1('$p'))";
    $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

    if (@mysqli_num_rows($r) == 1) { // if the user exist

      // saving data to a session
      $_SESSION = mysqli_fetch_array($r, MYSQLI_ASSOC);
      mysqli_free_result($r);
      mysqli_close($dbc);

      // redirect to home page
      $url = BASE_URL . 'index.php';
      header("Location: $url");
      exit();

    } else { // if the user is not found
      echo '<div class="alert alert-danger" role="alert">Either the email address and password entered
			do not match those on file or you have not yet activated your account.</div>';
    }

  } else { // if an error occurred
    echo '<div class="alert alert-danger" role="alert">Please try again.</div>';
  }

  mysqli_close($dbc);

}

?>

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

  <?php include 'includes/header2.php';
  ?>
  <main id="main" class="main-page">

    <!-- ======= Speaker Details Sectionn ======= -->
    <section id="speakers-details">
      <div class="container">
        <div class="section-header">
          <h2>Log In</h2>
        </div>
        <div class="login-page">
          <div class="form">
            <form action="login.php" method="post" class="login-form">
              <input type="text" placeholder="email" name="email" />
              <input type="password" placeholder="password" name="pass" />
              <button class="submit-btn" data-bs-toggle="modal" data-bs-target="#buy-ticket-modal"
                data-ticket-type="premium-access" value="LogIn">login</button>
              <p class="message">Not registered? <a href="register.php">Create an account</a></p>
            </form>
          </div>
        </div>
      </div>
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