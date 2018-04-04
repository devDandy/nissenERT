<?php
$page = "courses";
session_start();

    $senderFullName="";
    $senderEmail="";
    $businessName="";
    $senderTelephone="";

    $senderFullNameError="";
    $senderEmailError="";
    $senderTelephoneError="";
    $messageError="";

    $validForm = false;


    if(isset($_POST["quickSubmit"])) {

        //Grabs the user's input
        $senderFullName=$_POST["senderFullName"];
        $senderEmail=$_POST["senderEmail"];
        $businessName=$_POST["businessName"];
        $senderTelephone=$_POST["senderTelephone"];
        $message=$_POST["message"];


        require 'require/form/formValidation.php';


        //Information for mail();
        $recipient="brady@nissenert.com";
        $subject="Email from: $senderFullName used from the contact page";
        $mailBody="Name: $senderFullName\nEmail: $senderEmail\nBusiness: $businessName\nTelephone: $senderTelephone\n\n$message";

        $validForm = true; 


        validateName($senderFullName);
        validateEmail($senderEmail);
        validateTelephone($senderTelephone);
        validateMessage($message);
        reCAPTCHA();



        if ($validForm) {

            global $recipient, $subject, $mailBody, $senderFullName, $senderEmail;

            mail($recipient, $subject, $mailBody, "From: $senderFullName <$senderEmail>");
            echo"
                    <div id='confirmationModal'>
                        <div class='confirmationModalContent'>
                        <span class='closeSuccessModal'>&times;</span>
                            <h1>Success!</h1>
                                <p class='lead'>Your message has been sent!</p>
                        </div>
                    </div>";
        } else {
           echo"
                    <div id='confirmationModal'>
                        <div class='confirmationModalContent'>
                        <span class='closeSuccessModal'>&times;</span>
                            <h1>Oops. Something is wrong.</h1>
                                <p class='lead'>Please look over the error messages and then  try to submit the form again.</p>
                        </div>
                    </div>";
        }


    }

    if(isset($_POST["reset"])) {
        $senderFullName="";
        $senderEmail="";
        $businessName="";
        $senderTelephone="";

        $senderFullNameError="";
        $senderEmailError="";
        $senderTelephoneError="";
        $messageError="";

    }


?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Courses - Nissen Emergency Response Training">
    <meta property="og:image" content="https://nissenert.com/assets/img/logo.PNG">
    <meta property="og:url" content="https://nissenert.com/courses.php">
    <meta name="twitter:card" content="summary_large_image">
    <title>Courses - NissenERT</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicons/favicon-16x16.png">
    <link rel="manifest" href="assets/favicons/manifest.json">
    <link rel="mask-icon" href="assets/favicons/safari-pinned-tab.svg" color="#cf1738">
    <meta name="theme-color" content="#cf1738">

    <script src='https://www.google.com/recaptcha/api.js'></script>

    <style>
        .galleryContainer {
            width: 50%;
            height: auto;
            margin: 2em auto;
        }
    </style>
</head>
<body>
    <!--HEADER SECTION -->
    <header>
        <div class="off-canvas-wrapper">
            <!-- MOBILE NAVIGATION -->
            <div class="off-canvas position-left" id="mobile-menu" data-off-canvas>
                <!-- CLOSE BUTTON -->
                <button class="close-button" aria-label="Close menu" type="button" data-close>
                    <span aria-hidden="true">&times;</span>
                </button>
                <br>
                <ul class="mobile-nav">
                    <a href="index.php">
                        <li>
                            <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/home-icon.png" alt="Home Page"> </div>Home</li>
                    </a>
                    <a href="about.php">
                        <li>
                            <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/about-icon.png" alt="About NissenERT"> </div>About</li>
                    </a>
                    <a href="#">
                        <li class="active">
                            <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/courses-icon.png" alt="NissenERT's courses"> </div>Courses</li>
                    </a>
                    <a href="schedule.php">
                        <li>
                            <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/schedule-icon.png"> </div>Schedule</li>
                    </a>
                    <a href="faq.php">
                        <li>
                            <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/faq-icon.png"> </div>FAQ</li>
                    </a>
                    <a href="contact.php">
                        <li>
                            <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/contact-icon.png"> </div>Contact</li>
                    </a>
                </ul>
            </div>
            <div class="off-canvas-content" data-off-canvas-content>
                <div class="title-bar hide-for-medium">
                    <div class="title-bar-left">
                        <button class="menu-icon" type="button" data-open="mobile-menu"></button>
                        <span class="title-bar-title">
                            <img class="mobile-logo" src="assets/img/logo.png" alt="Nissen Emergency Response Training">
                        </span>
                    </div>
                </div>
            </div>
            <!-- DESKTOP NAVIGATION -->
            <div class="desktop-nav">
                <div class="row">
                    <div class="medium-3 columns">
                        <!--Logo-->
                        <div class="logo-container">
                            <img class="site-logo" src="assets/img/logo.png" alt="Nissen Emergency Response Training">
                        </div>
                        <!--logo-container-->
                    </div>
                    <div class="medium-9 columns">
                        <!--nav items-->
                        <?php require "require/desktopMenu.php" ?>
                    </div>
                </div>
            </div>
            <!--desktop-nav-->
            <div class="header-title-container">
                <div class="header-title">
                    <h1>NissenERT's</h1>
                    <h1>Courses</h1>
                    <p class="lead">NissenERT offers two different courses for your convenience. <br><strong>Please ask about web-blended classes.</strong></p>
                </div>
                <!--header-title-->
            </div>
            <!--header-title-container-->
        </div>
        <!--wrapper-->
    </header>
    <!-- MAIN SECTION-->
    <main>


<div class="galleryContainer">
<div class="orbit" role="region" aria-label="Favorite Space Pictures" data-orbit>
  <div class="orbit-wrapper">
    <div class="orbit-controls">
      <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
      <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
    </div>
    <ul class="orbit-container">
      <li class="is-active orbit-slide">
        <figure class="orbit-figure">
          <img class="orbit-image" src="assets/img/cprManeuvers.jpg" alt="CPR Maneuver" width="300px" height="200px">
        </figure>
      </li>
      <li class="orbit-slide">
        <figure class="orbit-figure">
          <img class="orbit-image" src="assets/img/humanWithAED.jpg" alt="Performing AED" width="300px" height="200px">
        </figure>
      </li>
      <li class="orbit-slide">
        <figure class="orbit-figure">
          <img class="orbit-image" src="assets/img/infantWithAED.jpg" alt="Performing AED on an infant" width="300px" height="200px">
        </figure>
      </li>
      <li class="orbit-slide">
        <figure class="orbit-figure">
          <img class="orbit-image" src="assets/img/cprInfant.jpg" alt="Performing CPR on infant" width="300px" height="200px">
        </figure>
      </li>
    </ul>
  </div>
  <nav class="orbit-bullets">
    <button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
    <button data-slide="1"><span class="show-for-sr">hello world</span></button>
    <button data-slide="2"><span class="show-for-sr">Third slide details.</span></button>
    <button data-slide="3"><span class="show-for-sr">Fourth slide details.</span></button>
  </nav>
</div>
</div>






        <br>
        <div class="row" data-equalizer data-equalize-on="medium" id="test-eq">
            <div class="small-12 medium-6 columns">
                <div class="callout course-box" data-equalizer-watch>
                    <h1 class="course-title">Individual CPR</h1>
                    <div class="course-information">
                        <p>This CPR course shows how to care for adults and infants. It is the recommended course for parents or those wanting/needing training before starting a new job.</p>
                        <ul class="course-details text-center">
                            <li>Adult CPR and Infant CPR</li>
                            <li>AED Training</li>
                            <li>First-Aid Training</li>
                            <li>Recommended for families</li>
                            <li>Valid for two years</li>
                        </ul>
                        <h2 class="text-center">$95</h2>
                        <p class="text-center">per individual.</p>
                        <!-- course price -->
                    </div>
                    <!-- course info -->
                </div>
                <!--callout-->
            </div>
            <!--medium-6-->
            <div class="small-12 medium-6 columns">
                <div class="callout course-box" data-equalizer-watch>
                    <h1 class="course-title">Workplace CPR</h1>
                    <div class="course-information">
                        <p>This course is tailored to professionals in the workplace. It also covers the legal aspect of this certification at the job site.</p>
                        <br>
                        <ul class="course-details text-center">
                            <li>Adult CPR</li>
                            <li>AED Training</li>
                            <li>First-Aid Training</li>
                            <li>Covers legal aspects</li>
                            <li>Valid for two years</li>
                        </ul>
                        <h2 class="text-center">Please Contact for<br> Pricing</h2>
                        <!-- course-price -->
                    </div>
                    <!-- course-information -->
                </div>
                <!--callout-->
            </div>
            <!--medium-6-->
        </div>
        <!--row-->
        <br>
        <div class="row">
            <div class="medium-12 columns onlineClasses">
                <a href="contact.php"><input type="button" class="course-button" value="Ask About Web-Blended Classes"></a>
            </div>
        </div>
    </main>
    <!--FOOTER SECTION-->
    <footer>
        <div class="row">
            <div class="wrapper">
                <!-- FOOTER ICON -->
                <div class="footer-circle-wrapper">
                    <div class="footer-circle">
                        <img class="footer-mail-icon" src="assets/icons/png/mail-icon.png">
                    </div>
                </div>
                <!-- QUICK INFO -->
                    <?php require "require/footer/quickInfo.php" ?>
                <!-- QUICK CONTACT -->
                    <?php require "require/footer/quickContact.php" ?>
            </div>
        </div>
    </footer>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script>
        // Get the modal
        var modal = document.getElementById('confirmationModal');

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("closeSuccessModal")[0];
        // Modal closes when user hits "x"
        span.onclick = function() {
            modal.style.display = "none";
        }
// Modal closes when user hits anywhere else of the modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    </script>

</body>

</html>
