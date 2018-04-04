<?php
$page = "about";
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
    <meta property="og:title" content="About - Nissen Emergency Response Training">
    <meta property="og:image" content="http://nissenert.com/assets/img/logo.PNG">
    <meta property="og:url" content="http:/nissenert.com/about.php">
    <meta name="twitter:card" content="summary_large_image">
    <title>About - NissenERT</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <style>
        main {
            margin-bottom: 25px;
        }
    </style>
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicons/favicon-16x16.png">
    <link rel="manifest" href="assets/favicons/manifest.json">
    <link rel="mask-icon" href="assets/favicons/safari-pinned-tab.svg" color="#cf1738">
    <meta name="theme-color" content="#cf1738">
    
    <script src='https://www.google.com/recaptcha/api.js'></script>

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
                            <a href="#">
                                <li class="active">
                                    <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/about-icon.png" alt="About NissenERT"> </div>About</li>
                            </a>
                            <a href="courses.php">
                                <li>
                                    <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/courses-icon.png" alt="NissenERT's courses"> </div>Courses</li>
                            </a>
                            <a href="schedule.php">
                                <li>
                                    <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/schedule-icon.png" alt="NissenERT's Schedule"> </div>Schedule</li>
                            </a>
                            <a href="faq.php">
                                <li>
                                    <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/faq-icon.png" alt="NissenERT's FAQ"> </div>FAQ</li>
                            </a>
                            <a href="contact.php">
                                <li>
                                    <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/contact-icon.png" alt="NissenERT's Contact Information"> </div>Contact</li>
                            </a>
                        </ul>
            </div>
            <div class="off-canvas-content" data-off-canvas-content>
                <div class="title-bar hide-for-medium">
                    <div class="title-bar-left">
                        <button class="menu-icon" type="button" data-open="mobile-menu"></button>
                        <span class="title-bar-title">
                            <img class="mobile-logo" src="assets/img/logo.png" alt="Nissen Emergency Response Training Logo">
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
                            <img class="site-logo" src="assets/img/logo.png" alt="Nissen Emergency Response Training Logo">
                        </div>
                        <!--logo-container-->
                    </div>
                    <div class="medium-9 columns">
                        <!--nav itmes-->
                        <ul class="desktop-menu">
                            <a href="index.php">
                                <li>
                                    <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/home-icon.png" alt="Home Page"> </div>Home</li>
                            </a>
                            <a href="about.php">
                                <li class="active">
                                    <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/about-icon.png" alt="About NissenERT"> </div>About</li>
                            </a>
                            <a href="courses.php">
                                <li>
                                    <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/courses-icon.png" alt="NissenERT's courses"> </div>Courses</li>
                            </a>
                            <a href="schedule.php">
                                <li>
                                    <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/schedule-icon.png" alt="NissenERT's Schedule"> </div>Schedule</li>
                            </a>
                            <a href="faq.php">
                                <li>
                                    <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/faq-icon.png" alt="Nissen's FAQ"> </div>FAQ</li>
                            </a>
                            <a href="contact.php">
                                <li>
                                    <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/contact-icon.png"> </div>Contact</li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
            <!--desktop-nav-->
            <br>
            <div class="header-title-container">
            <div class="header-title">
                <h1>About <br> NissenERT</h1>
            </div>
            <!--header-title-->
            </div>
            <!--header-title-container-->
        </div>
        <!--wrapper-->
    </header>
    <!-- MAIN SECTION-->
    <main>
        <!--row-->
        <div class="row">
            <div class="large-6 columns">
                <div class="course-tab">
                <div class="sub-title">
                    <h2>History of NissenERT</h2>
                </div>
                    <div class="callout course-text">
                        <p>
                            Nissen Emergency Response Training LLC was founded in 2016 by Brady Nissen as an opportunity for people to learn the importance of being prepared. NissenERT offers training in American Red Cross CPR/AED/FIRST AID.
                        </p>
                    </div>
                    <!--course-text/callout-->
                </div>
                <!--course-tab-->
            </div>
            <!--large-6-->
            <div class="large-6 columns">
            <div class="logo">
                <img src="assets/img/logo.png" alt="NissenERT Logo">
            </div>
            <!-- logo -->
            </div>
            <!--large-6-->
        </div>
        <!--- ABOUT OWNER SECTION -->
        <div class="row" data-equalizer data-equalize-by-row="true">
            <div class="large-6 columns" data-equalizer-watch>
                <div class="profile-img">
                        <img src="assets/img/bradyNissen.jpg">
                </div>
            </div>
            <div class="large-6 columns" data-equalizer-watch>
                <div class="course-tab">
                <div class="sub-title">
                    <h2>Brady Nissen</h2>
                </div>
                    <div class="callout course-text" data-equalizer-watch>
                        <p>Hello! Thank you for visiting NissenERT’s website. I started this company with the goal of teaching as many people as possible how to help others. I live with my wife in Ankeny, Iowa where I teach companies and individuals how to perform lifesaving maneuvers. I believe that with proper training anyone can learn how to save a life. If you have any questions, please leave me a message on the contact page.
                        </p>
                    </div>
                </div>
            </div>
            <!--row-->
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
