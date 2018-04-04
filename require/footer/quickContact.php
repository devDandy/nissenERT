                <div class="medium-6 columns">
                    <h2 class="text-center"><span class="highlight">Quick Contact</span></h2>
                    <hr>
                    <form method="post" class="quickContactForm" name="quickContactForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <div class="row">
                            <div class="medium-6 columns">
                                <label for="Full Name" class="qucikFormLabel">Full Name* <br><span class="contactPageError"><?php echo $senderFullNameError; ?></span>
                                    <input type="text" name="senderFullName" placeholder="Full Name"> 
                                </label>
                            </div>
                            <div class="medium-6 columns">
                                <label for="Email Address" class="qucikFormLabel">Email Address* <br><span class="contactPageError"><?php echo $senderEmailError; ?></span>
                                    <input type="email" name="senderEmail" placeholder="Email Address"> 
                                </label>
                            </div>
                            <div class="medium-6 columns">
                                <label for="Business Name" class="qucikFormLabel">Business Name<br>
                                    <input type="text" name="businessName" placeholder="Business Name">
                                </label>
                            </div>
                            <div class="medium-6 columns">
                                <label class="qucikFormLabel">Telephone<br><span class="contactPageError"><?php echo $senderTelephoneError; ?></span>
                                    <input type="text" name="senderTelephone" placeholder="Phone Number"> 
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <label for="Message" class="qucikFormLabel">
                                    Message*<br>
                                    <span class="contactPageError"><?php echo $messageError; ?></span>
                                    <textarea name="message" placeholder="Write your message here!"></textarea>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="large-12 columns">
                                <label for="Google reCAPTCHA" class="qucikFormLabel">
                                    <span class="contactPageError"><?php echo $recaptchaError; ?></span>
                                    <div class="g-recaptcha" data-sitekey="6Lc7_TQUAAAAAK3jSbao2-bXTLhoDo6zJBQVqTnF"></div>
                                    <br>
                                </label>
                            </div>
                        </div>

                    	<small><p>* indicates the form field is required.</p></small>
                        <input class="form-button" type="submit" name="quickSubmit" value="Submit">
                        <input class="form-button" type="reset" name="quickReset" value="Reset">
                    </form>
                </div>
                <!-- medium-6 -->