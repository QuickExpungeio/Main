<body class="login">
   <div class="container">

      <div class="row">
         <div class="col-sm-8 col-sm-offset-2 text center" style="padding: 10px 0px;">
            <a href="<?php echo base_url(); ?>"> <img src="<?php echo base_url(); ?>assets/images/logowhite.png" alt="..." style="width:350px;"></a>
            <h3 style="color:#ffffff;">Erasing Criminal Records + Providing Second Chances</h3>
         </div>
      </div>

      <div class="row">
         <div class="col-sm-2">
         </div>
         <div class="col-sm-4">
            <div class="login_wrapper">
               <div class="animate form login_form">
                  <section>
                     <?php if (!empty($this->session->flashdata('success'))) {
                        echo '<p style="color:green;font-size:larger">' . $this->session->flashdata("success") . '</p>';
                     } else {
                        echo '<p style="color:red;font-size:larger">' . $this->session->flashdata("error") . '</p>';
                     } ?>

                  </section>
                  <section class="login_content">
                     <form action="<?php echo  base_url("admin/forgotpassword/processtoreset") ?>" method="post">
                        <!-- <h4 class="left">RESET YOUR PASSWORD</h4> -->
                        <div class="form-group">
                           <input name="email" type="email" class="form-control" required placeholder="Email Address">
                        </div>
                        <div class="left">
                           <input class="btn btn-orange btn-lg" type="submit" />
                        </div>
                     </form>
                  </section>
               </div>
            </div>
         </div>

         <div class="col-sm-6">
         </div>
      </div>

   </div>
</body>