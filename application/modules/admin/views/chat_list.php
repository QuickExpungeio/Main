<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/form/preloader.css'); ?>">

<link rel="stylesheet" href="<?php echo base_url('assets/build/css/adminChatList.css'); ?>">
<style>
   .sticky {
      top: 676px;
      bottom: 0;
      position: sticky;
      overflow-y: scroll;
      overflow-x: hidden;
   }

   .d-none {
      display: none;
   }

   .btn-warning {
      background: #FF7D3F !important;
      font-size: smaller;
   }
</style>
<div id="gif" class="gif"></div>
<div id="gif_chat" class="gif_chat"></div>
<div class="right_col" role="main">
<button type="button" class="btn btn-xs" style="background:#FF7D3F;color:white" id="back">Back</button>
   <div class="clearfix"></div>
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <!-- <div class="x_title">
               <h2> <?php echo $userName ?></h2>
               <div class="clearfix"></div>
            </div> -->

            <div class="x_content">
               <div class="col-md-12">
                  <div class="direct-chat-messages" id="ChatMessages" style="height: 400px">

                  </div>
               </div>
            </div>

         </div>
      </div>

   </div>
   <div class="row "><!-- sticky-->
      <div class="col-md-12 col-sm-12 col-xs-12"  style="z-index: 0 !important;">
         <div class="x_panel">
            <div class="input-group">
               <input type="text" id="sendMessage" class="form-control" placeholder="Message" style="height:90px">
               <div class="input-group-btn">
                  <form enctype="multipart/form-data" id="uploadForm" method="post" class="form-horizontal">
                     <input type="hidden" name="userData" id="userData" value="<?php echo $userId; ?>" />
                     <input type="hidden" name="applicationId" id="applicationId" value="<?php echo $applicationId; ?>" />
                  </form>


                  <input type="file" id="upload" name="upload" class="uploadFileClass" hidden style="display: none" />
                  <a href="javascript:void(0)" class="btn btn-default themeOrangeColor uKey" title="Select File" style="height:90px">
                     <i class="glyphicon glyphicon-cloud-upload" style="padding-top:18px;font-size:33px"></i>
                  </a>
                  <a href="javascript:void(0)" class="btn btn-default themeOrangeColor spr d-none" title="Please Wait" style="height:90px">
                     <i class="fa fa-refresh fa-spin" style="margin-top:73%;font-size:33px"></i>
                  </a>
                  <a href="javascript:void(0)" class="btn btn-default themeOrangeColor uploadFile d-none"  title=" Click to upload file" style="height:90px">
                     <i class="glyphicon glyphicon glyphicon-saved" style="padding-top:18px;font-size:33px"></i>
                  </a>
                  <a href="javascript:void(0)" class="btn btn-default themeOrangeColor sendtoUser " style="height:90px">
                     <i class="glyphicon glyphicon-send" style="padding-top:18px;font-size:33px"></i>
                  </a>

                  <!--  <a href="javascript:void(0)" class="btn btn-default uKey" style="height:90px">
                     <i class="glyphicon glyphicon-cloud-upload" style="padding-top:18px;font-size:33px"></i>
                  </a>
                     <a href="javascript:void(0)" class="btn btn-default sendtoUser " style="min-height:60px;min-width:80px;padding:22%">
                        <i class="glyphicon glyphicon-send"></i>
                     </a> -->
               </div>
            </div>
         </div>
      </div>
   </div>


   <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12">
         <div class="x_panel">
            <div class="x_title">
               <h5><b>All documents related to this application</b></h5>
               <div class="clearfix"></div>
            </div>

            <div class="x_content">
               <div class="col-md-12">
                  <div class="direct-chat-messages">
                     <table class="table table-striped table-border table-responsive">
                        <thead>
                           <tr>
                              <th>Document Name</th>
                              <th>Document Received</th>
                              <th>Download</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if (!empty($attachments)) {
                              foreach ($attachments as $val) {
                                 $name = explode("/", $val->attachment);
                                 $imageName = end($name);
                           ?>
                                 <tr>
                                 <td><a href="<?php echo $val->attachment; ?>" target="_blank"><?php echo $imageName; ?></a></td>
                                    <td><?php echo $val->time; ?></td>
                                    <td><a href="<?php echo $val->attachment; ?>" class="btn btn-lg btn-warning" download>Download</a></td>
                                 </tr>
                              <?php }
                           } else { ?>
                           <?php } ?>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>

         </div>

      </div>
   </div>

</div>
<script type="text/javascript">
  
   $("#gif").show();

   function hideLoader() {
      $('#gif').hide();
   }
   $(window).ready(hideLoader);

   // Strongly recommended: Hide loader after 20 seconds, even if the page hasn't finished loading
   setTimeout(hideLoader,1000000);

   $('.uKey').click(function(e) {
      $('.uploadFileClass').trigger('click');
   });
   $("#upload").change(function() {
      $(".uKey").addClass('d-none');
      $(".uploadFile").removeClass('d-none');
   });
   var fileNameForValidate = "";
   $(document).ready(function(){
        $('input[type="file"]').change(function(e){
             fileNameForValidate = e.target.files[0].name;
        });
    });

   $(".uploadFile").click(function() {

      $(".uKey ,.uploadFile").addClass('d-none');
      $(".spr").removeClass('d-none');

      var format = /[`!@#$%^&*+\=\[\]{};':"\\|,<>\/?~]/;
      if (format.test(fileNameForValidate)) {
         alert('SUSPICIOUS FILE NAME. PLEASE RENAME THE FILE AND UPLOAD AGAIN.');
         $(".spr").addClass('d-none');
         $(".uKey").removeClass('d-none');
         location.reload();
         return false;
 
      }
      $(".uKey ,.uploadFile").addClass('d-none');
      $(".spr").removeClass('d-none');

      var form = $("#uploadForm");
      var formData = new FormData(form[0]);
      formData.append('file', $('input[type=file]')[0].files[0]);
      $('#gif_chat').show();
      $.ajax({
         beforeSend: function() {},
         type: "POST",
         data: formData,
         cache: false,
         contentType: false,
         processData: false,
         url: '<?php echo base_url("admin/chat/uploaddoc"); ?>',
         dataType: 'json',
         success: function(result) {

            if (result.code == 200) {
               $('#ChatMessages').append(result.message);
               $('#gif_chat').hide();
               $("#sendMessage").val('');
               $(".direct-chat-text-img").last()[0].scrollIntoView({
                  behavior: 'smooth'
               });
            }else if(result.code == 400){
               alert(result.message);
               $('#gif_chat').hide();
            }

            $(".uploadFile ,.spr").addClass('d-none');
            $(".uKey").removeClass('d-none');
         },
         error: function(xhr, textStatus, error) {
            $(".uploadFile ,.spr").addClass('d-none');
            $(".uKey").removeClass('d-none');
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
         },
         complete: function() {}

      });

   });

   $('#sendMessage').keypress(function(e) {
      var key = e.which;
      if (key == 13) {

         var message = $(this).val();
         var userId = "<?php echo $userId; ?>";
         var applicationId = "<?php echo $applicationId; ?>";
         chatRequest(message, userId, applicationId);
      }
   });

   $('.sendtoUser').click(function(e) {
      var message = $("#sendMessage").val();
      var userId = "<?php echo $userId; ?>";
      var applicationId = "<?php echo $applicationId; ?>";
      chatRequest(message, userId, applicationId);
      return false;

   });

   function chatRequest(message, userId, applicationId) {

      $.ajax({
         type: 'POST',
         url: '<?php echo base_url("admin/chat/insert"); ?>',
         data: {
            'ckedit': message,
            'userId': userId,
            'applicationId': applicationId
         },
         dataType: 'json',
         success: function(result) {

            if (result.code == 200) {

               $('#ChatMessages').append(result.message);
               $("#sendMessage").val('');
               $(".direct-chat-text").last()[0].scrollIntoView({
                  behavior: 'smooth'
               });
            }
         },
         error: function(xhr, textStatus, error) {
            console.log(xhr.statusText);
            console.log(textStatus);
            console.log(error);
         }
      });
   }

   $(document).ready(function() {

      var applicationId = '<?php echo $applicationId; ?>';
      var userId = '<?php echo $userId; ?>';

      getChatData(applicationId, userId, 1);

      setInterval(function() {
         getChatData(applicationId, userId, 0);
      }, 600000);


      function getChatData(applicationId, userId, newPage) {

         $.ajax({
            type: 'POST',
            url: '<?php echo base_url('admin/chat/getchat'); ?>',
            async: false,
            data: {
               'applicationId': applicationId,
               'userId': userId
            },
            dataType: 'json',
            success: function(result) {

               $("#ChatMessages").html(result.message);

               if (newPage == 1) {
                  $(".scrollClass").last()[0].scrollIntoView({
                     behavior: 'smooth',
                     block: "end"
                  });
               }
            },
            error: function(xhr, textStatus, error) {

            },
            complete: function() {},

         })
      }
   });
   $(document).ready(function() {
		$('#back').on('click', function() {
			<?php $send = $_SERVER['HTTP_REFERER']; ?>
			var redirect_to = "<?php echo $send; ?>";
			window.location.href = redirect_to;
		});
	});
</script>