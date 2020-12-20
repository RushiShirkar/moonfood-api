<!DOCTYPE html>
<html>
<head>
    <title>Online Local </title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#263238">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#263238">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#263238">

    <!-- Core css bootstrap.min.css -->
    <link href="{{ asset('assets/bootstrap/css/bootstrap.min.css')  }}" rel="stylesheet">
    <!-- Core css bootstrap.min.css -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <!-- <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css"> -->


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Google Fonts StyleSheet -->
    <link href="https://fonts.googleapis.com/css?family=Lato|Roboto|Source+Sans+Pro" rel="stylesheet">
    <!-- Google Fonts StyleSheet -->



    <!-- Custom StyleSheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/StyleSheet.css') }}">
    <!-- Custom StyleSheet -->
    <style type="text/css">
        body{
            background-color: #263238;
        }
        .container-fluid
        {
            background-color:#37474F;
            /* background: #CB356B;  /* fallback for old browsers */
        }
        .city{
            background-image: url('{{ asset('assets/img/location_search.png') }}');
        }

    </style>
</head>
<body>

<!-- ___________________Container for Sign In and Sign Up Button________________________-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-md-offset-9">
            <!-- data-target="#SignInUpModal" -->
            <a class="pull-right home_signInUp" data-toggle="modal" onclick="return showModal();">Sign In / Sign Up</a> &nbsp;
        </div>
    </div>
</div>
<!-- ___________________Container for Sign In and Sign Up Button________________________-->

<!-- ________________________________Container for Search Bar_______________________________-->
<div class="container-fluid home_container">
    <div class="row">
        <div class="col-md-12">
            <center>
                <a href="javascript:void(0)"><img src="{{ asset('assets/img/fashiostreet_logo.png') }}" class="img-responsive"></a>
            </center>
        </div>
    </div>

    <div class="row">
        <center>
            <div class="col-md-12">
                <div class="input-group">
                    <form action="#" method="get">
                        <div  class="input-group">
                            <!-- input search -->
                        </div>

                    </form>
                </div>
            </div>
        </center>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <center>
                <h4 class="text-center tag_line">India's Local Shopping Search Engine</h4>
                <div style="color:white"><h1>Coming soon for Customer...</h1>
                    <h3 style="font-weight: normal">For Retailer : <a href="javascript:void(0)" style="color:#76FF03" data-toggle="modal" onclick="return showModal();">Click here to create your shop</a></h3></div>
            </center>
        </div>
    </div>
</div>
<!-- ________________________________Container for Search Bar_______________________________-->


<!-- _______________________________________Small Modal___________________________________-->

<!-- Sign In & Sign Up small Modal combine-->
<div class="modal fade" id="SignInUpSmallModal" style="display:none">
    <div class="modal-dialog">
        <div class="modal-content myfont">

            <!-- Sign in form -->
            <!-- style="padding-left: 20px;" -->

            <!-- _______________________________________Sign In Image___________________________________-->

            <div class="modal-header SignInImage" id="mob_res_SignInImage" style="display:block;">
                <div class="row mob_res_modal_row">
                    <div class="col-md-9">
                        <span class="close_sign pull-right" style="margin-top:-10px;" id="close1" data-dismiss="modal">&times;</span>
                        <img class="img-circle"  src="{{ asset('assets/img/favicon.png') }}">
                        <h3>Sign In</h3>
                        <label class="modal_content_small_modal">Please provide your Email / Mobile Number and Password to Sign In on Fashiostreet</label>
                    </div>
                    <div class="col-md-3">
                        <!-- <span class="close_sign pull-right" id="close2" data-dismiss="modal">&times;</span> -->
                    </div>
                </div>
            </div>
            <!-- _______________________________________Sign In Image___________________________________-->


            <!-- _______________________________________Sign Up Image___________________________________-->

            <div class="modal-header SignUpImage" id="mob_res_SignUpImage" style="display:none">
                <div class="row mob_res_modal_row">
                    <div class="col-md-9">
                        <span class="close_sign pull-right" style="margin-top:-10px;" id="close2" data-dismiss="modal">&times;</span>
                        <img class="img-circle"  src="{{ asset('assets/img/favicon.png') }}">
                        <h3>Sign Up</h3>
                        <label class="modal_content_small_modal">Please provide details to Sign Up on Fashiostreet</label>
                    </div>
                    <div class="col-md-3">
                        <!-- <span class="close_sign pull-right" id="close4" data-dismiss="modal">&times;</span> -->
                    </div>
                </div>
            </div>

            <!--___________________________________Sign Up Image for small Modal____________________________-->


            <!-- ______________________________Sign In Form for small Modal ______________________________-->

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" id="mob_res_signIn_form" style="padding-left:30px;padding-right:30px;display:block;">
                        <div class="form-group">
                            <!-- onkeypress="return restrictField(event,'mob_res_mobile_no');" -->
                            <label for="mob_res_mobile_no" class="field_name">Mobile number</label>&nbsp;<label class="mandatory">*</label>
                            <div class="input-group">
                                <span class="input-group-addon " id="sizing-addon2">+91</span>
                                <input type="number" id="mob_res_mobile_no"
                                       onkeydown="return disableMobileNo(event,'mob_res_mobile_no');" class="form-control" name="mobile_no" placeholder="Mobile number" required />
                            </div>
                            <span id="mob_res_mobilenoEmpty"></span>
                        </div>

                        <div id="mob_res_password_field">
                            <div class="form-group">
                                <label for="mob_res_pswd" class="field_name">Password</label>&nbsp;<label class="mandatory">*</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon2">&nbsp;<i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;</span>
                                    <input type="password" id="mob_res_pswd" class="form-control" name="pswd" placeholder="Password" title="It should be min 6 & max 20 length contains number,alphabet and special symbol" data-toggle="tooltip"  data-placement="top" required />
                                </div>
                                <span class="valid_pass" id="mob_res_password_msg" style="display:none"></span>
                            </div>
                            <a class="pull-right hyperlink" id="mob_res_forgotPass_btn">Forgot Password</a>
                            <br><br>
                        </div>
                        <div id="mob_res_forgotPassword_field" style="display:none">
                            <div class="form-group">
                                <label for="mob_res_forgotPass_otp" class="field_name">Enter OTP</label>&nbsp;<label class="mandatory">*</label>

                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon2">&nbsp;<i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;</span>
                                    <input type="number" id="mob_res_forgotPass_otp" class="form-control" name="mob_res_forgotPass_otp" onkeydown="return disableOTPField(event,'mob_res_forgotPass_otp');" placeholder="OTP" required />
                                </div>
                                <br>
                                <label for="mob_res_forgotPass" class="field_name">Password</label>&nbsp;<label class="mandatory">*</label>

                                <div class="input-group">

                                    <span class="input-group-addon" id="sizing-addon2">&nbsp;<i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;</span>

                                    <input type="password" id="mob_res_forgotPass" class="form-control" name="mob_res_forgotPass" placeholder="Enter New Password" title="It should be min 6 & max 20 length contains number,alphabet and special symbol" data-toggle="tooltip"  data-placement="bottom" required />

                                </div>
                                <span class="valid_pass" id="password_msg" style="display:none"></span>
                            </div>
                            <a class="pull-right hyperlink" style="margin-top:3px;" id="mob_res_ChangeNo">Change Number?</a>
                            <br><br>
                        </div>
                        <button type="submit" name="mob_res_SignInBtn"  id="mob_res_SignInBtn" class="btn btn-success btn-block" disabled>Sign In</button>
                        <br>
                        <button class="btn btn-default btn-block" id="mob_res_newtoFashioBtn">New to Fashiostreet ? Let's Sign Up</button>
                        <br><br>
                    </div>
                    <!-- ____________________________________Sign In Form for small Modal ___________________________-->

                    <!-- ______________________________Sign Up Form for small Modal__________________________________-->

                    <!-- onkeypress="return restrictField(event,'mob_res_mobileno');" -->
                    <div class="col-md-12" id="mob_res_signUp_form" style="display:none">
                        <div class="form-group" id="mob_res_UserField_Form" style="display:block">
                            <label class="field_name" for="mob_res_mobileno">Mobile number</label>&nbsp;<label class="mandatory">*</label>
                            <div class="input-group">
                                <span class="input-group-addon " id="sizing-addon2">+91</span>
                                <input type="number" id="mob_res_mobileno" onkeydown="return disableMobileNo(event,'mob_res_mobileno');" class="form-control" name="mobileno" placeholder="Mobile number" required />
                            </div>
                            <br>
                            <button type="submit" name="GetOtpBTN" class="btn btn-success btn-block" id="mob_res_GetOtpBTN" disabled> Get OTP</button>
                            <br>
                            <button class="btn btn-default btn-block" id="mob_res_registeredUserBtn">Already registered ? Let's Sign In</button>
                        </div>
                        <div class="form-group" id="mob_res_VerifyOTP_Form" style="display:none">
                            <label class="field_name" for="mob_res_OTP_field">One Time Pin (OTP)</label>&nbsp;<label class="mandatory">*</label>
                            <input type="number" id="mob_res_OTP_field" class="form-control" name="OTP_field" placeholder="Enter One Time Pin here"  maxlength="6" onkeydown="return disableOTPField(event,'mob_res_OTP_field');" required>
                            <h4 class="otp_msg">Check Your Phone.</h4>
                            <p class="otp_msg">OTP has been sent to your specified Mobile number.</p>
                            <a id="mob_res_goBack" class="hyperlink" title="Go Back" data-toggle="tooltip"  data-placement="left">
                                <i class="fa fa-arrow-left"></i>
                            </a>&nbsp;&nbsp;
                            <a href="#" class="hyperlink">Resend OTP</a>
                            <br><br>
                            <button type="submit" name="VerifyOtpBTN" class="btn btn-success btn-block" id="mob_res_VerifyOtpBTN" disabled> Verify OTP</button>
                            <br>
                            <button class="btn btn-default btn-block" id="mob_res_registeredUserBtn2">Already registered ? Let's Sign In</button>
                        </div>

                        <div class="form-group" id="mob_res_PasswordFields_Form" style="display:none">
                            <label class="field_name" for="mob_res_new_password">Set Password</label>&nbsp;<label class="mandatory">*</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2">&nbsp;<i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;</span>
                                <input type="password" id="mob_res_new_password" class="form-control" name="new_password" title="It should be min 6 & max 20 length contains number,alphabet and special symbol" placeholder="Enter Password here" data-toggle="tooltip"  data-placement="top"  required>
                            </div>
                            <br>
                            <label class="field_name" for="mob_res_confirm_password">Confirm your  Password</label>&nbsp;<label class="mandatory">*</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2">&nbsp;<i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;</span>
                                <input type="password" id="mob_res_confirm_password" class="form-control" name="confirm_password" placeholder="Confirm Password" title="It should be min 6 & max 20 length contains number,alphabet and special symbol" data-toggle="tooltip"  data-placement="top" required>
                            </div>
                            <br>
                            <span id="mob_res_password_equal_msg"></span>
                            <br><br>
                            <button type="submit" id="mob_res_lets_signup_btn" name="lets_signup_btn" class="btn btn-success btn-block" disabled> Let's get Started !</button>
                            <br>
                            <button class="btn btn-default btn-block" id="mob_res_registeredUserBtn3">Already registered ? Let's Sign In</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- ______________________________ Sign Up Form for small Modal__________________________________-->




<!-- <span class="close_sign"  data-dismiss="modal">&times;</span> -->

<!-- Sign In & Sign Up Modal combine-->
<!--Sign In Modal -->
<div class="modal fade" id="SignInUpModal">
    <div class="modal-dialog" >
        <div class="modal-content myfont" style="border-radius: 0px">
            <!-- Sign in form -->

            <!-- onkeypress="return restrictField(event,'mobile_no');" -->
            <div class="modal-body" style="padding: 0px">
                <div class="row " style="margin: 0;">
                    <div class="col-md-6" id="signIn_form" style="display:block">
                        <br><br><br><br>
                        <div class="form-group">
                            <label for="mobile_no" class="field_name">Mobile number</label>&nbsp;<label class="mandatory">*</label>
                            <div class="input-group">
                                <span class="input-group-addon " id="sizing-addon2">+91</span>
                                <input type="number" id="mobile_no"  onkeydown="return disableMobileNo(event,'mobile_no');" class="form-control" name="mobile_no" placeholder="Mobile number" required />
                            </div>
                            <span id="mobilenoEmpty"></span>
                        </div>
                        <div id="password_field">
                            <div class="form-group">
                                <label for="pswd" class="field_name">Password</label>&nbsp;<label class="mandatory">*</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon2">&nbsp;<i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;</span>
                                    <input type="password" id="pswd" class="form-control" name="pswd" placeholder="Password" title="It should be min 6 & max 20 length contains number,alphabet and special symbol" data-toggle="tooltip"  data-placement="right" required />
                                </div>
                                <span class="valid_pass" id="password_msg" style="display:none"></span>
                            </div>
                            <a class="pull-right hyperlink" id="forgotPass_btn">Forgot Password</a>
                            <br><br>
                        </div>
                        <div id="forgotPassword_field" style="display:none">
                            <div class="form-group">
                                <label for="forgotPass_otp" class="field_name">Enter OTP</label>&nbsp;<label class="mandatory">*</label>

                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon2">&nbsp;<i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;</span>
                                    <input type="number" id="forgotPass_otp" class="form-control" name="forgotPass_otp" onkeydown="return disableOTPField(event,'forgotPass_otp');" placeholder="OTP" required />
                                </div>
                                <br>
                                <label for="forgotPass" class="field_name">Password</label>&nbsp;<label class="mandatory">*</label>

                                <div class="input-group">

                                    <span class="input-group-addon" id="sizing-addon2">&nbsp;<i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;</span>

                                    <input type="password" id="forgotPass" class="form-control" name="forgotPass" placeholder="Enter New Password" title="It should be min 6 & max 20 length contains number,alphabet and special symbol" data-toggle="tooltip"  data-placement="right" required />

                                </div>
                                <span class="valid_pass" id="password_msg" style="display:none"></span>
                            </div>
                            <a class="pull-right hyperlink" style="margin-top:3px;" id="ChangeNo">Change Number?</a>
                            <br><br>
                        </div>
                        <button type="submit" class="btn btn-success btn-block" name="SignInBtn" id="SignInBtn" disabled>Sign In</button>
                        <br>
                        <button class="btn btn-default btn-block" id="newtoFashioBtn">New to Fashiostreet ? Let's Sign Up</button>
                    </div>
                    <div class="col-md-6" id="signUp_form" style="display:none">
                        <br><br><br><br>

                        <!-- onkeypress="return restrictField(event,'mobileno');" -->
                        <div class="form-group" id="UserField_Form" style="display:block">
                            <label for="mobileno" class="field_name">Mobile number</label>&nbsp;<label class="mandatory">*</label>
                            <div class="input-group">
                                <span class="input-group-addon " id="sizing-addon2">+91</span>
                                <input type="number" id="mobileno" onkeydown="return disableMobileNo(event,'mobileno');" class="form-control" name="mobileno" placeholder="Mobile number" required />
                            </div>
                            <br>
                            <button type="submit" name="GetOtpBTN" class="btn btn-success btn-block" id="GetOtpBTN" disabled> Get OTP</button>
                            <br>
                            <button class="btn btn-default btn-block" id="registeredUserBtn">Already registered ? Let's Sign In</button>
                        </div>
                        <div class="form-group" id="VerifyOTP_Form" style="display:none">
                            <label for="OTP_field" class="field_name">One Time Pin (OTP)</label>&nbsp;<label class="mandatory">*</label>
                            <input type="text" id="OTP_field" class="form-control" name="OTP_field" placeholder="Enter One Time Pin here" maxlength="6" required>
                            <h4 class="otp_msg">Check Your Phone.</h4>
                            <p class="otp_msg">OTP has been sent to your specified Mobile number.</p>
                            <a id="goBack" class="hyperlink" title="Go Back" data-toggle="tooltip"  data-placement="left">
                                <i class="fa fa-arrow-left"></i>
                            </a>&nbsp;&nbsp;
                            <a href="#" class="hyperlink">Resend OTP</a>
                            <br><br>
                            <button type="submit" name="VerifyOtpBTN" class="btn btn-success btn-block" id="VerifyOtpBTN" disabled> Verify OTP</button>
                            <br>
                            <button class="btn btn-default btn-block" id="registeredUserBtn2">Already registered ? Let's Sign In</button>
                        </div>

                        <div class="form-group" id="PasswordFields_Form" style="display:none">
                            <label for="new_password" class="field_name">Set Password</label>&nbsp;<label class="mandatory">*</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2">&nbsp;<i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;</span>
                                <input type="password" id="new_password" class="form-control" name="new_password" title="It should be min 6 & max 20 length contains number,alphabet and special symbol" placeholder="Enter Password here" data-toggle="tooltip"  data-placement="right"  required>
                            </div>
                            <br>
                            <label for="confirm_password" class="field_name">Confirm your  Password</label>&nbsp;<label class="mandatory">*</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="sizing-addon2">&nbsp;<i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;</span>
                                <input type="password" id="confirm_password" class="form-control" name="confirm_password" placeholder="Confirm Password" title="It should be min 6 & max 20 Cllength contains number,alphabet and special symbol" data-toggle="tooltip"  data-placement="right" required>
                            </div>
                            <br>
                            <span id="password_equal_msg"></span>
                            <br><br>
                            <button type="submit" id="lets_signup_btn" name="lets_signup_btn" class="btn btn-success btn-block" disabled> Let's get Started !</button>
                            <br>
                            <button class="btn btn-default btn-block" id="registeredUserBtn3">Already registered ? Let's Sign In</button>

                        </div>
                    </div>
                    <div class="col-md-6 SignInImage" id="SignInImage" style="display:block">
                        <span style="margin-right:5px;" id="large_modal_close1" class="close_sign"  data-dismiss="modal" id="large_modal_close">&times;</span>
                        <br>
                        <h2 class="SignIn_Up_Title">Sign In </h2>
                        <p class="modal_content">Please provide your Email / Mobile Number and Password to SignIn on Fashiostreet</p>
                        <img class="img-responsive"  src="{{ asset('assets/img/cloth_shops.png') }}">
                    </div>
                    <div class="col-md-6 SignUpImage" id="SignUpImage" style="display:none">
                        <span style="margin-right:5px;" id="large_modal_close2" class="close_sign"  data-dismiss="modal">&times;</span>
                        <br>
                        <h2 class="SignIn_Up_Title">Sign Up </h2>
                        <p class="modal_content">Please provide details to Sign Up on Fashiostreet</p>
                        <img class="img-responsive"  src="{{ asset('assets/img/cloth_shops.png') }}">
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!--Sign In & Sign Up Modal combine-->


<!-- **************************************______Footer______*********************************-->
<footer>
    <div class="container" style="padding-top: 25px">
        <div class="row">
            <div class="col-md-7" style="padding-top:30px">
                <div class="form-group" style="display: inline-block;">
                    <center>
                        <div class="footerLink_section">
                            <a class="footerlinks">About Us</a>
                        </div>
                        <div class="footerLink_section">
                            <a class="footerlinks">Sell On Fashiostreet</a>
                        </div>
                        <div class="footerLink_section">
                            <a class="footerlinks">Contact Us</a>

                        </div>
                        <div class="footerLink_section">
                            <a class="footerlinks">Listing Policy</a>
                        </div>
                    </center>
                </div>
                <br><br>
                <div class="form-group" style="display: inline-block;">
                    <center>
                        <div class="footerLink_section">
                            <a class="footerlinks">Help</a>
                        </div>
                        <div class="footerLink_section">
                            <a class="footerlinks">Privacy Policy</a>
                        </div>
                        <div class="footerLink_section">
                            <a class="footerlinks">Trust & Safety</a>
                        </div>
                        <div class="footerLink_section">
                            <a class="footerlinks">Terms of use</a>
                        </div>
                    </center>
                </div>
            </div>
            <div class="col-md-5" style="text-align: center">
                <h4 class="font_class">Follow Us On</h4>
                <a href="https://www.facebook.com/fashiostreet/" class="facebook" target="_blank">
                    <i class="fa fa-facebook-square" aria-hidden="true"></i>
                </a>&nbsp;
                <a href="https://twitter.com/Fashiostreet10/" class="twitter" target="_blank">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>&nbsp;
                <a href="https://www.instagram.com/fashiostreet10/" class="Insta" target="_blank">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>&nbsp;
                <a href="https://www.linkedin.com/company/fashiostreet/" class="linkedIn" target="_blank">
                    <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                </a>&nbsp;
                <a href="https://plus.google.com/u/0/105052627957777439787" class="google" target="_blank">
                    <i class="fa fa-google" aria-hidden="true"></i>
                </a>
                <a href="https://msg91.com/startups/?utm_source=startup-banner" target="_blank"  style="margin-top:-10px"><img src="https://msg91.com/images/startups/msg91Badge.png" id="msg91" width="70" height="50" title="MSG91 - SMS for Startups" alt="Bulk SMS - MSG91"></a>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <p class="text-center font_class" ><i class="fa fa-copyright" aria-hidden="true"></i>&nbsp;Copyright 2017  @  FashioStreet.&nbsp;&nbsp;All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<!-- **************************************______Footer______*********************************-->



<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<!-- <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script> -->
<!-- Core js bootstrap.min.js  -->
<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/CustomValidationScript.js') }}"></script>
<!-- Core css For material Design Lite -->

<!-- Script For Mobile Responsive Modal -->
<script type="text/javascript">

    function showModal(){
        var screenAvailWidth = screen.width;
        console.log(screenAvailWidth);
        if(screenAvailWidth>960)
        {
            jQuery('#SignInUpModal').modal();
        }
        else
        {
            jQuery('#SignInUpSmallModal').modal();
        }
    }


    // tooltip script statements
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<!-- Script For Mobile Responsive Modal -->


</body>
</html>