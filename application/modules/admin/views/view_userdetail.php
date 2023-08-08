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
                        <h2><b>Record Status</b>
                           <a href="javascript:frm_submit(<?php echo '`' . $user->exfid . '`,`Chat`,`' . $user->uid . '`'  ?>);" class="btn btn-warning themeOrangeColor" style="float:right">Chat</a>
                        </h2>
                        <!-- <?php if ($this->session->flashdata('success')) { ?>
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
              </div>
              <?php } ?> -->

                        <table class="table table-striped table-bordered">
                           <tbody>
                              <tr>
                                 <td><b>Application Status</b></td>
                                 <td>
                                    <div class="form-group">

                                       <select class="form-control" id="appStatus" onchange="gerstatus()">
                                          <option value="Received" <?php echo ($user->status === 'Received') ? "selected ='selected'" : ""; ?>>Received</option>
                                          <option value="In Progress" <?php echo ($user->status === 'In Progress') ? "selected ='selected'" : ""; ?>>In Progress</option>
                                          <option value="Need More Information" <?php echo ($user->status === 'Need More Information') ? "selected ='selected'" : ""; ?>>Need More Information</option>
                                          <option value="Eligible for Restriction" <?php echo ($user->status === 'Eligible for Restriction') ? "selected ='selected'" : ""; ?>>Eligible for Restriction</option>
                                          <option value="Eligible for DA" <?php echo ($user->status === 'Eligible for DA') ? "selected ='selected'" : ""; ?>>Eligible for DA</option>
                                          <option value="Eligible Further Steps" <?php echo ($user->status === 'Eligible Further Steps') ? "selected ='selected'" : ""; ?>>Eligible Further Steps</option>
                                          <option value="Denial" <?php echo ($user->status === 'Denial') ? "selected ='selected'" : ""; ?>>Denial</option>
                                          <option value="Ineligible for Restriction" <?php echo ($user->status === 'Ineligible for Restriction') ? "selected ='selected'" : ""; ?>>Ineligible for Restriction </option>
                                          <option value="Restriction Completed" <?php echo ($user->status === 'Restriction Completed') ? "selected ='selected'" : ""; ?>>Restriction Completed</option>
                                       </select>
                                    </div>
                                 </td>
                              </tr>
                              <?php if (!empty($user->multi_restriction_letter)) { ?>
                                 <tr>
                                    <td>Proof of Restriction</td>
                                    <td>
                                       <!-- <div style="height: 50px;width: 6%;background-color: white;border: 1px solid lightgray;border-radius: 30%;padding: 1% 1.0%;">
                        <span>Letter</span>
                      </div> -->
                                       <!-- <img src="<?php print site_url() . "uploads/restriction_letters/" . $user->restriction_letter; ?>" width="350" title ="Letter"> -->
                                       <?php $letterArray = json_decode($user->multi_restriction_letter);
                                       if (!empty($letterArray)) {
                                          foreach ($letterArray as $arrayVal) {  ?>

                                             <span class="img-thumbnail" title="<?php echo $arrayVal; ?>" style="margin-right: 1%;">
                                                <i class="fa fa-file-pdf-o" style="font-size:35px"></i>
                                                <div class="btn-group">
                                                   <a class="downloadLetter" identifier="<?php echo $user->exfid ?>" letterId="<?php echo $arrayVal; ?>" class="btn btn-primary btn-xs"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                   <a class="removeLetter" data-toggle="modal" data-target="#myModal" letterId="<?php echo $arrayVal; ?>" identifier="<?php echo $user->exfid ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                </div>
                                             </span>
                                          <?php }
                                       } else { ?>
                                          <span>No Letter Available</span>
                                       <?php } ?>
                                    </td>
                                 </tr>
                              <?php } ?>
                              <tr>
                                 <td><b>Correspondence</b></td>
                                 <td>
                                    <div class="form-group">
                                       <div class="input-group">
                                          <div class="custom-file">
                                             <form id="uploadFormdoc" method="post" enctype="multipart/form-data" action="<?php echo site_url(); ?>admin/applications/uploaddocument">
                                                <input type="hidden" name="docid" value="<?php print $user->exfid; ?>">
                                                <input type="file" name="reportDocument" id="profileimage" hidden style="display: none" />
                                                <label for="profileimage" class="btn btn-warning btn-xs themeOrangeColor">
                                                   <span style="font-size:smaller">Upload</span>
                                                </label>
                                                <script>
                                                   $(document).ready(function() {

                                                      $("#profileimage").change(function() {
                                                         $("#uploadFormdoc").submit();
                                                      })
                                                   });
                                                </script>

                                                <!--
                                <input type="file" class="custom-file-input" name="reportDocument" id="profileimage">

                                  <input type="submit" class="btn btn-primary btn-xs" style="margin-top: 5%;margin-bottom: 1%;" name="submit" value="Upload"><br> -->
                                                <!-- <span>Accept only jpg ,jpeg ,png and pdf file</span> -->

                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td><b>Internal Comments</b></td>
                                 <td>
                                    <div class="form-group">
                                       <div class="input-group">
                                          <div class="custom-file">
                                             <textarea class="form-control txtarea" onfocusout="addcomment()" rows="5" column="11" cols="160" id="comment"><?php print $user->comment; ?></textarea>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
               </div>
               <div class="x_content">


                  <h2><b>Record Detail</b></h2>


                  <h5><b>Date Received: <?php print date('m-d-Y', strtotime($user->create_date)); ?></b></h5>
                  <h5><b>No. <?php print $user->exfid; ?></b></h5>
                  <input type="hidden" id="resultid" value="<?php print $user->exfid; ?>">
                  <table id="datatable" class="table table-striped table-bordered">
                     <tbody>
                        <!-- <tr>
                    <td style="width: 30%">User Name</td>
                    <td><?php print $user->suffix . "&nbsp;" . $user->firstname . "&nbsp;" . $user->lastname; ?></td>
                  </tr> -->
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
   <div class="container">
      <div class="modal fade" id="myModal" role="dialog">
         <div class="modal-dialog modal-sm modal-danger ">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Conformation</h4>
               </div>
               <div class="modal-body">
                  <p>Are you sure to delete the letter ?</p>
               </div>
               <div class="modal-footer">
                  <a class="btn btn-default btn-sm finalBtn" ident="" uid="" data-dismiss="modal">Yes</a>
                  <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<section>
   <?php
   $attributes = array('name' => 'frm');
   echo form_open('admin/user/user/update_userrole', $attributes);
   ?>
   <input name="user_id" type="hidden" value="" />
   <input name="list_id" type="hidden" value="" />
   <input name="uid" type="hidden" value="" />
   <input name="mode" type="hidden" />
</section>

<script type="text/javascript">
   $(document).ready(function() {
debugger
      $(".gif").fadeOut();
      $(".removeLetter").click(function() {
         var hideData = $(this).parent().closest('span');
         var uid = $(this).attr("identifier");
         var lid = $(this).attr("letterId");
         $(".finalBtn").attr("ident", lid);
         $(".finalBtn").attr("uid", uid);
      });

      $(".finalBtn").click(function() {
         var userid = $(this).attr("uid");
         var userLetterid = $(this).attr("ident");
         if (userid) {
            $.ajax({
               type: "POST",
               data: {
                  userid: userid,
                  userLetterid: userLetterid
               },
               url: "<?php echo site_url(); ?>admin/user/user/removeletter",
               success: function(result) {
                  var res = jQuery.parseJSON(result);
                  console.log(res);
                  if (res.result == "SUCCESS") {

                     location.reload();

                  }
               }
            });
         }
      });

      $(".downloadLetter").click(function() {
         var userid = $(this).attr("identifier");
         var userLetterid = $(this).attr("letterId");
         if (userid) {

            $urld = "<?php echo site_url(); ?>admin/applications/download";
            var form = $('<form action="' + $urld + '" method="post">' + '<input type="hidden" name="userid" value="' + userid + '" /><input type="hidden" name="userLetterid" value="' + userLetterid + '" />' + '</form>');
            $('body').append(form);
            $(form).submit();
            return false;

         }
      });
   });

   function gerstatus() {

      var status = $("#appStatus").val();
      var id = $("#resultid").val();
      $(".gif").show();
      if (status != "") {

         $.ajax({
            type: "POST",
            data: {
               status: status,
               id: id
            },
            url: "<?php echo site_url(); ?>admin/applications/updatestatus",
            success: function(msg) {
               // location.reload();
               $(".gif").fadeOut();
            },
            error: function() {
               $(".gif").fadeOut();
            }
         });
      }


   }

   function addcomment() {
      var id = $("#resultid").val();
      var textcomment = $(".txtarea").val();

      $.ajax({
         type: "POST",
         data: {
            textcomment: textcomment,
            id: id
         },
         url: "<?php echo site_url(); ?>admin/applications/updatecomment",
      });


   }

   function frm_submit(list_id, actval, uid = 0) {

      document.frm.user_id.value = list_id;
      document.frm.list_id.value = list_id;
      document.frm.uid.value = uid;
      document.frm.mode.value = actval;

      if (actval == 'Chat') {
         document.frm.action = "<?php echo site_url(); ?>admin/chat";
         document.frm.submit();
         return
      }
   }
</script>