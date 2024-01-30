<!DOCTYPE html>
<html>
<link rel="icon" type="image/x-icon" href="<?php echo base_url("assets/images/fav.png"); ?>">

<link rel="stylesheet" href="<?php echo base_url('assets/form/preloader.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/form/applicationForm.css'); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url('assets/form/js/jquery-3.5.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/form/js/bootstrap-3.4.1.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="<?php echo base_url("assets/build/gtag.js"); ?>"></script>

<style>
   /*set border to the form*/


   /*assign full width inputs*/


   /*set a style for the buttons #ff9d6f*/

   .btn-orange {
      background-color: #FF7D3F;
      color: #ffffff;
      text-transform: uppercase;
      font-size: 12px;
      border-radius: 4px;
   }

   .loginbtn {
      background-color: white;
      color: #ff9d6f;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
      border-radius: 2px;
   }

   .signupbtn {
      background-color: #ff9d6f;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
      border-radius: 2px;
   }

   /* set a hover effect for the button*/

   /* button:hover {
        opacity: 0.8;
    } */
   /*set extra style for the cancel button*/

   .imgcontainer {
      text-align: center;
      margin: 3% 0 12px 0;
   }

   /*set image properties*/

   img.avatar {
      width: 50%;
   }

   .erfont {
      text-align: center;
      color: white;
      font-size: 23px;
   }

   /* sm */
   @media (min-width: 768px) {
      .loginbtn {
         background-color: white;
         color: #ff9d6f;
         padding: 9px 20px;
         margin: 8px 0;
         border: none;
         cursor: pointer;
         width: 75%;
         border-radius: 2px;
      }

      .signupbtn {
         background-color: #ff9d6f;
         color: white;
         padding: 9px 20px;
         margin: 8px 0;
         border: none;
         cursor: pointer;
         width: 75%;
         border-radius: 2px;
      }
   }

   /* width */
   ::-webkit-scrollbar {
      width: 5px;
   }

   /* Track */
   ::-webkit-scrollbar-track {
      background: #f1f1f1;
   }

   /* Handle */
   ::-webkit-scrollbar-thumb {
      background: #bec4c4;
   }

   /* Handle on hover */
   ::-webkit-scrollbar-thumb:hover {
      background: #555;
   }

   /* md */
   @media (min-width: 992px) {}

   /* lg */
   @media (min-width: 1200px) {}

   /*set styles for span and cancel button on small screens*/

   /* @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
            margin-top: 2%;
            margin-bottom: 5%;
        }
    } */
   .btn-white {
      background-color: #ffffff;
      color: #FF7D3F;
      text-transform: uppercase;
      font-size: 12px;
      border-radius: 4px;
   }

   .number {
      border: 5px solid #000000;
      border-radius: 50%;
      height: 70px;
      width: 70px;
      text-align: center;
      line-height: 60px;
      color: #FF7D3F;
      font-size: 30px;
      font-weight: 600;

   }

   .fa {
      font-size: 70px;
      color: #FF7D3F;
      margin: 30px 0px;
   }
</style>

<body style="background-color:#ffffff; width: 100%;">
   <div style="background-color: #000000;">
      <div class="container">
         <div class="row">
            <!-- <div class="col-md-2">

                </div> -->
            <div class="col-md-offset-2 col-md-8">
               <div class="imgcontainer">
                  <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/images/logowhite.png') ?>" alt="Avatar" class="avatar"></a>
               </div>
            </div>
         </div>
      </div>

   </div>

   <div class="container">
      <div class="row">
         <div class="col-md-2">
         </div>
         <div class="col-md-8">

            <div class="col mt-2 qxtheme">
               <!-- <h3 style="font-weight:600;">Contact Us Form<?php ?></h3> -->
            </div>
            <?php echo validation_errors(); ?>
            <?php echo form_open('form/contact_us/process'); ?>
            <div class="row">
               <span class="qxtheme">
                  <h5 class="lableTxt"><b style="font-size: 15px;">
                         Email</b>
                  </h5>
               </span>
               <div class="col">
                  <input type="email" required class="form-control" id="email" style="height: 45px;" name="email" placeholder="Enter Email" autocomplete="off" value="<?php echo set_value('email'); ?>">
               </div>
            </div>
            <div class="row">
               <span class="qxtheme">
                  <h5 class="lableTxt">
                     <b style="font-size: 15px;">Message</b>
                  </h5>
               </span>
               <div class="col">
                  <textarea class="form-control txtarea" rows="10" required column="11"  cols="160" id="comment" name="comment" placeholder="Enter Message" value="<?php echo set_value('comment'); ?>"></textarea>
               </div>
            </div>
            <div class="col mt-5">
               <input type="submit" class="btn btn-lg btns"  onclick="return confirm('Are you sure?')" value="Submit">
            </div>
            <?php echo form_close(); ?>
         </div>
         <div class="col-md-2">
         </div>
         <!-- </form> -->
      </div>
   </div>
   <section for="Footer" style="position: fixed;
    width: 100%;    bottom: 0px;">
        <div class="mt-5 p-4 bg-dark text-end">
            <div class="col mt-2 pe-5">
                <a class="p-2" href="https://play.google.com/store/apps/details?id=app.quick.expunge" style="color:white"> <img src="<?php echo base_url('assets/form/new/Icon material-android.png') ?>"></a>
                <a class="p-2" href="https://play.google.com/store/apps/details?id=app.quick.expunge" style="color:white;"><img src="<?php echo base_url('assets/form/new/Icon ionic-logo-apple.png') ?>"></a>
                <a class="p-2" href="https://www.instagram.com/quickexpunge/?utm_medium=copy_link"><img src="<?php echo base_url('assets/form/new/Icon awesome-instagram.png') ?>"></a>

            </div>
            <div class="col mt-5 pe-5">
                <label style="color:#ff7d3f;"> <a href="<?php echo base_url("admin/terms") ?>" style="color:#ff7d3f;">Terms & Conditions</a> &nbsp;&nbsp; <a href="<?php echo base_url("admin/policy") ?>" style="color:#ff7d3f;">Privacy Policy</a> &nbsp;&nbsp; Disclaimer</label>
            </div>

            </div>
    </section>

</body>

</html>