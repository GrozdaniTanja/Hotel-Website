<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>TheEvent Bootstrap Template - Index</title>
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
  include 'includes/header2.php';
  include 'includes/mysqli_connect.php'; // database
  
  // connection to DB  
  
  if (isset($_POST['check_in']) && isset($_POST['check_out']) && isset($_POST['steviloGost']) && isset($_POST['stDijake']) && isset($_POST['soba_id'])) {
    //getting data from the form and storing it in variables
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $steviloGost = $_POST['steviloGost'];
    $stDijake = $_POST['stDijake'];
    $soba_id = $_POST['soba_id'];

    // prepare an SQL statement
    $stmt = $dbc->prepare("INSERT INTO rezervacija(check_in, check_out, steviloGost, stDijake,soba_id) VALUES (?, ?, ?, ?, ?)");
    // let's define the parameters
    $stmt->bind_param('ssiii', $check_in, $check_out, $steviloGost, $stDijake, $soba_id);
    // let's execute the SQL
    $stmt->execute();
  }


  ?>

  <div style="display:none;" id="toggles">

    <?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require "vendor/phpmailer/phpmailer/src/Exception.php";
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';

    require_once "vendor/autoload.php";

    //PHPMailer Object
    $mail = new PHPMailer(true); //Argument true in constructor enables exceptions
    $mail->SMTPDebug = 3;
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();
    //Set SMTP host name                          
    $mail->Host = "smtp.gmail.com";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
    //Provide username and password     
    $mail->Username = "guccilinen69@gmail.com";
    $mail->Password = "evetigokazuvam2001";
    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//Set TCP port to connect to
    $mail->Port = 587;

    $mail->From = "Athena-WP4@gmail.com";
    $mail->FromName = "Tanja";

    $mail->addAddress("tanjagrozdani@gmail.com");

    $mail->isHTML(true);

    $mail->Subject = "Subject Text";
    $mail->Body = "<i>Succesfully subscribed</i>";
    $mail->AltBody = "This is the plain text version of the email content";

    try {
      if (isset($_POST['mess'])) {
        $mail->send();
        echo "Message has been sent successfully";
      }
    } catch (Exception $e) {
      echo "Mailer Error: " . $mail->ErrorInfo;
    }

    ?>
  </div>
  <!-- ======= Header ======= >  
  


<!--------Print data from the database -------------->
  <?php
  /*$db = new mysqli($db_hostname, $db_username, $db_password, $db_database);
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  } */
  $queryHotel = "SELECT *FROM hotel";
  $izpisHotel = mysqli_query($dbc, $queryHotel);
  if (!$izpisHotel) {
    die("Dostop do PB ni uspel");
  } else {
    $stVrstic = mysqli_num_rows($izpisHotel);
  }

  $hotel = mysqli_fetch_row($izpisHotel);
  $dbc->close();

  ?>

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
      <h1 class="mb-4 pb-0" method="get" name="naziv"><span>
          <?php echo $hotel[1]; ?>
        </span></h1>
      <a href="https://www.youtube.com/watch?v=VIoymqYkuXg&ab_channel=RACERFISH" class="glightbox play-btn mb-4"></a>
      <div class="btn-group" role="group" aria-label="Basic example">
        <a href="#about" class="about-btn scrollto">About us</a>
        <?php if (isset($_SESSION['id'])) {
          echo '<a href="#buy-tickets" class="about-btn scrollto" >Book now</a> ';
        }
        ?>

      </div>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-6">
            <h2>About</h2>
            <p>The Grand Resort Bad Ragaz is centered around a bathing and spa tradition spanning hundreds of years.<br>
              This has evolved into a unique combination of our own thermal spring, holistic medical expertise and
              everything a five-star luxury resort has to offer. </p>
          </div>
          <div class="col-lg-3">
            <h3>NEWYOU Method®</h3>
            <p> We help you to optimise your lifestyle and experience real transformation – so that you<br> can live
              healthy and stay healthy.</p>
          </div>
          <div class="col-lg-3">
            <h3>Information</h3>
            <p>Under the direction of our Medical Director at the Medical Center, Dr. med. Stefan Küpfer,<br> we do
              everything to protect your health.</p>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->

    <!-- ======= Speakers Section ======= -->
    <section id="speakers">
      <div class="container" data-aos="fade-up">
        <div class="section-header">

          <h2>ROOMS&SUITES</h2>
          <p>Here are some of ours rooms&suites</p>
        </div>
        <form action="">
          <label for="fname">Search rooms: </label>
          <input type="text" id="fname" name="fname" onkeyup="showHint(this.value)">
        </form>
        <p>Rooms items: <span id="txtHint"></span></p>
        <div class="row">
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="100">
              <img src="assets/img/speakers/1.jpg" alt="Speaker 1" class="img-fluid">
              <div class="details">
                <h3 name="naziv" method="get"><a href="speaker-details.html">DESIGNER ROOM BY GINNY LITSCHER</a></h3>

                <a href=""> <i class="bi bi-star"></i></a>
                <a href=""> <i class="bi bi-star"></i></a>
                <a href=""> <i class="bi bi-star"></i></a>
                <a href=""> <i class="bi bi-star"></i></a>
                <a href=""> <i class="bi bi-star"></i></a>
                <div class="social">
                  <a href=""><i class="bi bi-calendar2-check"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="200">
              <img src="assets/img/speakers/2.jpg" alt="Speaker 2" class="img-fluid">
              <div class="details">
                <h3><a href="speaker-details3.html">JUNIOR SUITE DELUXE</a></h3>
                <a href=""> <i class="bi bi-star"></i></a>
                <a href=""> <i class="bi bi-star"></i></a>
                <a href=""> <i class="bi bi-star"></i></a>
                <a href=""> <i class="bi bi-star"></i></a>
                <a href=""> <i class="bi bi-star"></i></a>
                <div class="social">
                  <a href=""><i class="bi bi-calendar2-check"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="speaker" data-aos="fade-up" data-aos-delay="300">
              <img src="assets/img/speakers/3.jpg" alt="Speaker 3" class="img-fluid">
              <div class="details">
                <h3><a href="speaker-details2.html">GRAND DELUXE</a></h3>
                <a href=""> <i class="bi bi-star"></i></a>
                <a href=""> <i class="bi bi-star"></i></a>
                <a href=""> <i class="bi bi-star"></i></a>
                <a href=""> <i class="bi bi-star"></i></a>
                <a href=""> <i class="bi bi-star"></i></a>

                <div class="social">
                  <a href=""><i class="bi bi-calendar2-check"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section><!-- End Speakers Section -->

    <!-- ======= Schedule Section ======= -->
    <section id="schedule" class="section-with-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Event Schedule</h2>
          <p>Here is our event schedule</p>
        </div>

        <ul class="nav nav-tabs" role="tablist" data-aos="fade-up" data-aos-delay="100">
          <li class="nav-item">
            <a class="nav-link active" href="#day-1" role="tab" data-bs-toggle="tab">Day 1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#day-2" role="tab" data-bs-toggle="tab">Day 2</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#day-3" role="tab" data-bs-toggle="tab">Day 3</a>
          </li>
        </ul>

        <h3 class="sub-heading">Voluptatem nulla veniam soluta et corrupti consequatur neque eveniet officia. Eius
          necessitatibus voluptatem quis labore perspiciatis quia.</h3>

        <div class="tab-content row justify-content-center" data-aos="fade-up" data-aos-delay="200">

          <!-- Schdule Day 1 -->
          <div role="tabpanel" class="col-lg-9 tab-pane fade show active" id="day-1">

            <div class="row schedule-item">
              <div class="col-md-2"><time>09:30 AM</time></div>
              <div class="col-md-10">
                <h4>Registration</h4>
                <p>Fugit voluptas iusto maiores temporibus autem numquam magnam.</p>
              </div>
            </div>

            <div class="row schedule-item">
              <div class="col-md-2"><time>10:00 AM</time></div>
              <div class="col-md-10">
                <div class="speaker">
                  <img src="assets/img/speakers/1.jpg" alt="Brenden Legros">
                </div>
                <h4>Keynote <span>Brenden Legros</span></h4>
                <p>Facere provident incidunt quos voluptas.</p>
              </div>
            </div>

            <div class="row schedule-item">
              <div class="col-md-2"><time>11:00 AM</time></div>
              <div class="col-md-10">
                <div class="speaker">
                  <img src="assets/img/speakers/2.jpg" alt="Hubert Hirthe">
                </div>
                <h4>Et voluptatem iusto dicta nobis. <span>Hubert Hirthe</span></h4>
                <p>Maiores dignissimos neque qui cum accusantium ut sit sint inventore.</p>
              </div>
            </div>

          </div>
          <!-- End Schdule Day 1 -->

          <!-- Schdule Day 2 -->
          <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-2">

            <div class="row schedule-item">
              <div class="col-md-2"><time>10:00 AM</time></div>
              <div class="col-md-10">
                <div class="speaker">
                  <img src="assets/img/speakers/1.jpg" alt="Brenden Legros">
                </div>
                <h4>Libero corrupti explicabo itaque. <span>Brenden Legros</span></h4>
                <p>Facere provident incidunt quos voluptas.</p>
              </div>
            </div>

            <div class="row schedule-item">
              <div class="col-md-2"><time>11:00 AM</time></div>
              <div class="col-md-10">
                <div class="speaker">
                  <img src="assets/img/speakers/2.jpg" alt="Hubert Hirthe">
                </div>
                <h4>Et voluptatem iusto dicta nobis. <span>Hubert Hirthe</span></h4>
                <p>Maiores dignissimos neque qui cum accusantium ut sit sint inventore.</p>
              </div>
            </div>

          </div>
          <!-- End Schdule Day 2 -->

          <!-- Schdule Day 3 -->
          <div role="tabpanel" class="col-lg-9  tab-pane fade" id="day-3">

            <div class="row schedule-item">
              <div class="col-md-2"><time>10:00 AM</time></div>
              <div class="col-md-10">
                <div class="speaker">
                  <img src="assets/img/speakers/2.jpg" alt="Hubert Hirthe">
                </div>
                <h4>Et voluptatem iusto dicta nobis. <span>Hubert Hirthe</span></h4>
                <p>Maiores dignissimos neque qui cum accusantium ut sit sint inventore.</p>
              </div>
            </div>

            <div class="row schedule-item">
              <div class="col-md-2"><time>11:00 AM</time></div>
              <div class="col-md-10">
                <div class="speaker">
                  <img src="assets/img/speakers/3.jpg" alt="Cole Emmerich">
                </div>
                <h4>Explicabo et rerum quis et ut ea. <span>Cole Emmerich</span></h4>
                <p>Veniam accusantium laborum nihil eos eaque accusantium aspernatur.</p>
              </div>
            </div>

            <div class="row schedule-item">
              <div class="col-md-2"><time>12:00 AM</time></div>
              <div class="col-md-10">
                <div class="speaker">
                  <img src="assets/img/speakers/1.jpg" alt="Brenden Legros">
                </div>
                <h4>Libero corrupti explicabo itaque. <span>Brenden Legros</span></h4>
                <p>Facere provident incidunt quos voluptas.</p>
              </div>
            </div>
          </div>
          <!-- End Schdule Day 2 -->

        </div>

      </div>

    </section><!-- End Schedule Section -->

    <!-- ======= Venue Section ======= -->
    <section id="venue">

      <div class="container-fluid" data-aos="fade-up">

        <div class="section-header">
          <h2>HOTEL LOCATION</h2>
          <p>Hotel location info and gallery</p>
        </div>

        <div class="row g-0">
          <div class="col-lg-6 venue-map">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d48095.048229993816!2d20.75694986090382!3d41.113990198144165!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1350db6587ea6657%3A0xc46cfc65390bc9d3!2sOhrid%2C%20North%20Macedonia!5e0!3m2!1sen!2ssi!4v1637886475263!5m2!1sen!2ssi"
              frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>

          <div class="col-lg-6 venue-info">
            <div class="row justify-content-center">
              <div class="col-11 col-lg-8 position-relative">
                <h3>Ohrid, Macedonia</h3>
                <p>Sublime Ohrid is North Macedonia's most seductive destination. It sits on the edge of serene Lake
                  Ohrid, with an atmospheric old quarter that cascades down steep streets, dotted with beautiful
                  churches and topped by the bones of a medieval castle. Traditional restaurants and lakeside cafes
                  liven up the cobblestone streets, which in high summer can be very lively indeed.</p>
              </div>
            </div>
          </div>
        </div>

      </div>


    </section><!-- End Venue Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery">
      <div class="container" data-aos="fade-up">
        <div class="section-header">
          <h2>Gallery</h2>
          <p>Check our gallery </p>
        </div>
      </div>
      <div class="gallery-slider swiper">
        <div class="swiper-wrapper align-items-center">
          <div class="swiper-slide"><a href="assets/img/gallery/1.jpg" class="gallery-lightbox"><img
                src="assets/img/gallery/1.jpg" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="assets/img/gallery/2.jpg" class="gallery-lightbox"><img
                src="assets/img/gallery/2.jpg" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="assets/img/gallery/3.jpg" class="gallery-lightbox"><img
                src="assets/img/gallery/3.jpg" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="assets/img/gallery/4.jpg" class="gallery-lightbox"><img
                src="assets/img/gallery/4.jpg" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="assets/img/gallery/5.jpg" class="gallery-lightbox"><img
                src="assets/img/gallery/5.jpg" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="assets/img/gallery/6.jpg" class="gallery-lightbox"><img
                src="assets/img/gallery/6.jpg" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="assets/img/gallery/7.jpg" class="gallery-lightbox"><img
                src="assets/img/gallery/7.jpg" class="img-fluid" alt=""></a></div>
          <div class="swiper-slide"><a href="assets/img/gallery/8.jpg" class="gallery-lightbox"><img
                src="assets/img/gallery/8.jpg" class="img-fluid" alt=""></a></div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Booking  Section ======= -->
    <?php if (isset($_SESSION['id'])): ?>

      <section id="buy-tickets" class="section-with-bg">
        <div class="container" data-aos="fade-up">
          <div class="section-header">
            <h2>Booking</h2>
            <p>Velit consequatur consequatur inventore iste fugit unde omnis eum aut.</p>
          </div>
          <div id="booking" class="section">
            <div class="booking-form">
              <form class="form-inline" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <span class="form-label">Rooms&suites</span>
                      <select class="form-control" placeholder="Room&suites" style="font-size: 12px;" name="soba_id">
                        <option style="font-size: 14px;" value="1"></option>
                        <option style="font-size: 14px;" value="2">DESIGNER ROOM BY GINNY LITSCHER</option>
                        <option style="font-size: 14px;" value="3">JUNIOR SUITE DELUXE</option>
                        <option style="font-size: 14px;" value="4">GRANDE DELUXE</option>
                      </select>
                      <span class="select-arrow" style="font-size: 18px;"></span>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <span class="form-label">Guests</span>
                      <input class="form-control" type="number" style="font-size: 16px;" name="steviloGost">
                      <span class="select-arrow"></span>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <span class="form-label">Children</span>
                      <input class="form-control" type="number" style="font-size: 16px;" name="stDijake">

                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <span class="form-label">Check In</span>
                      <input class="form-control" type="date" style="font-size: 18px;" name="check_in" required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <span class="form-label">Check out</span>
                      <input class="form-control" type="date" style="font-size: 18px;" name="check_out" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-btn">
                      <button class="submit-btn" data-bs-toggle="modal" data-bs-target="#buy-ticket-modal"
                        data-ticket-type="premium-access" value="submit" id="popup">Check availability</button>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>


      </section>
    <?php endif; ?>

    <!-- End Buy Ticket Section -->

    <!-- ======= Subscribe Section ======= -->
    <section id="subscribe">
      <div class="container" data-aos="zoom-in">
        <div class="section-header">
          <h2>Newsletter</h2>
          <p>Rerum numquam illum recusandae quia mollitia consequatur.</p>
        </div>

        <form action="" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>>
          <div class=" row justify-content-center">
          <div class="col-lg-6 col-md-10 d-flex">
            <input type="text" name="mess" id="mess" class="form-control" placeholder="Enter your Email">
            <button type="submit" class="ms-2">Subscribe</button>
          </div>
      </div>
      </form>

      </div>
    </section><!-- End Subscribe Section -->



    <!-- ======= Contact Section ======= -->
    <section id="contact" class="section-bg">

      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contact Us</h2>
          <p>Nihil officia ut sint molestiae tenetur.</p>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <address>
                <?php echo $hotel[3] ?>
              </address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="bi bi-phone"></i>
              <h3>Phone Number</h3>
              <p><a href=><?php echo $hotel[4] ?></a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p><a href=><?php echo $hotel[2] ?></a></p>
            </div>
          </div>

        </div>


      </div>
    </section><!-- End Contact Section -->

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
  <script>
    $(document).ready(function () {
      $("#popup").click(function () {
        alert("Thank you for your reservation!");
      });
    });
  </script>
  <script>
    function showHint(str) {
      if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
          }
        }
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
      }
    }
  </script>


  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
  </script>


</body>

</html>