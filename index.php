<?php
session_start();
$page = "home";

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
    <meta property="og:title" content="Nissen Emergency Response Training">
    <meta property="og:description" content="Offering Emergency Response Training to Ankeny, and parts of Des Moines.">
    <meta property="og:image" content="http://nissenert.com/assets/img/logo.png">
    <meta property="og:url" content="http:/nissenert.com/index.php">
    <meta name="twitter:card" content="summary_large_image">
    <title>Home - NissenERT</title>

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
    <!--HEADER SECTION -->
    <header class="home-header">
        <div class='off-canvas-wrapper'>
            <!-- MOBILE NAVIGATION -->
            <div class='off-canvas position-left' id='mobile-menu' data-off-canvas>
            <!-- CLOSE BUTTON -->
                <button class='close-button' aria-label='Close menu' type='button' data-close>
                  <span aria-hidden='true'>&times;</span>
                </button>
                <br>
                <ul class='mobile-nav'>
                    <a href='#'>
                        <li class='active'>
                            <div class='circleIcon'> <img class='nav-icon' src='assets/icons/png/home-icon.png' alt='Home Page'></div>Home</li>
                    </a>
                    <a href='about.php'>
                        <li>
                            <div class='circleIcon'> <img class='nav-icon' src='assets/icons/png/about-icon.png' alt='About NissenERT'> </div>About</li>
                    </a>
                    <a href='courses.php'>
                        <li>
                            <div class='circleIcon'> <img class='nav-icon' src='assets/icons/png/courses-icon.png' alt="NissenERT's Courses"> </div>Courses</li>
                    </a>
                    <a href='schedule.php'>
                        <li>
                            <div class='circleIcon'> <img class='nav-icon' src='assets/icons/png/schedule-icon.png' alt="NissenERT's Schedule"> </div>Schedule</li>
                    </a>
                    <a href='faq.php'>
                        <li>
                            <div class='circleIcon'> <img class='nav-icon' src='assets/icons/png/faq-icon.png' alt="NissenERT's FAQ"> </div>FAQ</li>
                    </a>
                    <a href='contact.php'>
                        <li>
                            <div class='circleIcon'> <img class='nav-icon' src='assets/icons/png/contact-icon.png' alt="NissenERT's Contact"> </div>Contact</li>
                    </a>
                </ul>
            </div>
            <!-- mobile-menu -->
            <div class='off-canvas-content' data-off-canvas-content>
                <div class='title-bar hide-for-medium'>
                    <div class='title-bar-left'>
                        <button class='menu-icon' type='button' data-open='mobile-menu'></button>
                        <span class='title-bar-title'>
                            <img class='mobile-logo' src='assets/img/logo.png' alt='Nissen Emergency Response Training'>
                        </span>
                    </div>
                </div>
            </div>
            <!-- DESKTOP NAVIGATION -->
            <div class='desktop-nav'>
                <div class='row'>
                    <div class='medium-3 columns'>
                        <!--Logo-->
                        <div class='logo-container'>
                            <img class='site-logo' src='assets/img/logo.png' alt='Nissen Emergency Response Training'>
                        </div>
                        <!--logo-container-->
                    </div>
                    <div class='medium-9 columns'>
                        <!--desktop nav items-->
                        <?php require 'require/desktopMenu.php' ?>
                    </div>
                </div>
            </div>
            <!--desktop-nav-->
            <div class='home-header-title-container'>
                <div class='home-header-title'>
                    <h1>Emergency</h1>
                    <h1>Response</h1>
                    <h1>Training</h1>
                </div>
                <!-- home-header-title -->
            </div>
            <!-- home-header-title-container -->
        </div>
        <!--wrapper-->

    </header>

    <!-- MAIN SECTION-->
    <main>
        <div class="row">
            <div class="large-12 columns">
                <div class="main-title">
                    <h1>What is NissenERT?</h1>
                </div>
                <!--main-title-->
            </div>
            <!--large-12-->
        </div>
        <!-- row -->
        <div class="row" data-equalizer data-equalize-on="medium" id="test-eq">
            <div class="medium-4 columns aboutIowa">
                <div class="callout aboutCallout" data-equalizer-watch>
                    <img class="img-responsive" src="assets/img/iowa.png" alt="Iowa">
                </div>
                <!-- callout -->
                <div class="row" data-equalizer data-equalize-on="small" id="test-eq">
                    <div class="small-12 columns">
                        <div class="callout aboutDescrip" data-equalizer-watch>
                            NissenERT is an independently owned business working in the Ankeny/Northern Des Moines area, 
                            teaching young adults and working professionals how to perform
                            lifesaving maneuvers.
                        </div>
                        <!-- aboutDescrip -->
                    </div>
                    <!-- small-12 -->
                </div>
            </div>
            <!-- medium-4 aboutIowa -->
            <div class="medium-4 columns aboutNissen">
                <div class="callout aboutCallout" data-equalizer-watch>
                        <img src="assets/img/bradyAndMorganNissen.jpg" alt="Brady and Morgan Nissen">
                    <!-- profile-img-home -->
                </div>
                <!-- callout -->
                <div class="row" data-equalizer data-equalize-on="small" id="test-eq">
                    <div class="small-12 columns">
                        <div class="callout aboutDescrip" data-equalizer-watch>
                            Mr. Nissen has nearly a decade of experience working with the American Red Cross, 
                            both in land and water-based lifesaving techniques.
                        </div>
                    </div>
                </div>
            </div>
            <!-- medium-4 -->
            <div class="medium-4 columns aboutTools">
                <div class="callout aboutCallout" data-equalizer-watch>
                    <img src="assets/img/tools.JPG" class="img-responsive" alt="CPR training tools">
                </div>
                <!-- callout -->
                <div class="row" data-equalizer data-equalize-on="small" id="test-eq">
                    <div class="small-12 columns">
                        <div class="callout aboutDescrip" data-equalizer-watch>
                            NissenERT has brand new training equipment that is designed 
                            to help show how to preform these skills correctly.
                        </div>
                    </div>
                </div>
            </div>
            <!-- medium-4 -->
            </div>
        <!-- COURSES SECTION -->
        <div class="row">
            <div class="large-12 columns">
                <div class="main-title">
                    <h1>Courses</h1>
                </div>
                <!--main-title-->
            </div>
            <!--large-12 columns-->
        </div>
        <!--row-->
        <div class="row" data-equalizer data-equalize-on="medium" id="test-eq">
            <div class="small-12  medium-6 columns">
                <div class="course-tab">
                    <div class="callout course-title" data-equalizer-watch>
                        <h2>CPR for individuals.</h2>
                    </div>
                    <div class="callout course-text" data-equalizer-watch>
                        <p>CPR course showing how to care for adults and infants. It is the recommended course for parents and those wanting/needing training before starting a new job. ADULT and INFANT CPR/AED/First Aid certification. $95 per individual, valid two years.
                        </p>
                        <a href="courses.php">
                        <input class="course-button" type="button" name="course1" value="Learn More...">
                        </a>
                    </div>
                    <!--course-text/callout-->
                </div>
                <!--course-tab-->
            </div>
            <div class="small-12 medium-6 columns">
                <div class="course-tab">
                    <div class="callout course-title" data-equalizer-watch>
                        <h2>CPR for the workplace.</h2>
                    </div>
                    <div class="callout course-text" data-equalizer-watch>
                        <p>This course is tailored to professionals in the workplace. It provides training on CPR/AED/First Aid, and covers the legal aspect of this certification at the job site. ADULT CPR/AED/First Aid certification ONLY. Pricing based on attendance, valid two years.
                        </p>
                        <a href="courses.php">
                        <input class="course-button" type="button" name="course2" value="Learn More...">
                        </a>
                    </div>
                    <!--course-text/callout-->
                </div>
                <!--course-tab-->
            </div>
        </div>
    </main>

    <!--FOOTER SECTION-->
    <footer>
        <?=$thankYou ?>
        <div class="row">
            <div class="wrapper">
                <!-- QUICK INFO -->
                <?php require "require/footer/quickInfo.php" ?>
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
