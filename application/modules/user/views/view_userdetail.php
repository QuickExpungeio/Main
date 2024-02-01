<div class="right_col" role="main">
   <div id="gif" class="gif" style="display:block"></div>
   <div class="">
   <!--<button type="button" class="btn btn-xs" style="background:#FF7D3F;color:white;margin-top: 5px" id="back">Back</button>-->
   <a href="<?php echo base_url();?>user/application" class="btn btn-xs" style="background:#FF7D3F;color:white;margin-top: 5px">Back</a>
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_content">
                  <?php
                  if (!empty($results)) {
                     foreach ($results as $user) {
                        $exfid = $user->exfid;
                        $uid = $user->uid;
                        $base_url = base_url();
                        $string = $exfid . ',' . $uid;
                        $base64code = base64_encode($string);
                        $chaturl = $base_url . 'user/chat/index/' . $base64code;
                  ?>

                        <h2><b>Record Detail</b>
                           <a href="<?php echo $chaturl; ?>" class="btn btn-warning themeOrangeColor" style="float:right">Chat</a>
                        </h2>
                        <h5><b>Date Received: <?php print date('m-d-Y', strtotime($user->create_date)); ?></b></h5>
                        <h5><b>No. <?php print $user->exfid; ?></b></h5>
                        <table id="datatable" class="table table-striped table-bordered">
                           <tbody>

                              <tr>
                                 <td style="width: 30%"><b>Application Status</b></td>
                                 <td><?php echo $user->status; ?></td>
                              </tr>
                              <tr>
                                 <td style="width: 30%"><b>Email Address</b></td>
                                 <td><?php print $user->email; ?></td>
                              </tr>
                              <tr>
                                 <td style="width: 30%"><b>First Name</b></td>
                                 <td><?php print $user->firstname; ?></td>
                              </tr>
                              <tr>
                                 <td style="width: 30%"><b>Last Name</b></td>
                                 <td><?php print $user->lastname; ?></td>
                              </tr>
                              <tr>
                                 <td style="width: 30%"><b>Case Number</b></td>
                                 <td><?php print $user->case_no; ?></td>
                              </tr>
                              <tr>
                                 <td style="width: 30%"><b>Alias</b></td>
                                 <td><?php print $user->alias; ?></td>
                              </tr>
                              <!-- <tr>
                                 <td style="width: 30%"><b>Preferred Communication Method</b></td>
                                 <td>
                                    <?php
                                    if ($user->communication_method == 1) {
                                       print "Email";
                                    } elseif ($user->communication_method == 2) {
                                       print "SMS";
                                    } elseif ($user->communication_method == 3) {
                                       print "SMS and Email";
                                    } ?>
                                 </td>
                              </tr> -->
                              <tr>
                                 <td><b>Date of Birth</b></td>
                                 <?php
                                 $birthdate = trim($user->birthdate);
                                 // echo '<pre>';print_r($user);die;
                                 if ($birthdate == "") {
                                    $bd = "-";
                                 } else {
                                    $bd = date('m-d-Y', strtotime($user->birthdate));
                                 }
                                 ?>
                                 <td><?php print  $bd; ?></td>
                              </tr>
                              <tr>
                                 <td><b>Race</b></td>
                                 <td><?php print $user->race; ?></td>
                              </tr>
                              <tr>
                                 <td><b>Gender</b></td>
                                 <td><?php print $user->gender; ?></td>
                              </tr>
                              <tr>
                                 <td><b>Social Security Number</b></td>
                                 <td><?php print $user->ssn; ?></td>
                              </tr>
                              <tr>
                                 <td><b>Phone No</b></td>
                                 <td><?php print $user->phone_no; ?></td>
                              </tr>
                              <tr>
                                 <td><b>State</b></td>
                                 <td><?php print $user->state; ?></td>
                              </tr>
                              <tr>
                                 <td><b>Zipcode</b></td>
                                 <td><?php print $user->zipcode; ?></td>
                              </tr>
                              <tr>
                                 <td><b>Arresting Agency</b></td>
                                 <td><?php print $user->arresting_agency; ?></td>
                              </tr>
                              <tr>
                                 <td><b>Date of Arresting</b></td>
                                 <td><?php print $user->arrest_month; ?> - <?php print $user->arrest_date; ?> - <?php print $user->arrest_year; ?></td>
                              </tr>
                              <tr>
                                 <td><b>Driving License Number</b></td>
                                 <td><?php print $user->license; ?></td>
                              </tr>
                              <tr>
                                 <td><b>State Identification Number</b></td>
                                 <td><?php print $user->state_id_no; ?></td>
                              </tr>
                              <tr>
                                 <td><b>Offense Arrested For</b></td>
                                 <td style="word-break:break-all;"><?php print $user->offense_attested; ?></td>
                              </tr>
                              <tr>
                                 <td><b>Photo ID</b></td>
                                 <!-- <td><img src="<?php print $user->verification_id; ?>" width="350" title=""> </td> -->
                                 <?php if (
                                    strpos($user->verification_id, 'docx') == true ||
                                    strpos($user->verification_id, 'pdf') == true
                                 ) { ?>
                                    <td><a href="<?php echo $user->verification_id; ?>" target="_blank"><?php echo substr($user->verification_id, strrpos($user->verification_id, '/') + 1); ?></a></td>
                                 <?php } else { ?>
                                    <td><a href="<?php echo $user->verification_id; ?>" target="_blank"><img src="<?php echo $user->verification_id; ?>" width="350" title=""> </a></td>
                                 <?php } ?>
                              </tr>
                              <tr>
                                 <td></td>
                                 <td>
                                    <a href="<?php echo $chaturl; ?>" class="btn btn-warning themeOrangeColor">Chat</a></h2>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                  <?php }
                  } ?>

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
                                 <th></th>
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
                                       <td><a href="<?php echo $val->attachment; ?>" class="btn btn-lg btn-warning themeOrangeColor" style="font-size:smaller" download>Download</a></td>
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
</div>

<section>
   <?php
   $attributes = array('name' => 'frm');
   echo form_open('admin/user/user/update_userrole', $attributes);
   ?>
   <input name="user_id" type="hidden" value="" />
   <input name="appid" type="hidden" value="" />
   <input name="uid" type="hidden" value="" />
   <input name="mode" type="hidden" />
</section>

<script type="text/javascript">
   $(document).ready(function() {
      $(".gif").fadeOut();
   });

   function frm_submit(list_id, actval, uid = 0) {

      document.frm.user_id.value = list_id;
      document.frm.appid.value = list_id;
      document.frm.uid.value = uid;
      document.frm.mode.value = actval;

      if (actval == 'Chat') {
         document.frm.action = "<?php echo site_url('user/chat'); ?>";
         document.frm.submit();
         return false;
      }
   }
   $(document).ready(function() {
		$('#back').on('click', function() {
			// <?php //$send = $_SERVER['HTTP_REFERER']; ?>
			// var redirect_to = "<?php //echo $send; ?>";
			// window.location.href = redirect_to;
         event.preventDefault();
         history.back(1);
		});
	});
</script>