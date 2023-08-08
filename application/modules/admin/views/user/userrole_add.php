
						
<div class="page-wrapper">
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Carer Detail</h4>
									  <?php echo form_open('admin/user/user/add_user','novalidate');	
						//	 print_r($result);
				?>
										<div class="form-group">
											<h5>First Name <span class="text-danger">*</span></h5>
											<div class="controls">
											 <input type="text" name="firstname" class="form-control"  required data-validation-required-message="This field is required" ></div>
												
											
										</div>
										<div class="form-group">
											<h5>Last Name<span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="text" name="surname" class="form-control"  required data-validation-required-message="This field is required" ></div>
										</div>
										
										<div class="form-group">
										   <h5>Address</h5>
											<div class="controls">
												<input type="text" name="street1" class="form-control">
											 </div> 
                                        </div>
										
                                        <div class="form-group">
											<h5>Address</h5>
											 <div class="controls">
												<input type="text" name="street2" class="form-control"  />
												
											</div>
                                    	</div>
										<div class="form-group">
                                       	 <h5>Email</h5>
										 <div class="controls">
                                            <input type="text" name="email" class="form-control">
                                        </div>
                                        </div>
										<div class="form-group">
										 <div class="row">
                                    	<div class="col-md-4">
                                         <h5>Latitude</h5>
										 <div class="controls">
                                            <input type="text" name="latitude" class="form-control">
                                            </div>
											</div>
											<div class="col-md-4">
											<h5>Longitude</h5>
										 <div class="controls">
                                            <input type="text" name="longitude" class="form-control">
                                            </div> </div>
                                        </div>
										<div class="form-group">
                                       		<h5>Phone No</h5>
										 	<div class="controls">
                                            <input type="text" name="phone" class="form-control"  data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="No Characters Allowed, Only Numbers">
                                            </div>
										</div>
										
                                        <div class="form-group">
											<h5>Phone No </h5>
                                         	<div class="controls">
                                            <input type="text" name="phone2" class="form-control" data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="No Characters Allowed, Only Numbers">
                                            
                                        </div>
                                    </div>
										
											
										
										<div class="text-xs-right">
											 <input type="submit" name="Save Changes" class="btn btn-info" value="Submit"/>
											 <a class="btn btn-inverse" href="<?php echo site_url('admin/user/user'); ?>">Cancel</a>
										</div>
										</div>
									</form>
								</div>
							</div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
		