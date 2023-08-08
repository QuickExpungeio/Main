<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
   <div style="background-color: #000000; ">
      <div class="container">
         <div class="row">
            <!-- <div class="col-md-2">

                </div> -->
            <div class="col-md-offset-2 col-md-8">
               <div class="imgcontainer">
               <a href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/images/logowhite.png') ?>" alt="Avatar" class="avatar"></a>
               </div>
            </div>
            <div class="col-md-2">
               <div class="text-right" style="z-index:1000; margin-top:30px;">
                  <a href="<?php echo base_url('admin/login') ?>" class="btn btn-white btn-lg" title="Login" style="padding-right: 40px;padding-left: 40px;">
                     LOGIN
                  </a>
                  <!-- <a href="<?php echo base_url('form/form/page') ?>" title="Go to Form">
                            <img src="<?php echo base_url('assets/images/Icon awesome-wpforms.png') ?>" style="width:2%;margin-right: 0%;">
                        </a> -->
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-4 col-md-offset-4 text-center">
               <p style="color:#ffffff;">
                  Quick Expunge is a legal service that allows users to expedite the necessary forms needed to get applicable charges removed from their criminal record in a quicker timeframe than normal.
               </p>
               <div style="margin: 60px 0 60px 0;">
                  <a href="<?php echo base_url('form/form/page') ?>" class="btn btn-orange btn-lg" title="Login">
                     CLICK HERE TO BEGIN
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="row">
         <div style="margin-top:50px;">
            <h4 class="text-center x_title" style="font-weight:bold;">EXPEDITE THE RECORD EXPUNGE PROCESS</h4>
         </div>
      </div>

      <div class="row" style="margin-top: 5%;">
         <div class="col-md-6 col-md-offset-3">
            <div class="col-md-2">
               <p class="number">
                  1
               </p>
            </div>
            <div class="col-md-10">
               <h3 style="margin-top:0px; font-weight: 600;">Log in</h3>
               <p>Create an account and log in to our expungement website to access personalized services. Gain secure access to your application, track its progress, and receive important updates conveniently from your dashboard.</p>
            </div>
         </div>
      </div>
      <div class="row" style="margin-top: 5%;">
         <div class="col-md-6 col-md-offset-3">
            <div class="col-md-2">
               <p class="number">
                  2
               </p>
            </div>
            <div class="col-md-10">
               <h3 style="margin-top:0px; font-weight: 600;">Submit Application</h3>

               <p>Easily complete and submit your expungement application through our user-friendly platform. Provide necessary details about your case, charges, and relevant documentation. Our intuitive interface ensures a smooth and streamlined process, saving you time and effort.</p>
            </div>
         </div>
      </div>
      <div class="row" style="margin-top: 5%;">
         <div class="col-md-6 col-md-offset-3">
            <div class="col-md-2">
               <p class="number">
                  3
               </p>
            </div>
            <div class="col-md-10">
               <h3 style="margin-top:0px; font-weight: 600;">We take care of the rest</h3>

               <p>Once you've submitted your expungement application, our experienced team takes charge. We handle all the necessary legal procedures, paperwork, and communication with the appropriate authorities. Sit back and relax as we navigate the complexities of the expungement process on your behalf, striving for the best possible outcome.</p>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6 col-md-offset-3 text-center">
            <div style="margin: 60px 0 60px 0;">
               <a href="<?php echo base_url('form/form/page') ?>" class="btn btn-orange btn-lg" title="Login">
                  CLICK HERE TO BEGIN
               </a>
            </div>
         </div>
      </div>

   </div>
   <div style="background-color: #000000;">
      <div class="container">
         <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
               <div style="margin-top:50px;">
                  <h4 class="text-center x_title" style="font-weight:bold; color: white;">DOWNLOAD QUICK EXPUNGE APP</h4>
               </div>
               <p style="color:#ffffff;">
                  Complete, Manage and View your applications straight from your mobile device! Get the app today!
               </p>
            </div>
         </div>
         <div class="row" style="margin-bottom:50px">
            <div class="col-md-4"></div>
            <div class="col-md-2 text-center">
               <a href="https://play.google.com/store/apps/details?id=app.quick.expunge" style="color:white">
                  <i class="fa fa-android"></i>
                  <br>
                  Download on Play Store</a>

            </div>
            <div class="col-md-2 text-center">
               <a href="https://play.google.com/store/apps/details?id=app.quick.expunge" style="color:white;">
                  <i class="fa fa-apple"></i>
                  <br>
                  Download on App Store</a>

            </div>
            <div class="col-md-4"></div>
         </div>

      </div>
      <div style="background-color: #272727;">
         <div class="container">
            <div class="row" style="margin-top: 2%; margin-bottom: 1%;">
               <div class="col-md-4 col-lg-4 col-xs-4"></div>
               <div class="col-md-4 col-lg-4 col-sm-6 col-xs-4 text-center">
                  <p style="color:#ff7d3f;">Copyright 2022</p>

               </div>
               <div class="col-md-4 col-lg-4 col-sm-6 col-xs-4" style="text-align: right;">
                  <a href="<?php echo base_url("admin/terms") ?>" style="color:#ff7d3f;">Terms & Conditions</a> &nbsp;&nbsp;
                  <a href="<?php echo base_url("admin/policy") ?>" style="color:#ff7d3f;">Privacy Policy</a> &nbsp;&nbsp;
                  <a href="#" style="color:#ff7d3f;">Disclaimer</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</body>

</html>