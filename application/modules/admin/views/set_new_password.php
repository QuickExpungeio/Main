<body class="login">
   <style>
      .errorcode {
         color: red;
         float: left;
         padding: 3% 0% 3% 1%;
      }
      .errorcode1{
         color: red;
         padding: 1% 52% 0% 0%;
      }
      .success{
         color: green;
         /* float: left; */
         padding: 0% 1% 0% 1%;
         font-size: 18px;
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
   </style>
   <div class="container">

      <div class="row">
         <div class="col-sm-8 col-sm-offset-2 text center" style="padding: 10px 0px;">
            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logowhite.png" alt="..." style="width:350px;"></a>
            <h3 style="color:#ffffff;">Erasing Criminal Records + Providing Second Chances</h3>
         </div>
      </div>

      <div class="row">
         <div class="col-sm-2">
         </div>

         <div class="col-sm-4">
            <div class="login_wrapper">
               <div class="animate form login_form">
                  <section class="login_content">
                     <div>
                     <span id="successmsg" class="success"></span>
                     </div>

                     <!-- <form action="<?php echo base_url("admin/forgotpassword/resetpassword/") . $this->uri->segment(4) ?>" method="post"> -->
                     <h4 class="left">SET NEW PASWORD</h4>
                     <div class="form-group newpassword">
                        <input name="newpassword" id="new-password" type="password" class="form-control" required placeholder="New Password">
                        <span toggle="#new-password" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                     </div>
                     <div class="form-group cpassword">
                        <input name="confirmpassword" id="cpassword" type="password" class="form-control" required placeholder="Retype New Password to Confirm">
                        <span toggle="#cpassword" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                     </div>
                     <div class="left">

                        <input type="hidden" name="email" id="userEmail" value="<?php echo $email ?>">
                        <input type="hidden" id="uriSeg" value="<?php echo $this->uri->segment(4) ?>">
                        <!-- <input class="btn btn-orange btn-lg" type="submit" placeholder="CHANGE PASSWORD" /> -->
                        <a href="javascript:void(0)" class="btn btn-orange btn-lg submitPassword">Submit</a>

                     </div>

                     <!-- </form> -->
                  </section>
               </div>
            </div>
         </div>

         <div class="col-sm-6">
         </div>
      </div>

      <div class="row">
         <div class="col-sm-2">
         </div>

         <!-- <div class="col-sm-4">
            <p style="color: #ffffff;">Your Password has been change, please login to access your account</p>
         </div> -->

         <div class="col-sm-6">
         </div>
      </div>

   </div>
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


         $(".submitPassword").click(function() {

            $("#cpassworderror ,#newpassworderror").remove();
            var newpassword = $("#new-password").val();
            var cpassword = $("#cpassword").val();
            var email = $("#userEmail").val();
            var uriSeg = $("#uriSeg").val();
            var Number_Regex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{12,30}$/;

            if (newpassword == "") {
               // $("#newpassworderror").remove();
               if (!$("#new-password").attr("disabled")) {
                  $(".newpassword").append('<span id="newpassworderror" class="errorcode">Enter Password</span>');
                  return false;
               }
            } else {
               // $("#newpassworderror").remove();
               if (Number_Regex.test($("#new-password").val()) === false) {
                  //$("#newpassworderror").remove();
                  $(".newpassword").append('<span id="newpassworderror" class="errorcode">Minimum 12 characters, at least one uppercase letter, one lowercase letter, one number and one special character </span>');
                  return false;
               }
            }

            if (cpassword == "") {
               if (!$("#cpassword").attr("disabled")) {

                  $(".cpassword").append('<span id="cpassworderror" class="errorcode1">Enter Confirm Password </span>');
                  return false;
               }
            }
            if (cpassword != "") {
               if (!$("#cpassword").attr("disabled")) {
                  if (cpassword != newpassword) {
                     // $("#cpassworderror").remove();
                     $(".cpassword").append('<span id="cpassworderror" class="errorcode">New password and confirm password must be same</span>');
                     return false;
                  }
               }
            } 
            
            $.ajax({
               beforeSend: function(data) {},
               complete: function() {},
               type: 'POST',
               url: '<?php echo base_url("admin/forgotpassword/resetpassword/"); ?>',
               data: ({
                  email: email,
                  confirmpassword:cpassword,
                  newpassword : newpassword,
                  uriSeg:uriSeg
               }),
               dataType: 'json',
               success: function(data) {
                   $("#new-password").val('');
                   $("#cpassword").val('');
                  $('#successmsg').text(data.message);
                  setTimeout(function() {
                     window.location.href = '<?php echo base_url('admin/login') ?>';
                        }, 4000);
                  
                  // alert(data.message);
                  console.log(data);
               },
               error: function() {}
            });


            //    if ($("#new-password").val() == "") {
            //       $("#newpassworderror").remove();
            //       if (!$("#new-password").attr("disabled")) {

            //          $(".new-password").append('<span id="newpassworderror" class="errorcode">Enter Password</span>');
            //          $("html,body").animate({
            //             scrollTop: 450
            //          }, 1000);
            //          return false;
            //       }

            //    } else {
            //       $("#newpassworderror").remove();
            //       var Number_Regex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{12,30}$/;
            //       if (Number_Regex.test($("#new-password").val()) === false) {

            //          $(".CreatePasswordApp").append('<span id="newpassworderror" class="errorcode">Minimum 12 characters, at least one uppercase letter, one lowercase letter, one number and one special character </span>');
            //          $("html,body").animate({
            //             scrollTop: 450
            //          }, 1000);
            //          return false;
            //       }
            //    }

            //    if ($("#cpassword").val() == "") {

            //       if (!$("#cpassword").attr("disabled")) {

            //          $(".ConfirmPasswordApp").append('<span id="cpassworderror" class="errorcode">Enter Confirm Password</span>');
            //          $("html,body").animate({
            //             scrollTop: 450
            //          }, 1000);
            //          return false;
            //       }
            //    } else {
            //       $("#cpassworderror").remove();
            //    }

            //    if ($("#cpassword").val() != "") {

            //       if (!$("#cpassword").attr("disabled")) {

            //          if ($("#cpassword").val() != $("#new-password").val()) {
            //             $(".ConfirmPasswordApp").append('<span id="cpassworderror" class="errorcode">New password and confirm password must be same</span>');
            //             $("html,body").animate({
            //                scrollTop: 450
            //             }, 1000);
            //             return false;
            //          } else {
            //             $("#cpassworderror").remove();
            //          }
            //       }
            //    } else {
            //       $("#cpassworderror").remove();
            //    }
            // }

            // $("#new-password").focusout(function() {

            //    var password = $(this).val();

            //    $("#newpassworderror").remove();
            //    var Number_Regex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{12,30}$/;
            //    if (Number_Regex.test($("#new-password").val()) === false) {
            //       $(".CreatePasswordApp").append('<span id="newpassworderror" class="errorcode">Minimum 12 characters, at least one uppercase letter, one lowercase letter, one number and one special character </span>');
            //       return false;
            //    }

            // });

            // $("#cpassword").focusout(function() {

            //    var cpassword = $(this).val();
            //    var password = $("#new-password").val();
            //    $("#cpassworderror").remove();

            //    if (cpassword != password) {
            //       $(".ConfirmPasswordApp").append('<span id="cpassworderror" class="errorcode">New password and confirm password must be same</span>');
            //       return false;
            //    } else {

            //       $("#cpassworderror").remove();
            //    }
            // });
         });
      });
   </script>

</body>