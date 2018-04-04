<?php
session_start();
$page = "contact";

    $senderFullName="";
    $senderEmail="";
    $businessName="";
    $senderTelephone="";

    $senderFullNameError="";
    $senderEmailError="";
    $senderTelephoneError="";
    $messageError="";

    $validForm = false;


    if(isset($_POST["submit"])) {

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
                                <p class='lead'>Please look over the error messages and then try again.</p>
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
    <meta property="og:title" content="Contact - Nissen Emergency Response Training">
    <meta property="og:image" content="http://nissenert.com/assets/img/logo.PNG">
    <meta property="og:url" content="http:/nissenert.com/contact.php">
    <meta name="twitter:card" content="summary_large_image">
    <title>Contact - NissenERT</title>
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
                            <a href="faq.php">
                                <li>
                                    <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/faq-icon.png"> </div>FAQ</li>
                            </a>
                            <a href="#">
                                <li class="active">
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
                        <!--nav itmes-->
                        <?php require "require/desktopMenu.php" ?>
                    </div>
                </div>
            </div>
            <!--desktop-nav-->
            <div class="header-title-container">
                <div class="header-title">
                    <div class="contact-icon-container">
                        <img class="contact-icon" src="assets/icons/png/mail-icon.png">
                    </div>
                    <h1>Contact Us.</h1>
                </div>
                <!--header-title-->
            </div>
            <!--header-title-container-->
        </div>
        <!--wrapper-->
    </header>
    <!-- MAIN SECTION-->
    <main>
        <div class="row">
                 <div class="medium-4 columns contact-info-container">
                    <div class="small-12 medium-12 columns">
                        <div class="sub-title">
                            <h3>Email</h3></div>
                        <!--sub-title-->
                        <div class="hide-for-medium">
                        <div class="contactIcon sidebarIcon"> <img class="nav-icon" src="assets/icons/png/mail-icon.png"> </div>
                        </div>
                        <p class="text-center small-text">brady@nissenERT.com</p>
                    </div>
                    <!--medium12-->
                    <!--medium-12 / small-4-->
                    <div class="small-12 medium-12 columns">
                        <div class="sub-title">
                            <h3>Telephone</h3></div>
                        <div class="hide-for-medium">
                        <a href="tel:17122490440">
                            <div class="contactIcon sidebarIcon"> <img class="nav-icon" src="assets/icons/png/contact-icon.png"> </div>
                            </div>
                            <p class="text-center small-text">(712)-249-0440</p>
                        </a>
                    </div>
                    <div class="small-12 medium-12 columns">
                        <div class="sub-title">
                            <h3>Facebook</h3></div>
                        <!--sub-title-->
                        <a href="https://www.facebook.com/nissenert/">
                        <div class="contactIcon sidebarIcon"> <img class="nav-icon" src="assets/icons/png/contactFacebook.png"> </div>
                        </a>
                    </div>
                </div>

                <!-- medium 4 -->
            <div class="medium-8 columns">
                <div class="row">
                    <div class="sub-title text-center">
                        <h2>Write Us A Message</h2></div>
                </div>
                <!--subtitle-->
                <form method="post" id="contactPageForm" name="contactForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
                    <div class="row">
                        <div class="medium-6 columns">
                            <label for="senderFullName" class="PrimaryContact">Full Name* <span class="contactPageError"><?php echo $senderFullNameError; ?></span>
                                <input type="text" name="senderFullName" placeholder="Full Name">
                            </label>
                        </div>
                        <div class="medium-6 columns">
                            <label for="emailAddress" class="PrimaryContact ">Email Address* <span class="contactPageError"><?php echo $senderEmailError; ?></span>
                                <input type="email" name="senderEmail" placeholder="Email Address">
                            </label>
                        </div>
                        <div class="medium-6 columns">
                            <label for="businessName" class="PrimaryContact ">Business Name 
                                <input type="text" name="businessName" placeholder="Business">
                            </label>
                        </div>
                        <div class="medium-6 columns">
                            <label for="Telephone" class="PrimaryContact ">Telephone <span class="contactPageError"><?php echo $senderTelephoneError; ?></span>
                                <input type="number" name="senderTelephone" placeholder="Telephone">
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label for="Message" class="PrimaryContact ">
                                Message*<span class="contactPageError"><?php echo $messageError; ?></span>
                                <textarea name="message" placeholder="Write your message here!"></textarea>
                            </label>
                        </div>
                        <!-- large-12 -->
                    </div>
                    <!-- row -->
                        <div class="row">
                            <div class="large-12 columns">
                                <label for="Google reCAPTCHA" class="qucikFormLabel">
                                    <span class="contactPageError"><?php echo $recaptchaError; ?></span>
                                    <div class="g-recaptcha" data-sitekey="6Lc7_TQUAAAAAK3jSbao2-bXTLhoDo6zJBQVqTnF"></div>
                                    <br>
                                </label>
                            </div>
                        </div>

                    <small>* indicates the form field is required.</small><br>
                    <input class="form-button" type="submit" name="submit" value="Submit">
                    <input class="form-button" type="reset" name="reset" value="Reset">

                </form>
            </div>
            <!-- medium 5 -->
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

                <div class="medium-6 columns">
                    <h2 class="text-center"><span class="highlight">Site Map</span></h2>
                    <hr>
                        <ul class="siteMapMenu">
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
                            <a href="forms.php">
                                <li>
                                    <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/form-icon.png"> </div>Forms</li>
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
                                <li class="active">
                                    <div class="circleIcon"> <img class="nav-icon" src="assets/icons/png/contact-icon.png"> </div>Contact</li>
                            </a>
                        </ul>
                </div>
            </div>
        </div>
    </footer>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
    <script> //Modal Script
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
