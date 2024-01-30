<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Quick Expunge</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/fav.png">
    <link href="<?php echo base_url();?>assets/form/form.css" rel="stylesheet">

</head>

<body style="background: #2A3F54 !important;">
    <div id="main">
        <section id="content_wrapper">
            <section id="content" class="animated fadeIn">
                <div class="text-center">
                    <!-- <img src="<?php //echo base_url('assets/images/logopage.png')?>" alt="Logo" width="275" height="100"> -->
                </div>
                <!-- <div class="panel-heading pn">
                    <h3 class="tcolr">Quick Expunge</h3>
                </div> -->
                <?php echo form_open(base_url('form/form/process'),array('method'=>'post','autocomplete'=>'off','id'=>'regForm','enctype'=>'multipart/form-data'));?>
                <h5 class="tcolr"><b>Record Restriction Form</b></h5>
                <?php if(!empty($this->session->flashdata('error'))){?>
                <div class="alert alert-danger" role="alert">
                    <?php echo  $this->session->flashdata('error')?>
                </div>
                <?php } elseif(!empty($this->session->flashdata('success'))){ ?>
                <div class="alert alert-success" role="alert">
                    <?php echo  $this->session->flashdata('success')?>
                </div>
                <?php } ?>
                <div class="tab">

                    <div class="title mt-4"><b>Suffix</b></div>
                    <p>
                        <select name="suffix" class="dselect">
                            <option value="">Suffix</option>
                            <option value="Mr">Mr</option>
                            <option value="Mrs">Mrs</option>
                            <option value="Miss">Miss</option>
                        </select>
                    </p>

                    <div class="title mt-4"><b>First Name</b></div>
                    <p>
                        <input type="text" id="fname" placeholder="First Name" isvalid="1" oninput="this.className = ''"
                            name="firstname">
                    </p>

                    <div class="title mt-4"><b>Middle Name</b></div>
                    <p>
                        <input type="text" placeholder="Middle Name (Optional)" isvalid="0" name="middlename">
                    </p>

                    <div class="title mt-4"><b>Last Name</b></div>
                    <p>
                        <input type="text" id="lname" placeholder="Last Name" isvalid="1" oninput="this.className = ''"
                            name="lastname">
                    </p>

                    <div class="title mt-4"><b>Any other name that might be used on your record</b></div>
                    <p>
                        <input type="text" placeholder="Other Name" isvalid="0" name="any_other_name">
                    </p>

                    <div class="title mt-4"><b>Date Of Birth</b></div>
                    <p>

                        <select class="select ddlMonths" name="bmonth">
                            <option value="">Month</option>
                        </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <select class="select ddlDate" name="bdate">
                            <option value="">Day</option>
                        </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <select class="select ddlYears" name="byear">
                            <option value="">Year</option>
                        </select>
                    </p>

                    <div class="title mt-4"><b>Race</b></div>
                    <p>
                        <select name="race" class="dselect">
                            <option value="">Race</option>
                            <?php if(!empty($race)){ foreach ($race as $value) {?>
                            <option value="<?php echo $value->name ?>"><?php echo $value->name ?></option>
                            <?php } }?>
                        </select>
                    </p>

                    <div class="title mt-4"><b>Gender</b></div>
                    <p>
                        <select name="gender" class="dselect">
                            <option value="">Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </p>

                    <div class="title mt-4"><b>Social Security Number</b></div>
                    <p>
                        <input type="password" maxlength="9" isvalid="1" placeholder="* * * - * * - * * * *"
                            oninput="this.className = ''" name="ssn">
                    </p>

                    <div class="title mt-4"><b>Email</b> <small>( Your registered email address )</small></div>
                    <p>
                        <input type="email" placeholder="Email" isvalid="1" oninput="this.className = ''" name="email">
                    </p>

                    <div class="title mt-4"><b>Phone Number</b></div>
                    <p>
                        <input type="text" oninput="this.className = ''" isvalid="1" class="imcn" id="phoneno"
                            placeholder="(000)-000-0000" name="phone_no">
                    </p>

                    <div class="title mt-4"><b>Street Address</b></div>
                    <p>
                        <input type="text" id="address" placeholder="Street Address" isvalid="1"
                            oninput="this.className = ''" name="address">
                    </p>

                    <div class="title mt-4"><b>City</b></div>
                    <p>
                        <input type="text" id="city" placeholder="City" isvalid="1" oninput="this.className = ''"
                            name="city">
                    </p>

                    <div class="title mt-4"><b>State</b></div>
                    <p>
                        <select name="state" class="dselect" id="state">
                            <option value="">State</option>
                            <?php if(!empty($state)){
                                    foreach ($state as $value) {?>
                            <option value="<?php echo $value->name ?>"><?php echo $value->name ?></option>
                            <?php } }?>
                        </select>
                    </p>

                    <div class="title mt-4"><b>Zip Code</b></div>
                    <p>
                        <input type="text" class="zipc" maxlength="5" isvalid="1" id="zipcode" placeholder="Zip Code"
                            oninput="this.className = ''" name="zipcode">
                    </p>

                    <div class="title mt-4"><b>Agency</b></div>
                    <p>
                        <select name="arresting_agency" class="dselect" id="agency">
                            <option value="">Agency</option>
                            <?php if(!empty($agency)){
                                    foreach ($agency as $value) {?>
                            <option value="<?php echo $value->name ?>"><?php echo $value->name ?></option>
                            <?php } }?>
                        </select>
                    </p>

                    <div class="title mt-4"><b>Date Of Arrest</b></div>
                    <p>

                    <select class="select ddlMonths" id="moa" name="arrest_month">
                            <option value="">Month</option>
                        </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <select class="select ddlDate" id="doa" name="arrest_date">
                            <option value="">Day</option>
                        </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <select class="select ddlYears" id="yoa" name="arrest_year">
                            <option value="">Year</option>
                        </select>
                    </p>

                    <div class="title mt-4"><b>Driving License Number</b></div>
                    <p>
                        <input type="text" maxlength="15" isvalid="1" placeholder="Driving License Number"
                            oninput="this.className = ''" name="license"></p>

                    <div class="title mt-4"><b>Case Number</b></div>
                    <p>
                        <input type="text" maxlength="15" placeholder="Case Number (Optional)" isvalid="0"
                            oninput="this.className = ''" name="case_no">
                    </p>

                    <div class="title mt-4"><b>Offense(s) Arrested For</b></div>
                    <p>
                        <select name="offense_attested" class="dselect" id="oaf">
                            <option value="">Offense</option>
                            <?php if(!empty($offence)){
                                    foreach ($offence as $value) {?>
                            <option style="font-size:13px" value="<?php echo $value->short_description ?>">
                                <?php echo $value->short_description ?></option>
                            <?php } }?>
                        </select>
                    </p>
                    <p>
                        <div class="title mt-4"><b>Upload Your ID</b></div>
                        <div class="custom-file">
                            <p>
                                <input type="file" id="file" class="custom-file-input" name="verification_id">
                                <label class="custom-file-label" for="exampleInputFile">Upload Your ID</label>
                                <small class="text-danger">Accept only jpg || jpeg || pdf || png || gif format</small>
                            </p>
                        </div>
                    </p>

                    <p>
                        <div class="custom-file">
                            <p class="imgeClass d-none">
                                <img id="imgPreview" src="#" class="img-thumbnail" height="25%" width="25%" style="margin-bottom:7%" />
                            </p>

                        </div>
                    </p>
                    <p>
                        <div class="title"><b>How would you like Quick Expunge to update you about your
                                application ?</b></div>
                        <div class="title">Additional information may be needed to process your application . please indicate
                                below how you would like to be contact. </div>
                    </p>
                    <p>
                        <!-- <label class="checkbox-inline"> -->
                            <input class="wzero" type="checkbox" value="sendmail"> Email
                        <!-- </label> -->
                        <!-- <label class="checkbox-inline"> -->
                            <input class="wzero" type="checkbox"  class="ml-5" value="sendtext"> Text Message
                        <!-- </label> -->
                    </p>
                    <p class="title">Please ensure that all information above is correct before submitting form.</p>
                </div> <!-- TAB 1 -->

                <div class="tab">
                    <p>
                        <table style="width:100%">
                            <tr>
                                <td>Arrest Date</td>
                                <td class="dad"></td>
                            </tr>
                            <tr>
                                <td>Charge</td>
                                <td class="chg"></td>
                            </tr>
                            <tr>
                                <td> Arresting Agency</td>
                                <td class="aagcy"></td>
                            </tr>
                        </table>
                        <hr>
                        Confirm your address

                        <table style="width:100%">
                            <tr>
                                <td>Name</td>
                                <td class="flname"></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td class="adr"></td>
                            </tr>
                            <tr>
                                <td>City/State/Zip</td>
                                <td class="csz"></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td class="phn"></td>
                            </tr>
                        </table>
                    </p>
                </div>

                <div style="overflow:auto;">
                    <div style="float:right;">
                        <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                        <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                    </div>
                </div>
                <!-- Circles which indicates the steps of the form: -->
                <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                </div>
                </form>
            </section>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script src="<?php echo base_url();?>assets/form/form.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function(){
            $('INPUT[type="file"]').change(function () {
                var ext = this.value.match(/\.(.+)$/)[1];
                switch (ext) {
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'gif':
                    case 'pdf':

                        $('#prevBtn').attr('disabled', false);
                        const file = this.files[0];
                        if (file) {
                            let reader = new FileReader();
                            reader.onload = function (event) {
                                $("#imgPreview").attr("src", event.target.result);
                                $(".imgeClass").removeClass("d-none");

                            };
                        reader.readAsDataURL(file);
                        }
                        break;
                    default:
                        alert('This is not an allowed file type.');
                        this.value = '';
                }
            });
        });
    </script>

</body>

</html>