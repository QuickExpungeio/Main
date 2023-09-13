<html>

<head>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url("assets/images/fav.png"); ?>">

    <link rel="stylesheet" href="<?php echo base_url('assets/form/preloader.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/form/applicationForm.css'); ?>">
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/form/css/bootstrap3.4.1.min.css'); ?>"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link href="<?php echo base_url('assets/form/bootstrap@5.3.0.min.css'); ?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/form/bootstrap.bundle.min.js'); ?>"></script> -->
    <script src="<?php echo base_url('assets/form/js/jquery-3.5.1.min.js'); ?>"></script>
    <!-- <script src="<?php echo base_url('assets/form/js/bootstrap-3.4.1.min.js'); ?>"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

</head>
<style>
    .btn-block {
        display: block !important;
        width: 100% !important;
    }

    .field-icon {
        float: right;
        margin-left: -25px;
        margin-top: -24px;
        position: relative;
        z-index: 2;
        color: black;
        width: 2.5em !important;
    }

    .container {
        padding-top: 50px;
        margin: auto;
    }

    .input-group-addon {
        padding: 8px 12px;
        font-size: 17px;
        font-weight: 400;
        line-height: 1;
        color: #555;
        text-align: center;
        background-color: #eee;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* ::placeholder {
    color: grey !important;
    opacity: 1 !important; /* Firefox */


    */:-ms-input-placeholder {
        /* Internet Explorer 10-11 */
        color: grey !important;
    }

    ::-ms-input-placeholder {
        /* Microsoft Edge */
        color: grey !important;
    }
</style>
<?php
$monthList = ['Jan' => 'January', 'Feb' => 'February', 'Mar' => 'March', 'Apr' => 'April', 'May' => 'May', 'Jun' => 'June', 'Jul' => 'July', 'Aug' => 'August', 'Sep' => 'September', 'Oct' => 'October', 'Nov' => 'November', 'Dec' => 'December'];
?>

<body>

    <div id="gif" class="gif"></div>

    <section for="Header">
        <div style="background-color:black; width: 100%;">
            <div class="container">
                <div class="row">
                    <div class="col-3">
                    </div>
                    <div class="col-6">
                        <div class="imgcontainer">
                            <a href="<?php echo base_url(); ?>"> <img src="<?php echo base_url('assets/form/new/logo78.jpeg') ?>" alt="Avatar" class="avatar"></a>
                        </div>
                        <div style="text-align: center;margin: 1% 0 12px 0;">
                            <span class="erfont">Record Restricton Form</span>
                        </div>
                        <div style="text-align: center;margin: 1% 0 12px 0;">
                            <span class="yourOrder">Your Order</span>
                        </div>
                    </div>
                    <div class="col-3">
                    </div>
                </div>
            </div><!--Container-->
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-3">
                </div>
                <div class="col-6">
                    <div class="stepwizard">
                        <div class="stepwizard-row setup-panel">
                            <div class="stepwizard-step col-xs-3">
                                <div class="step1icon divForStep1Active">
                                    <i class="fa fa-file-text-o" style="padding: 34.4%"></i>
                                </div>
                                <span style="margin-right: 66%;font-size: smaller;">Form</span>
                            </div>
                            <div class="stepwizard-step col-xs-3">
                                <div class="step2icon divForStep">
                                    <i class="step2iconfa fa fa-bars reviewClass"></i>
                                </div>
                                <span style="margin-right: 66%;font-size: smaller;">Review</span>
                            </div>
                            <div class="stepwizard-step col-xs-3">
                                <div class="step3icon divForStep">
                                    <i class="step3iconfa fa fa-usd paymentClass"></i>
                                </div>
                                <span style="margin-right: 66%;font-size: smaller;">Payment</span>
                            </div>
                            <div class="stepwizard-step col-xs-3">
                                <div class="step4icon divForStep" style="margin-right: 18px;">
                                    <i class="step4iconfa fa fa-check paymentClass"></i>
                                </div>
                                <span style="margin-right: 66%;font-size: smaller;">Confirmed</span>
                            </div>
                        </div>
                    </div><!--stepwizard-->
                    <div class="col mt-2 text-center">
                        <hr class="mt-5">
                    </div>

                    <form action="<?php echo base_url("form/form/process") ?>" method="post" class="form-horizontal" id="regForm" enctype="multipart/form-data">

                        <section for="step 1" class="step1 <?php echo (isset($_SESSION['applicationID']) && !empty($_SESSION['applicationID'])) ? 'd-none' : '' ?> ">

                            <div class="col mt-2 qxtheme">
                                <p style="font-weight:600;">Expungement Form<?php ?></p>
                                <p class="lableTxt">Enter arrest information below to apply for restricton of charges from one court case. The system processes one court case per application.</p>
                            </div>
                            <div class="col mt-2">
                                <span class="qxtheme">
                                    <p class="lableTxt">
                                        Suffix
                                    </p>
                                </span>
                            </div>

                            <div class="col mt-2">
                                <select name="suffix" id="suffix" class="form-select">
                                    <!-- <option value="">Select Suffix</option> -->
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Miss">Miss</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col mt-3">
                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" autocomplete="off">
                                </div>
                                <div class="col mt-3">
                                    <input type="text" class="form-control" id="middlename" name="middlename" placeholder="Middle name">
                                </div>

                                <div class="col mt-3">
                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col mt-3">
                                <span class="qxtheme">
                                    <p class="lableTxt">
                                        Any other name that might be used on your record ?
                                    </p>
                                </span>
                            </div>
                            <div class="col mt-2">
                                <input type="text" class="form-control" id="other" name="other" placeholder="Other name that might be used">
                            </div>
                            <div class="col mt-3">
                                <span class="qxtheme">
                                    <p class="lableTxt">
                                        Date Of Birth
                                    </p>
                                </span>
                            </div>

                            <div class="row">

                                <div class="col">
                                    <select name="Bmonth" id="Bmonth" class="form-select">
                                        <option value="">Month</option>
                                        <?php if (!empty($monthList)) {
                                            foreach ($monthList as $key => $val) {
                                                echo '<option value="' . $key . '">' . $val . '</option>';
                                            }
                                        } ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="Bdate" id="Bdate" class="form-select">
                                        <option value="">Date</option>
                                        <?php for ($d = 1; $d < 32; $d++) {
                                            echo '<option value="' . $d . '">' . $d . '</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="Byear" id="Byear" class="form-select">
                                        <option value="">Year</option>
                                        <?php for ($d = (date('Y') - 90); $d < date('Y'); $d++) {
                                            echo '<option value="' . $d . '">' . $d . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col mt-3">
                                <span class="qxtheme">
                                    <p class="lableTxt">
                                        Race
                                    </p>
                                </span>
                            </div>
                            <div class="col">
                                <select name="race" id="race" class="form-select">
                                    <option value="">Select Race</option>
                                    <?php if (!empty($race)) {
                                        foreach ($race as $val) { ?>
                                            <option value="<?php echo $val->name ?>"><?php echo $val->name ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="col mt-3">
                                <span class="qxtheme">
                                    <p class="lableTxt">
                                        Gender
                                    </p>
                                </span>
                            </div>
                            <div class="col">
                                <select name="gender" id="gender" class="dselect form-select">
                                    <option value="">Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>


                            <div class="col mt-3">
                                <span class="qxtheme">
                                    <p class="lableTxt">
                                        Social Security Number
                                    </p>
                                </span>
                            </div>
                            <div class="col">
                                <input type="password" maxlength="9" class="form-control" id="ssn" placeholder="* * * - * * - * * * *" name="ssn">
                                <span toggle="#ssn" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                            </div>
                            <div class="col mt-3">
                                <span class="qxtheme">
                                    <p class="lableTxt">
                                        Phone
                                    </p>
                                </span>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control impn" id="phone" maxlength="10" name="phone" placeholder="(000)-000-0000">
                            </div>
                            <div class="col mt-3">
                                <span class="qxtheme">
                                    <p class="lableTxt">
                                        Email
                                    </p>
                                </span>
                            </div>
                            <div class="col">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off">
                            </div>
                            <div class="row send-otp-n-verify d-none">
                                <div class="col mt-2 divforotp">
                                    <a href="javascript:void(0)" class="btn btns btn-md btn-block" id="sendbtnotp">Send Account Verification Code</a>
                                </div>
                                <div class="col mt-2 otpDiv">
                                    <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter account verification code" autocomplete="off" maxlength="5">
                                </div>
                            </div>
                            <section for="for-password" class="password-section d-none">
                                <div class="col mt-3">
                                    <span class="qxtheme forPassword">
                                        <p class="lableTxt">
                                            Minimum 12 characters, at least one uppercase ,one lowercase letter, one number and one special character
                                        </p>
                                    </span>
                                </div>
                                <div class="col mt-2 forPassword CreatePasswordApp">
                                    <input type="password" class="form-control" id="new-password" name="new-password" placeholder="Create Password" autocomplete="off">
                                    <span toggle="#new-password" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                                </div>
                                <div class="col mt-2 forPassword ConfirmPasswordApp">
                                    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" autocomplete="off">
                                    <span toggle="#cpassword" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                                </div>
                            </section>
                            <div class="col mt-3">
                                <span class="qxtheme">
                                    <p class="lableTxt">
                                        Address 1
                                    </p>
                                </span>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="addressone" name="addressone" placeholder="Address 1">
                            </div>
                            <div class="col mt-3">
                                <span class="qxtheme">
                                    <p class="lableTxt">
                                        Address 2
                                    </p>
                                </span>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="addresstwo" name="addresstwo" placeholder="Address 2">
                            </div>
                            <div class="row">
                                <div class="col mt-3">
                                    <span class="qxtheme">
                                        <p class="lableTxt">
                                            Country
                                        </p>
                                    </span>
                                </div>
                                <div class="col mt-3">
                                    <span class="qxtheme">
                                        <p class="lableTxt">
                                            State
                                        </p>
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mt-1">
                                    <select name="country" id="country" class="form-select">
                                        <option value="">Country</option>
                                        <option value="USA">USA</option>

                                    </select>
                                </div>
                                <div class="col mt-1">
                                    <select name="state" id="state" class="form-select">
                                        <option value="">State</option>
                                        <?php if (!empty($state)) {
                                            foreach ($state as $val) { ?>
                                                <option value="<?php echo $val->name ?>"><?php echo $val->name ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-3">
                                    <span class="qxtheme">
                                        <p class="lableTxt">
                                            City
                                        </p>
                                    </span>
                                </div>
                                <div class="col mt-3">
                                    <span class="qxtheme">
                                        <p class="lableTxt">
                                            Post Code
                                        </p>
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col mt-1">
                                    <select name="city" id="city" class="form-select">
                                        <option value="">City</option>
                                        <?php if (!empty($city)) {
                                            foreach ($city as $val) { ?>
                                                <option value="<?php echo $val->name ?>"><?php echo $val->name ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="col mt-1">
                                    <input type="tel" class="form-control" id="postcode" name="postcode" placeholder="Post Code" autocomplete="off">
                                </div>
                            </div>
                            <div class="col mt-3">
                                <span class="qxtheme">
                                    <p class="lableTxt">
                                        Arresting Agency
                                    </p>
                                </span>
                            </div>
                            <div class="col">
                                <select name="agency" id="agency" class="form-select">
                                    <option value="">Select Arresting Agency</option>
                                    <?php if (!empty($agency)) {
                                        foreach ($agency as $val) { ?>
                                            <option value="<?php echo $val->name ?>"><?php echo $val->name ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="col mt-3">
                                <span class="qxtheme">
                                    <p class="lableTxt">Date of Arrest</p>
                                </span>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <select name="arrest_month" id="arrest_month" class="form-select">
                                        <option value="">Month</option>
                                        <?php if (!empty($monthList)) {
                                            foreach ($monthList as $key => $val) {
                                                echo '<option value="' . $key . '">' . $val . '</option>';
                                            }
                                        } ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="arrest_date" id="arrest_date" class="form-select">
                                        <option value="">Date</option>
                                        <?php for ($d = 1; $d < 32; $d++) {
                                            echo '<option value="' . $d . '">' . $d . '</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <select name="arrest_year" id="arrest_year" class="form-select">
                                        <option value="">Year</option>
                                        <?php for ($d = (date('Y') - 15); $d <= date('Y'); $d++) {
                                            echo '<option value="' . $d . '">' . $d . '</option>';
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mt-3">
                                    <span class=" qxtheme">
                                        <p class="lableTxt">Driver’s License Number</p>
                                    </span>
                                    <input type="text" class="form-control mt-2" maxlength="15" isvalid="1" placeholder="Driver’s License Number" name="license">
                                </div>

                                <div class="col-1 mt-3">
                                    <span class=" qxtheme">
                                        <p class="lableTxt"> &nbsp;</p>
                                    </span>
                                    <span class=" qxtheme">
                                        <p class="lableTxt" style="text-align: center;">OR</p>
                                    </span>
                                </div>

                                <div class="col-5 mt-3">
                                    <span class=" qxtheme">
                                        <p class="lableTxt">State Identification Number</p><span>
                                            <input type="text" class="form-control mt-2" isvalid="1" placeholder="State Identification Number" name="state_id_no">
                                </div>
                            </div>
                            <!-- <div class="title mt-4 text-center">Or</div> -->
                            <div class="col mt-3">
                                <span class="qxtheme">
                                    <p class="lableTxt">
                                        Issuing state
                                    </p>
                                </span>
                            </div>
                            <div class="col d-flax">
                                <select name="issuing_state" id="issuing_state" class="form-select">
                                    <option value="">Issuing State</option>
                                    <?php if (!empty($state)) {
                                        foreach ($state as $val) { ?>
                                            <option value="<?php echo $val->name ?>"><?php echo $val->name ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="col mt-3">
                                <span class="qxtheme">
                                    <p class="lableTxt">
                                        Case Number
                                    </p>
                                </span>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="case_no" maxlength="15" name="case_no" placeholder="Case number">
                            </div>
                            <div class="col mt-3">
                                <span class="qxtheme">
                                    <p class="lableTxt">
                                        Offense(s) Arrested For
                                    </p>
                                </span>
                            </div>
                            <div class="col">
                                <select name="offrncefor" id="offrncefor" class="form-select">
                                    <option value="">Offense Arrested For</option>
                                    <?php if (!empty($offence)) {
                                        foreach ($offence as $val) { ?>
                                            <option value="<?php echo $val->short_description ?>"><?php echo $val->short_description ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="col mt-4 userIdImgValueDiv" style="text-align:center">
                                <img src="<?php echo base_url('assets/form/new/placeholder1.png') ?>" id="userIdImg" style="width: 54%;" alt="">
                            </div>
                            <div class="col mt-4 form-group">
                                <input type="file" id="upload" name="upload" hidden style="display: none" />
                                <label for="upload" class="btn btn-lg btn-block btns">
                                    <span style="font-size:smaller">Upload Your ID</span>
                                    <span><i class="fa fa-upload" aria-hidden="true"></i></span>
                                </label>
                            </div>
                            <div class="col mt-4 qxtheme">
                                You will receive an email to the email address provided once your application is received. The District Attorney's Office will contact you once your application is processed or if additional information is needed.

                            </div>

                            <!-- <div class="col mt-2">
                                <label class="radio-inline qxtheme">
                                    <input type="radio" name="optradio" value="sendmail" checked>&nbsp;Email
                                </label>
                                <label class="radio-inline qxtheme">
                                    <input type="radio" value="sendtext" name="optradio">&nbsp;Text Message
                                </label>
                            </div> -->
                            <!-- <div class="row">
                                <div class="col-lg-11" style="margin-left: 2%;">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="contactemail" name="contactemail" placeholder="Email Address">
                                    </div>
                                </div>
                                </div> -->
                            <div class="col mt-4">
                                <span class="qxtheme">
                                    <p style="font-weight:600;">Please ensure all information above is correct<br>before submitting form.
                                    </p>
                                </span>
                            </div>
                            <div class="col mt-4 secOne">
                                <a href="javascript:void(0)" class="btn btn-block btn-lg btns">Continue</a>
                            </div>
                        </section>

                        <section for="step 2" class="step2 d-none">
                            <div class="col mt-2 qxtheme">
                                <h4>Confirm Your Expungement Form</h4><br>
                            </div>
                            <div class="row">
                                <div class="col mt-2 lableTxt">Arresting Date:</div>
                                <div class="col mt-2 lableTxt text-start"><span class="ArrestingDatePre"></span></div>
                            </div>
                            <div class="row">
                                <div class="col mt-2 lableTxt ">Charge:</div>
                                <div class="col mt-2 lableTxt text-start"><span class="ChargePre"><strong>$199</strong></span></div>
                            </div>
                            <div class="row">
                                <div class="col mt-2 lableTxt">Arresting Agency:</div>
                                <div class="col mt-2 lableTxt text-start"><span class="ArrestingAgencyPre"></span></div>
                            </div>

                            <!-- <div class="col mt-2 qxtheme">
                                <h4>Confirm Your Address</h4><br>
                            </div> -->
                            <div class="row">
                                <div class="col mt-2 lableTxt">First Name:</div>
                                <div class="col mt-2 lableTxt text-start"><span class="FirstNamePre"></span></div>
                            </div>
                            <div class="row">
                                <div class="col mt-2 lableTxt">Last Name:</div>
                                <div class="col mt-2 lableTxt text-start"><span class="LastNamePre"></span></div>
                            </div>
                            <div class="row">
                                <div class="col mt-2 lableTxt">Address:</div>
                                <div class="col mt-2 lableTxt text-start"><span class="AddressPre"></span></div>
                            </div>
                            <div class="row">
                                <div class="col mt-2 lableTxt">City/State/Zip:</div>
                                <div class="col mt-2 lableTxt text-start"><span class="CityStateZipPre"></span></div>
                            </div>
                            <div class="row">
                                <div class="col mt-2 lableTxt">Phone Number:</div>
                                <div class="col mt-2 lableTxt text-start"><span class="PhoneNoPre"></span></div>
                            </div>

                            <div class="row">
                                <div class="col mt-2 qxtheme">
                                    <h5>Amount Due</h5>
                                </div>
                                <div class="col mt-2 qxtheme">
                                    <h5>$ 199</h5>
                                </div>
                                <hr style="border: 1px solid #a3a1a1;width: 93%;">
                            </div>

                            <!-- <div class="row">
                                <div class="col mt-2 secTwoBack">
                                    <a href="javascript:void(0)" class="btn btn-block btn-md bg-dark text-white">Previous</a>
                                </div>
                                <div class="col mt-2 secTwo">
                                     <a href="javascript:void(0)" class="btn btn-block btn-md btns">Continue</a>
                                    <input type="submit" class="btn btn-block btn-md btns submitForm" Value="Continue" />
                                </div>
                                 <div class="col mt-2 secThree" style="text-align:center">
                                    <input type="submit" class="btn btn-block btn-md btns submitForm" Value="Continue" />
                                </div> 
                            </div> -->
                            <div class="row">
                                <div class="col mt-2 secTwoBack">
                                    <a href="javascript:void(0)" class="btn btn-block btn-md bg-dark text-white">Previous</a>
                                </div>
                                <div class="col mt-2 secTwo">
                                    <a href="javascript:void(0)" class="btn btn-block btn-md btns">Continue</a>
                                </div>
                            </div>

                        </section>

                        <section for="step 3" class="step3 d-none">
                            <div class="col mt-2 qxtheme">
                                <p style="font-weight:600;">Payment</p>
                            </div>

                            <div class="col mt-2">
                                <img src="<?php echo base_url('assets/form/new/payment.png') ?>" alt="" style="width:43%">
                            </div>

                            <div class="col mt-2 qxtheme">
                                <p style="font-weight:600;">Card Information</p>
                            </div>
                            <div class="col mt-2">
                                <input type="text" class="form-control" id="nameoncard" name="nameoncard" placeholder="Name On Card">
                            </div>
                            <div class="col mt-2">
                                <input type="tel" class="form-control" maxlength="18" id="cardnumber" name="cardnumber" placeholder="Card Number">
                            </div>

                            <div class="row">
                                <div class="col mt-2">
                                    <input type="month" class="form-control" id="expDate" name="expDate" placeholder="Exp Date">
                                </div>
                                <div class="col mt-2">
                                    <input type="tel" class="form-control" id="cvv" maxlength="3" name="cvv" placeholder="CVV">
                                </div>
                            </div>

                            <div class="col mt-2">
                                <input type="tel" class="form-control" id="zipcode" name="zipcode" placeholder="Zip Code">
                            </div>

                            <div class="row">
                                <div class="col mt-2 secThreeBack" style="text-align:center">
                                    <a href="javascript:void(0)" class="btn btn-block btn-md" style="background-color:black;color:white">Previous</a>
                                </div>
                                <div class="col mt-2 secThree" style="text-align:center">
                                    <input type="submit" class="btn btn-block btn-md btns submitForm" Value="Continue" />
                                </div>
                            </div>

                        </section>

                        <section for="step 4" class="step4 text-center <?php echo (isset($_SESSION['applicationID']) || !empty($_SESSION['applicationID'])) ? 'aaaa' : 'd-none' ?>">
                            <div class="col mt-2">
                                <img src="<?php echo base_url('assets/form/new/Oval-9.png') ?>" alt="">
                            </div>
                            <div class="col mt-2 qxtheme">
                                <h1>Thank You</h1>
                            </div>
                            <div class="col mt-2 qxtheme">
                                <p>Your application has been successfully submitted</p>
                            </div>
                            <div class="col mt-2 qxtheme">
                                <p>We will now consider your ENTIRE record for possible restricton</p>
                            </div>

                            <div class="col mt-2 qxtheme">
                                <p>You do not need to resubmit the application if you have additional charges.</p>
                            </div>
                            <div class="col mt-2 qxtheme">
                                <p>Thank you in advance for your patience</p>
                            </div>
                            <div class="col mt-2 qxtheme">
                                <p>For further communication, <a href="<?php echo base_url('admin/login') ?>"> Click here </a></p>
                            </div>
                            <div class="col mt-2 qxtheme" id="thanklast">
                                <p>For log-in,please use your registered E-mail and password which you have generated</p>
                            </div>
                            <?php if (isset($_SESSION['applicationID'])) { ?>
                                <div class="col mt-2 qxtheme">
                                    <p>Your application id is <strong><?php echo $_SESSION['applicationID']; ?></strong></p>
                                </div>
                            <?php } ?>

                            <div class="col mt-2">
                                <a href="<?php echo base_url() ?>" class="btn btn-block btn-lg btns">Finish</a>
                            </div>

                        </section>
                    </form>
                </div>
                <div class="col-3">
                </div>
            </div>
        </div>
    </section>

    <section for="Footer">
        <div class="mt-5 p-4 bg-dark text-end">
            <div class="col mt-2 pe-5">
                <a class="p-2" href="https://play.google.com/store/apps/details?id=app.quick.expunge" style="color:white"> <img src="<?php echo base_url('assets/form/new/Icon material-android.png') ?>"></a>
                <a class="p-2" href="https://play.google.com/store/apps/details?id=app.quick.expunge" style="color:white;"><img src="<?php echo base_url('assets/form/new/Icon ionic-logo-apple.png') ?>"></a>
                <a class="p-2" href="https://www.instagram.com/quickexpunge/?utm_medium=copy_link"><img src="<?php echo base_url('assets/form/new/Icon awesome-instagram.png') ?>"></a>

            </div>
            <div class="col mt-5 pe-5">
                <label style="color:#ff7d3f;"> <a href="<?php echo base_url("admin/terms") ?>" style="color:#ff7d3f;">Terms & Conditions</a> &nbsp;&nbsp; <a href="<?php echo base_url("admin/policy") ?>" style="color:#ff7d3f;">Privacy Policy</a> &nbsp;&nbsp; Disclaimer</label>
            </div>


    </section>

    <script type="text/javascript">
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $(document).ready(function() {

            //         $('.impn').inputmask('999-99-9999');
            // $('.imcn').inputmask('999-999-9999');
            // $('.zipc').inputmask('99999');

            $(".secOne").click(function() {
                $(".errorcode").remove();

                if ($("#suffix").val() == "") {
                    $("#suffix").parent().append('<span id="suffixerror" class="errorcode">Select Suffix</span>');
                    $("html,body").animate({
                        scrollTop: 100
                    }, 1000);
                    return false;
                } else {
                    $("#suffixerror").remove();
                }

                if ($("#firstname").val() == "") {
                    $("#firstname").parent().append('<span id="fnameerror" class="errorcode">Enter first name</span>');
                    $("html,body").animate({
                        scrollTop: 200
                    }, 1000);
                    return false;
                } else {
                    $("#fnameerror").remove();
                }
                if ($("#lastname").val() == "") {
                    $("#lastname").parent().append('<span id="lnameerror" class="errorcode">Enter last name</span>');
                    $("html,body").animate({
                        scrollTop: 200
                    }, 1000);
                    return false;
                } else {
                    $("#lnameerror").remove();
                }
                if ($("#race").val() == "") {
                    $("#race").parent().append('<span id="raceerror" class="errorcode">Select Race</span>');
                    $("html,body").animate({
                        scrollTop: 600
                    }, 1000);
                    return false;
                } else {
                    $("#raceerror").remove();
                }
                if ($("#gender").val() == "") {
                    $("#gender").parent().append('<span id="gendererror" class="errorcode">Select Gender</span>');
                    $("html,body").animate({
                        scrollTop: 600
                    }, 1000);
                    return false;
                } else {
                    $("#gendererror").remove();
                }
                if ($("#email").val() == "") {
                    $("#email").parent().append('<span id="emailerror" class="errorcode">Enter email address</span>');
                    $("html,body").animate({
                        scrollTop: 400
                    }, 1000);
                    return false;
                } else {
                    $("#emailerror").remove();
                }


                var isemailexistornot = $(".addIsEmailValid").attr("isemailexistornot");
                if (isemailexistornot == 0) {
                    $(".divforotp").append('<span id="sendOtpVerifyEmailerror" class="errorcode">Please verify your email</span>');
                    $("html,body").animate({
                        scrollTop: 400
                    }, 1000);
                    return false;
                }


                // -------------------------------------------------------------------------------------
                if (!$(".password-section").hasClass("d-none")) {


                    if ($("#new-password").val() == "") {
                        $("#newpassworderror").remove();
                        if (!$("#new-password").attr("disabled")) {

                            $(".CreatePasswordApp").append('<span id="newpassworderror" class="errorcode">Enter Password</span>');
                            $("html,body").animate({
                                scrollTop: 450
                            }, 1000);
                            return false;
                        }

                    } else {
                        $("#newpassworderror").remove();
                        var Number_Regex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{12,30}$/;
                        if (Number_Regex.test($("#new-password").val()) === false) {

                            $(".CreatePasswordApp").append('<span id="newpassworderror" class="errorcode">Minimum 12 characters, at least one uppercase letter, one lowercase letter, one number and one special character </span>');
                            $("html,body").animate({
                                scrollTop: 450
                            }, 1000);
                            return false;
                        }
                    }

                    if ($("#cpassword").val() == "") {

                        if (!$("#cpassword").attr("disabled")) {

                            $(".ConfirmPasswordApp").append('<span id="cpassworderror" class="errorcode">Enter Confirm Password</span>');
                            $("html,body").animate({
                                scrollTop: 450
                            }, 1000);
                            return false;
                        }
                    } else {
                        $("#cpassworderror").remove();
                    }

                    if ($("#cpassword").val() != "") {

                        if (!$("#cpassword").attr("disabled")) {

                            if ($("#cpassword").val() != $("#new-password").val()) {
                                $(".ConfirmPasswordApp").append('<span id="cpassworderror" class="errorcode">New password and confirm password must be same</span>');
                                $("html,body").animate({
                                    scrollTop: 450
                                }, 1000);
                                return false;
                            } else {
                                $("#cpassworderror").remove();
                            }
                        }
                    } else {
                        $("#cpassworderror").remove();
                    }
                }



                if ($("#state").val() == "") {
                    $("#state").parent().append('<span id="staterror" class="errorcode">Select State</span>');
                    $("html,body").animate({
                        scrollTop: 500
                    }, 1000);
                    return false;
                } else {
                    $("#staterror").remove();
                }
                if ($("#city").val() == "") {
                    $("#city").parent().append('<span id="cityerror" class="errorcode">Select City</span>');
                    $("html,body").animate({
                        scrollTop: 550
                    }, 1000);
                    return false;
                } else {
                    $("#cityerror").remove();
                }
                if ($("#agency").val() == "") {
                    $("#agency").parent().append('<span id="agencyerror" class="errorcode">Select Agency</span>');
                    $("html,body").animate({
                        scrollTop: 630
                    }, 1000);
                    return false;
                } else {
                    $("#agencyerror").remove();
                }
                if ($("#issuing_state").val() == "") {
                    $("#issuing_state").parent().append('<span id="issuing_staterror" class="errorcode">Select Issuing State</span>');
                    $("html,body").animate({
                        scrollTop: 500
                    }, 1000);
                    return false;
                } else {
                    $("#issuing_staterror").remove();
                }
                if ($("#offrncefor").val() == "") {
                    $("#offrncefor").parent().append('<span id="offrnceforerror" class="errorcode">Select Offense(s) Arrested</span>');
                    $("html,body").animate({
                        scrollTop: 700
                    }, 1000);
                    return false;
                } else {
                    $("#offrnceforerror").remove();
                }



                $(".step1").addClass("d-none");
                $(".step2").removeClass("d-none");
                $(".step2icon").removeClass("divForStep");
                $(".step2iconfa").removeClass("reviewClass");
                $(".step2iconfa").addClass("reviewClassActive");
                $(".step2icon").addClass("divForStepActive");
                $(".step1icon").removeClass("divForStep1Active");
                $(".step1icon").addClass("divForStep1");

                var address = "";
                if ($("#addresstwo").val().length > 0) {
                    address = $("#addressone").val() + "," + $("#addresstwo").val();
                } else {
                    address = $("#addressone").val() + " " + $("#addresstwo").val();
                }

                var cityStateZipe = $("#city").val() + " / " + $("#state").val() + " / " + $("#postcode").val();
                var agency = $("#agency").val();
                var phone = $("#phone").val();
                var arrestDate = $("#arrest_date").val();
                var arrestMonth = $("#arrest_month").val();
                var arrestYear = $("#arrest_year").val();

                let FullDate = arrestMonth + ' / ' + arrestDate + ' / ' + arrestYear;
                $(".FirstNamePre").html($("#firstname").val());
                $(".LastNamePre").html($("#lastname").val());
                $(".AddressPre").html(address);
                $(".CityStateZipPre").html(cityStateZipe);
                $(".ArrestingAgencyPre").html(agency);
                $(".PhoneNoPre").html(phone);
                $(".ArrestingDatePre").html(FullDate);


                $("html, body").animate({
                    scrollTop: 0
                }, 1000);
            });
            $(".secTwo").click(function() {

                $(".step2").addClass("d-none");
                $(".step3").removeClass("d-none");

                $(".step3icon").addClass("divForStepActive");
                $(".step3icon").removeClass("divForStep");
                $(".step3iconfa").addClass("paymentClassActive");
                $(".step3iconfa").removeClass("paymentClass");

                $(".step2icon").removeClass("divForStepActive");
                $(".step2icon").addClass("divForStep");
                $(".step2iconfa").removeClass("reviewClassActive");
                $(".step2iconfa").addClass("reviewClass");
                $("html, body").animate({
                    scrollTop: 100
                }, 1000);

            });

            $(".secThreeBack").click(function() {

                $(".step3").addClass("d-none");
                $(".step2").removeClass("d-none");

                $(".step3iconfa").removeClass("paymentClassActive");
                $(".step3iconfa").addClass("paymentClass");

                $(".step3icon").addClass("divForStep");
                $(".step3icon").removeClass("divForStepActive");

                $(".step2iconfa").addClass("reviewClassActive");
                $(".step2iconfa").removeClass("reviewClass");

                $(".step2icon").removeClass("divForStep");
                $(".step2icon").addClass("divForStepActive");
                $("html, body").animate({
                    scrollTop: 0
                }, 1000);

            });
            $(".secTwoBack").click(function() {

                $(".step2").addClass("d-none");
                $(".step1").removeClass("d-none");

                $(".step2iconfa").removeClass("reviewClassActive");
                $(".step2iconfa").addClass("reviewClass");

                $(".step2icon").addClass("divForStep");
                $(".step2icon").removeClass("divForStepActive");

                $(".step1icon").removeClass("divForStep1");
                $(".step1icon").addClass("divForStep1Active");
                $("html, body").animate({
                    scrollTop: 0
                }, 1000);

            });

            $("#upload").change(function() {
                readURL(this);
            });

            function readURL(input) {

                var reader = new FileReader();
                if (input.files && input.files[0]) {


                    var file_name = input.files[0].name;

                    fileExtension = file_name.replace(/^.*\./, '');
                    // console.log(fileExtension);die;

                    if (input.files[0].type == "application/pdf") {

                        let fileName = input.files[0].name;
                        $(".userIdImgValueDiv").html('<i class="fa fa-file-pdf-o" style="font-size:35px" aria-hidden="true"> ' + fileName + ' </i>');

                    } else if (input.files[0].type == "application/msword") {
                        let fileName = input.files[0].name;
                        $(".userIdImgValueDiv").html('<i class="fa fa-file-word-o" style="font-size:35px" aria-hidden="true"> ' + fileName + ' </i>');

                    } else if (fileExtension == "docx") {
                        let fileName = input.files[0].name;
                        $(".userIdImgValueDiv").html('<i class="fa fa-file-word-o" style="font-size:35px" aria-hidden="true"> ' + fileName + ' </i>');

                    } else if (!$('#userIdImg').length) {

                        //$(".userIdImgValueDiv").html('<img src="" id="userIdImg" style="width: 54%;" alt="No Image">');
                        //var reader = new FileReader();
                        reader.onload = function(e) {
                            // console.log("ddd");
                            // console.log(e.target.result);
                            $(".userIdImgValueDiv").html('<img src="' + e.target.result + '" id="userIdImg" style="width: 54%;" alt="No Image">');

                        }
                        reader.readAsDataURL(input.files[0]);
                    } else {

                        reader.onload = function(e) {
                            $('#userIdImg').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            }
            $("#new-password").focusout(function() {

                var password = $(this).val();

                $("#newpassworderror").remove();
                var Number_Regex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{12,30}$/;
                if (Number_Regex.test($("#new-password").val()) === false) {
                    $(".CreatePasswordApp").append('<span id="newpassworderror" class="errorcode">Minimum 12 characters, at least one uppercase letter, one lowercase letter, one number and one special character </span>');
                    return false;
                }

            });

            $("#cpassword").focusout(function() {

                var cpassword = $(this).val();
                var password = $("#new-password").val();
                $("#cpassworderror").remove();

                if (cpassword != password) {
                    $(".ConfirmPasswordApp").append('<span id="cpassworderror" class="errorcode">New password and confirm password must be same</span>');
                    return false;
                } else {

                    $("#cpassworderror").remove();
                }
            });

            $("#email").focusout(function() {
                $("#emailerror").remove();
                var email = $(this).val();

                if (email == "") {
                    $("#email").parent().append('<span id="emailerror" class="errorcode">Enter email address</span>');
                    $("html,body").animate({
                        scrollTop: 400
                    }, 1000);
                    return false;
                } else {
                    $("#emailerror").remove();
                    var validRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

                    if (validRegex.test($("#email").val()) === false) {
                        $("#email").parent().append('<span id="emailerror" class="errorcode">Enter valid email address</span>');
                        return false;
                    }
                }


                $.ajax({
                    beforeSend: function(data) {
                        $("#gif").show();
                    },
                    complete: function() {
                        $("#gif").hide();
                    },
                    type: 'POST',
                    url: '<?php echo base_url("form/form/isemailexist"); ?>',
                    data: {
                        'email': email
                    },
                    dataType: 'json',
                    success: function(result) {
                        $(".addIsEmailValid").remove();
                        if (result.code == 200) {

                            $(".send-otp-n-verify").addClass("d-none");
                            let addIsEmailValid = '<input type="hidden" name="addIsEmailValid" class="addIsEmailValid" isEmailExistOrNot="1" isOtpVerify="1">';
                            $("#regForm").append(addIsEmailValid);

                        } else if (result.code == 201) {

                            $(".send-otp-n-verify").removeClass("d-none");
                            let addIsEmailValid = '<input type="hidden" name="addIsEmailValid" class="addIsEmailValid" isEmailExistOrNot="0" isOtpVerify="0">';
                            $("#regForm").append(addIsEmailValid);


                        } else {
                            $("#email").parent().append('<span id="emailerror" class="errorcode">' + result.message + '</span>');

                            return false;
                        }
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.statusText);
                        console.log(textStatus);
                        console.log(error);
                    }
                });



            });

            $("#cp-ic-show").click(function() {

                if ($("#crp-ic-close").hasClass("glyphicon-eye-close")) {

                    $("#crp-ic-close").removeClass("glyphicon-eye-close");
                    $("#crp-ic-close").addClass("glyphicon-eye-open");
                    $("#new-password").attr('type', 'text');

                } else {

                    $("#crp-ic-close").addClass("glyphicon-eye-close");
                    $("#crp-ic-close").removeClass("glyphicon-eye-open");
                    $("#new-password").attr('type', 'password');
                }

            });
            $("#con-ic-show").click(function() {

                if ($("#cp-ic-close").hasClass("glyphicon-eye-close")) {

                    $("#cp-ic-close").removeClass("glyphicon-eye-close");
                    $("#cp-ic-close").addClass("glyphicon-eye-open");
                    $("#cpassword").attr('type', 'text');

                } else {

                    $("#cp-ic-close").addClass("glyphicon-eye-close");
                    $("#cp-ic-close").removeClass("glyphicon-eye-open");
                    $("#cpassword").attr('type', 'password');
                }

            });

            $("#sendbtnotp").click(function() {

                var email = $("#email").val();

                $.ajax({
                    beforeSend: function(data) {
                        //disabled="disabled"
                        $("#sendbtnotp").attr("disabled", "disabled");
                    },
                    complete: function() {
                        $("#sendbtnotp").removeAttr("disabled", "disabled");
                        $(".divforotp").html("");
                        $(".divforotp").html('<a href="javascript:void(0)" class="btn btns btn-md btn-block" id="verifyotp">Verify</a>');
                    },
                    type: 'POST',
                    url: '<?php echo base_url("form/form/sendotp"); ?>',
                    data: ({
                        email: email
                    }),
                    dataType: "json",
                    success: function(data) {
                        //do here on success
                    },
                    error: function() {
                        //do here on error
                    }
                });

            });

        });
        $("#otp").focusout(function() {
            verifyOTP();
        })
        $(document).on('click', "#verifyotp", function() {
            verifyOTP();
        });


        function verifyOTP() {

            $("#otpDiv ,#sendOtpVerifyEmailerror").remove();
            var otp = $("#otp").val();
            var email = $("#email").val();
            if (otp == "" || otp == 'undefine') {
                $(".otpDiv").append('<span id="otpDiv" class="errorcode">Enter Code</span>');
                return false;
            } else {

                $.ajax({
                    beforeSend: function(data) {},
                    complete: function() {},
                    type: 'POST',
                    url: '<?php echo base_url("form/form/verifyotp"); ?>',
                    data: ({
                        email: email,
                        otp: otp
                    }),
                    dataType: 'json',
                    success: function(data) {
                        if (data.code == 200) {
                            $("#otpDiv ,#sendOtpVerifyEmailerror").remove();
                            $(".password-section").removeClass("d-none");
                            $(".send-otp-n-verify").html("");
                            let html = '<div class="col mt-2"><div class="form-group"><a href="javascript:void(0)" class="btn btn-success btn-md btn-block" style="pointer-events: none;">Your email verified successfully</a></div></div>';
                            $(".send-otp-n-verify").html(html);
                            $(".addIsEmailValid").attr("isOtpVerify", "1");
                            $("#email").attr("disabled", "disabled");
                            let addIsEmailValid = '<input type="hidden" name="emailNew" value="' + email + '">';
                            $("#regForm").append(addIsEmailValid);
                            $(".addIsEmailValid").attr("isemailexistornot", "1");
                            $(".addIsEmailValid").attr("isOtpVerify", "1");
                        } else {
                            $("#otpDiv ,#sendOtpVerifyEmailerror").remove();
                            $(".otpDiv").append('<span id="otpDiv" class="errorcode">Invalid Code</span>');
                            return false;
                        }
                    },
                    error: function() {}
                });

            }
        }

        $("#regForm").on('submit', function() {
            $("#gif").show();
        });


        $(document).ready(function() {

            $(window).keydown(function(event) {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            var sess = "<?php echo isset($_SESSION['applicationID']) ? $_SESSION['applicationID'] : 0; ?>";
            "<?php unset($_SESSION['applicationID']) ?>";
            if (sess != 0) {

                $(".step3").addClass("d-none");
                $(".step4").removeClass("d-none");
                $(".step1icon").removeClass("divForStep1Active");
                $(".step1icon").addClass("divForStep1");

                $(".step4icon").addClass("divForStepActive");
                $(".step4icon").removeClass("divForStep");
                $(".step4iconfa").addClass("paymentClassActive");
                $(".step4iconfa").removeClass("paymentClass");

                $(".step3icon").removeClass("divForStepActive");
                $(".step3icon").addClass("divForStep");
                $(".step3iconfa").removeClass("reviewClassActive");
                $(".step3iconfa").addClass("reviewClass");

                $("html, body").animate({
                    scrollTop: 100
                }, 1000);
            }
        });
    </script>

</body>

</html>