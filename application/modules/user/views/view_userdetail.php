<div class="right_col" role="main">
   <div id="gif" class="gif" style="display:block"></div>
   <div class="">
      <div class="clearfix"></div>
      <div class="row">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
               <div class="x_content">
                  <?php
                  if (!empty($results)) {
                     foreach ($results as $user) {
                  ?>

                        <h2><b>Record Detail</b></h2>


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
                                 <td style="width: 30%"><b>Email Address</b></td>
                                 <td><?php print $user->email; ?></td>
                              </tr>
                              <tr>
                                 <td style="width: 30%"><b>Case Number</b></td>
                                 <td><?php print $user->case_no; ?></td>
                              </tr>
                              <tr>
                                 <td style="width: 30%"><b>Alias</b></td>
                                 <td><?php print $user->alias; ?></td>
                              </tr>
                              <tr>
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
                              </tr>
                              <tr>
                                 <td><b>Date of Birth</b></td>
                                 <td><?php print date('d-m-Y', strtotime($user->birthdate)); ?></td>
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
                                 <td><b>Offense Arrested For</b></td>
                                 <td style="word-break:break-all;"><?php print $user->offense_attested; ?></td>
                              </tr>
                              <tr>
                                 <td><b>Internal Comments</b></td>
                                 <td><img src="<?php print $user->verification_id; ?>" width="350" title="Internal Comments"> </td>
                              </tr>
                              <tr>
                                 <td></td>
                                 <td>
                                    <a href="javascript:frm_submit(<?php echo '`' . $user->exfid . '`,`Chat`,`' . $user->uid . '`'  ?>);" class="btn btn-warning themeOrangeColor">Chat</a></h2>
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
</script>