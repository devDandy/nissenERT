<?php
session_start();
$page = "faq";

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
    <title>FAQ - NissenERT</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicons/favicon-16x16.png">
    <link rel="manifest" href="assets/favicons/manifest.json">
    <link rel="mask-icon" href="assets/favicons/safari-pinned-tab.svg" color="#cf1738">
    <meta name="theme-color" content="#cf1738">

    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body>
    <!-- HEADER SECTION -->
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
                    <a href="courses.php">
                        <li>
                            <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/courses-icon.png" alt="NissenERT's courses"> </div>Courses</li>
                    </a>
                    <a href="schedule.php">
                        <li>
                            <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/schedule-icon.png"> </div>Schedule</li>
                    </a>
                    <a href="#">
                        <li class="active">
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
                    <h1>Frequently Asked<br> Questions</h1>
                    <p class="lead">NissenERT's Frequently Asked Questions (FAQ).</p>
                </div>
                <!--header-title-->
            </div>
            <!--header-title-container-->
        </div>
        <!--wrapper-->
    </header>
    <!-- MAIN SECTION-->
    <main class="faq-body">
        <div class="row">
            <div class="medium-5 columns">
                <div class="questions-container">
                    <ul>
                        <li class="question-header">
                            <h4> What is CPR?</h4></li>
                        <p class="questionAnswer">CPR stands for <strong>C</strong>ardio<strong>P</strong>ulmonary <strong>R</strong>esuscitation.
                            <br>
                            <br> Cardio is the Latin prefix for "heart."  Pulmonary is the Latin term for "pertaining to the lungs." 
                            It is a cycle of breathing and chest compressions that is meant to either resuscitate a victim or help keep a victim alive until advanced help arrives. The breaths in a CPR cycle give oxygen to the lungs, and the compressions help circulate the oxygen-rich blood to the brain.
                        </p>
                        <li class="question-header">
                            <h4>Where do most cardiac emergencies happen?</h4></li>
                        <p class="questionAnswer">According to the <a href="https://www.heart.org/HEARTORG/CPRAndECC/Whatis%20CPR/CPRFactsandStats/CPR-Statistics_UCM_307542_Article.jsp#.WV6ypca-LuR" target="_blank">American Heart Association</a>, <strong>most cardiac arrests happen in the home.</strong> </p>
                        <li class="question-header">
                            <h4>How many Americans are estimated to suffer from a heart attack each year?</h4></li>
                        <p class="questionAnswer">
                            The <a href="https://www.cdc.gov/heartdisease/heart_attack.htm" target="_blank">Center for Disease Control and Prevention</a> estimates around <strong>735,000 Americans</strong> each year have a heart attack. 
                        </p>
                    </ul>
                </div>
                <!--question-container-->
            </div>
            <!--medium5-->
            <div class="medium-5 columns">
                <div class="questions-container">
                    <ul>
                        <li class="question-header">
                            <h4>What is an AED?</h4></li>
                        <p class="questionAnswer">
                            AED stands for <strong>A</strong>utomatic <strong>E</strong>xternal <strong>D</strong>efibrillator. <br> <br>
                             "Fibrillation" is a term that is used to describe an abnormal heart rhythm. The AED is a machine that analyzes the victim for a heart rhythm and administers a shock when the heart is beating out of rhythm or too quickly. This shock actually STOPS the heart for a brief moment and allows the heart to return to a natural rhythm.
                        </p>
                        <li class="question-header">
                            <h4>How many people each year die from a cardiac emergency?</h4></li>
                        <p class="questionAnswer">
                            The <a href="https://www.cdc.gov/heartdisease/facts.htm">Center for Disease  Control and Prevention</a> estimates that <strong>610,000 Americans</strong> die each year due to heart disease. Nearly 1 in 4 deaths each year are related to heart disease.
                        </p>
                        <li class="question-header">
                            <h4>Which is more deadly, heart disease or cancer?</h4></li>
                        <p class="questionAnswer">
                            <strong>Heart disease</strong>.<a href="http://www.hopkinsmedicine.org/healthlibrary/conditions/cardiovascular_diseases/cardiovascular_disease_statistics_85,P00243/" target="_blank"> John Hopkins University</a> states that heart disease is the number one cause of death in both men and women.
                        </p>
                    </ul>
                </div>
                <!--question-container-->
            </div>
            <!--medium5-->
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
                    <!-- footer-circle -->
                </div>
                <!-- footer-circle-wrapper -->
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
    var acc = document.getElementsByClassName("question-header");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function() {
            this.classList.toggle("active");
            var questionAnswer = this.nextElementSibling;
            if (questionAnswer.style.maxHeight) {
                questionAnswer.style.maxHeight = null;
            } else {
                questionAnswer.style.maxHeight = questionAnswer.scrollHeight + "px";
            }
        }
    }
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
