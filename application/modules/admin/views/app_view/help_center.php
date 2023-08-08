<!DOCTYPE html>
<html>
<style type="text/css">
    
</style>
<head>
    <!-- -------------- Meta and Title -------------- -->
    <meta charset="utf-8">
    <title>Jam With Jelly</title>
    <meta name="keywords" content="HTML5, Bootstrap 3, Admin Template, UI Theme"/>
    <meta name="description" content="Alliance - A Responsive HTML5 Admin UI Framework">
    <meta name="author" content="ThemeREX">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- -------------- Fonts -------------- -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700'>
    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,300italic,400italic,700,700italic' rel='stylesheet'
          type='text/css'>

    <!-- -------------- CSS - theme -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/skin/default_skin/css/theme.css">

    <!-- -------------- CSS - allcp forms -------------- -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/allcp/forms/css/forms.css">

    <!-- -------------- Favicon -------------- -->
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/img/fav.png">

    <!-- -------------- IE8 HTML5 support  -------------- -->
    <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="utility-page sb-l-c sb-r-c">
<style type="text/css">
    #content {
        padding: 40px 30px 50px 31px;
        background: white;
        color: black !important;
        width: 500px;
        margin: 50px auto;
        border-radius: 10px;
    }
    #content .panel {
       padding: 15px;
    }
    .panel {
        margin-bottom: 5px;
    }
    .panel-alert > .panel-heading > .panel-title {
        color: #666;
        padding-bottom: 25px !important;
    }
    p {
        margin: 0 0 10px;
        color: #999;
        font-weight: 500;
    }
    b {
        color: #777777;
    }
    .bg-alert {
        background-color: #00c1bf !important;
        color: #fff4d7;
    }
    .theme-warning i {
        color: #67d3e0;
        position: relative;
    }
    @media(max-width: 767px){
        #content {
            width: 100%;
        }
    }
</style>
<!-- -------------- Body Wrap  -------------- -->
<div id="mains" class="animated fadeIn">

    <!-- -------------- Main Wrapper -------------- -->
    <section id="content_wrapper">

        <div id="canvas-wrapper" style="background: #00c1bf;">
            <canvas id="demo-canvas"></canvas>
        </div>

        <!-- -------------- Content -------------- -->
        <section id="content" class="animated fadeIn">

            <div class="theme-warning" id="login">

                <div class="bg-alert text-center mb20 br3 pv15">
                    <img src="<?php echo base_url()?>assets/img/logo.png" alt=""/>
                </div>
                <div class="panel panel-alert" style="background: transparent; box-shadow: none !important; border: 0px;">
                    <div class="panel-heading pn">
                        <div class="panel-title text-center">CONTACT DETAILS</div>
                        <div>
                           <p><i class="fa fa-envelope-o"> </i> Email:  jellycustomerhelp@gmail.com</p>
                           <p><i class="fa fa-user"> </i> Customer Care:   2013053758</p>
                           <p><i class="fa fa-clock-o"> </i> Working Hours:   24 Hours</p>
                        </div>
                    </div>
                    
                </div>

            </div>

        </section>
        <!-- -------------- /Content -------------- -->

    </section>
    <!-- -------------- /Main Wrapper -------------- -->

</div>
<!-- -------------- /Body Wrap  -------------- -->

<!-- -------------- Scripts -------------- -->

<!-- -------------- jQuery -------------- -->
<script src="<?php echo base_url()?>assets/js/jquery/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url()?>assets/js/jquery/jquery_ui/jquery-ui.min.js"></script>

<!-- -------------- CanvasBG JS -------------- -->
<script src="<?php echo base_url()?>assets/js/plugins/canvasbg/canvasbg.js"></script>

<!-- -------------- Theme Scripts -------------- -->
<script src="<?php echo base_url()?>assets/js/utility/utility.js"></script>
<!-- <script src="<?php echo base_url()?>assets/js/demo/demo.js"></script> -->
<script src="<?php echo base_url()?>assets/js/main.js"></script>

</body>

</html>
