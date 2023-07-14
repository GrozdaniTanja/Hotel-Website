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

  // -----------------------------------------------------------------CHANGE PASSWORD PAGE-------------------------//
  

  require('includes/config.inc.php');
  $page_title = 'Change Your Password';
  include('includes/header2.php');

  // If user is not loged in
  if (!isset($_SESSION['id'])) {

    $url = BASE_URL . 'index.php';
    ob_end_clean();
    header("Location: $url");
    exit();

  }

  // if a password change request was made
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require(MYSQL);

    // checking the password and whether the same new password is entered twice
    $p = FALSE;
    if (preg_match('/^(\w){8,20}$/', $_POST['password1'])) {
      if ($_POST['password1'] == $_POST['password2']) {
        $p = mysqli_real_escape_string($dbc, $_POST['password1']);
      } else {
        echo '<script language="javascript">';
        echo 'alert("Passwords do not match!")';
        echo '</script>';
      }
    } else {
      echo '<script language="javascript">';
      echo 'alert("Please enter a valid password! !")';
      echo '</script>';
    }

    if ($p) {

      $q = "UPDATE uporabnik SET pass=SHA1('$p') WHERE id={$_SESSION['id']} LIMIT 1";
      $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
      if (mysqli_affected_rows($dbc) == 1) {
        echo ' <script language="javascript">';
        echo 'alert("Successfully changed!")';
        echo '</script>';
        $url = BASE_URL . 'index.php';
        header("Location: $url");

        mysqli_close($dbc);
        exit();

      } else {
        echo ' <script language="javascript">';
        echo 'alert("An error ocurred. Please try again!")';
        echo '</script>';

      }

    }

    mysqli_close($dbc);

  }
  ?>

  <main id="main" class="main-page">

    <!-- ======= Speaker Details Sectionn ======= -->
    <section id="speakers-details">
      <div class="container">
        <div class="section-header">
          <h2>Change Password</h2>
        </div>
        <div class="login-page">
          <div class="form">

            <form action="change_password.php" method="post">
              <fieldset>
                <div class="form-group"><label>New Password:</label> <input type="password" class="form-control"
                    name="password1" size="20" maxlength="20" autofocus /> <small class="form-text text-muted">
                    <div id="count">
                      <span id="current_count">0</span>
                      <span id="maximum_count">/ 20</span>
                    </div>
                  </small></div>

                <script>
                  $(document).ready(function () {
                    $('input').keyup(function () {
                      var characterCount = $(this).val().length,
                        current_count = $('#current_count'),
                        maximum_count = $('#maximum_count'),
                        count = $('#count');
                      current_count.text(characterCount);
                    });
                  });
                </script>
                <div class="form-group"><label>Confirm New Password:</label> <input type="password" class="form-control"
                    name="password2" size="20" maxlength="20" /></div>
              </fieldset>
              <button class="submit-btn" data-bs-toggle="modal" data-bs-target="#buy-ticket-modal"
                data-ticket-type="premium-access" value="Change password">Change Password</button>

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