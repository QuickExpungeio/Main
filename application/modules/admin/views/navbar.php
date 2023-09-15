<div class="row">
  <div class="center" style="padding: 10px 0px;position: fixed;width: 100%;z-index: 1;background-color: #000000;">
    <img src="<?php echo base_url(); ?>assets/images/logowhite.png" alt="..." style="width:350px;margin-left: 120px;">
    <a href="<?php echo site_url(); ?>admin/user/user/logout" class="btn btn-orange btn-lg" style="float: right;margin-top: 25px;background-color: #FFFFFF;COLOR: #FF7D3F;">Log Out</a>
  </div>
</div>

<div class="col-md-3 left_col">
  <div class="left_col scroll-view">
    <!--  <div class="navbar nav_title" style="border: 0;">
      <a class="site_title"><span>Quick Expunge</span></a>
    </div> -->

    <div class="clearfix"></div>
    <!-- menu profile quick info -->
    <div class="profile clearfix" style="margin-top: 33px;">
      <div class="profile_pic">
        <img src="<?php echo base_url(); ?>assets/images/pic-1.png" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info" style="margin-top: 5px;">
        <h2>Admin</h2>
      </div>
    </div>
    <!-- /menu profile quick info -->

    <!-- <br> -->

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section active">
        <!-- <h3>General</h3> -->
        <ul class="nav side-menu" style="margin-top: 0px;">
          <!-- <li class=""><a href="<?php echo base_url(); ?>admin/user/user"><i class="fa fa-home"></i> Home </li> -->

          <li class="" style="text-align: center; background: #FF7D3F;"><a href="<?php echo base_url(); ?>admin/applications" style="padding: 30px 0px;">
              <i class="fa fa-home" style="font-size:52px; width: 50px; padding: 0px; margin-bottom: 0px; color: #ffffff;"></i> <br> Home </a></li>
          <li class="" style="text-align: center; background: #000000;"><a href="<?php echo site_url(); ?>admin/settings" style="margin-bottom: 0px; padding: 30px 0px;"> <i class="fa fa-cog" style="font-size:52px; width: 50px; padding: 0px; margin-bottom: 0px;"></i> <br>Settings </a></li>
          <!-- <li class="" style="text-align: center; background: #000000;"><a href="<?php echo site_url(); ?>admin/applications/export" style="margin-bottom: 0px; padding: 30px 0px;"> <i class="fa fa-cloud-download"></i> <br>Export CSV </a></li> -->
        </ul>
      </div>
    </div>
    <!-- /sidebar menu -->

  </div>
</div>
<div class="top_nav">
  <div class="nav_menu" style="margin-top: 8.5%;">
    <!-- <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            Admin
            <i class="fa fa-angle-down" aria-hidden="true"></i>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">

            <li><a href="<?php echo site_url(); ?>admin/user/user/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>


      </ul>
    </nav> -->
  </div>
</div>