<?php
        function validateName($inName) {
          global $validForm, $senderFullNameError; // global variables
             
            $senderFullNameError = "";

          if (empty($inName)) {
            $validForm = false;
            $senderFullNameError = "Full name is required.";
          } 
        }
        function validateEmail($inEmail) {
          global $validForm, $senderEmailError; // global variables

          $senderEmailError = "";

            if (empty($inEmail)) {
                $validForm = false;
                $senderEmailError = "Email is required.";
            } else {
                if (!filter_var($inEmail, FILTER_VALIDATE_EMAIL)) {
                    $validForm = false;
                    $senderEmailError = "Invalid email format.";
                }
            }
        }


        function validateTelephone($inTelephone) {
            global $validForm, $senderTelephoneError; // global variables 

            $senderTelephoneError= "";

            if (empty($inTelephone)) {
                $validForm = true; //makes this form field optional
            } else {
                if (!is_numeric($inTelephone)) {
                    $validForm = false; 
                    $senderTelephoneError = "Phone number has to be numeric.";
                } else {
                    if (strlen($inTelephone) > 10 ) {
                        $validForm = false;
                        $senderTelephoneError = "Please number has to be under 10 characters.";
                    }
                }
            }
        }//end

        function validateMessage($inMessage) {
            global $validForm, $messageError; // global variables

            $messageError = "";

            if (empty($inMessage)) {
                $validForm = false; 
                $messageError = "Please enter a message.";
            }
        }//end

        function reCAPTCHA() {
            global $validForm, $recaptchaError;

            $recaptchaError = "";

            function post_captcha($user_response) {
                $fields_string = '';
                $fields = array(
                    'secret' => 'XXX',
                    'response' => $user_response
                );
                foreach($fields as $key=>$value)
                $fields_string .= $key . '=' . $value . '&';
                $fields_string = rtrim($fields_string, '&');

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
                curl_setopt($ch, CURLOPT_POST, count($fields));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

                $result = curl_exec($ch);
                curl_close($ch);

                return json_decode($result, true);
            }
            $res = post_captcha($_POST['g-recaptcha-response']);

            if (!$res['success']) {
                $recaptchaError = "Please make sure you click the CAPTCHA box.";
                $validForm = false;
            } else {
                $validForm = true;
            }
        }
 ?>