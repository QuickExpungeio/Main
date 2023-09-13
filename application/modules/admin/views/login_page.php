<style>
   .field-icon {
      float: right;
      margin-left: -25px;
      margin-top: -43px;
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

<body class="login">
   <div class="container">
      <div class="row">
         <div class="col-sm-8 col-sm-offset-2 text center" style="padding: 10px 0px;">
            <a href="<?php echo base_url(); ?>"> <img src="<?php echo base_url(); ?>assets/images/logowhite.png" alt="..." style="width:350px;"></a>
            <h3 style="color:#ffffff;padding-top: 10px;">Erasing Criminal Records + Providing Second Chances</h3>
         </div>
      </div>
      <div class="row">

         <div class="col-md-12 col-sm-12 col-xs-12 text center">
            <div class="login_wrapper">
               <div class="animate form login_form">
                  <?php

                  if (!empty($this->session->flashdata('flash_data'))) {
                     echo '<p style="color:red;font-size:larger">' . $this->session->flashdata("flash_data") . '</p>';
                  }
                  if (!empty($this->session->flashdata('success'))) {
                     echo '<p style="color:green;font-size:larger">' . $this->session->flashdata("success") . '</p>';
                  }
                  ?>

                  <section class="login_content">
                     <?php echo form_open('admin/login');    ?>
                     <h4 class="left">LOGIN</h4>

                     <div class="form-group">
                        <input name="email" type="text" class="form-control" required placeholder="Email" value="<?php echo isset($remember_user[0]) ? $remember_user[0] : '' ?>">
                     </div>
                     <div class="form-group">
                        <input type="password" name="password" id="password-field" class="form-control" required placeholder="Password" value="<?php echo isset($remember_user[1]) ? $remember_user[1] : '' ?>">
                        <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                     </div>

                     <?php
                     if (isset($remember_user[0]) && !empty($remember_user[0])) {
                        $checked = "checked";
                     } else {
                        $checked = "";
                     }
                     ?>


                     <div><input class="btn btn-orange btn-lg" type="submit" value="Login" /></div>
                     </form>
                     <div class="left">
                        <a href="<?php echo base_url("admin/forgotpassword"); ?>" style="color: #ffffff;">Forgot your login information?</a>
                     </div>


                  </section>
               </div>
            </div>
         </div>

      </div>
   </div>
   <script>
      
      $(".toggle-password").click(function() {

         $(this).toggleClass("fa-eye fa-eye-slash");
         var input = $($(this).attr("toggle"));
         if (input.attr("type") == "password") {
            input.attr("type", "text");
         } else {
            input.attr("type", "password");
         }
      });
   </script>

</body>