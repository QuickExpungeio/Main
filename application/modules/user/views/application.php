<style>

.NotificationBadge {
    display: inline;
    min-width: 10px;
    padding: 2px 6px;
    font-size: 8px;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: top;
    background-color: #ef6726;
    border-radius: 10px;
    margin-bottom:50%;
}

.small-box {
		padding: 7%;
	}

	.bg-aqua {
		background-color: #ff7d3f;
		color: white;
	}
	.btn-warning {
		font-size: smaller;
	}

	.small-box a {
		color: white;
	}

	/* width */
	::-webkit-scrollbar {
		width: 1px;
	}

	/* Track */
	::-webkit-scrollbar-track {
		background: #f1f1f1;
	}

	/* Handle */
	::-webkit-scrollbar-thumb {
		background: #ffffffe6;
	}

	/* Handle on hover */
	::-webkit-scrollbar-thumb:hover {
		background: #555;
	}
</style>
<div class="right_col" role="main" style="height:1000px">
	<div class="">
		<div class="clearfix"></div>
		<!-- <form method="post" action="<?php echo base_url(); ?>admin/user/user/exportCSV"> -->
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>Your Applications</b></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="row">

							<div class="col-md-12 col-sm-12 col-xs-12">
								<table class="table table-striped table-bordered table-responsive datatable ">
								<thead>
									<tr>
										<th>App Number</th>
										<th>First Name</th>
										<th>Lastname</th>
										<th>Email Address</th>
										<th>Case Number</th>
										<th>Direct Message</th>
										<th>Details</th>
									</tr>
								</thead>
								<tbody>
									<?php if(!empty($applications)){
										foreach ($applications as $val) {
											$notiBatch='';
											if($val->is_Reeded!=0){
												$notiBatch='<span class="NotificationBadge">'.$val->is_Reeded.'</span>';
											}
										?>
									<tr>
										<td><?php echo $val->exfid ?></td>
										<td><?php echo $val->firstname ?></td>
										<td><?php echo $val->lastname ?></td>
										<td><?php echo $val->email ?></td>
										<td><?php echo $val->case_no ?></td>
										<td><a href="javascript:frm_submit(<?php echo $val->exfid ?>,`Chat`,<?php echo $val->uid ?>);"><i class="fa fa-comments" style="font-size:30px"></i><?php echo $notiBatch?></a></td>
										<td><a href="javascript:frm_submit(<?php echo $val->exfid ?>,`View`,<?php echo $val->uid ?>);" class="btn btn-warning themeOrangeColor btn-lg">VIEW DETAILS</a></td>

									</tr>
									<?php }}?>
								</tbody>
								</table>

							</div>
							<!-- <?php if (!empty($applications)) {
								foreach ($applications as $val) {
							?>
									<div class="col-lg-3 col-xs-6" style="margin-top:1%">
										<div class="small-box bg-aqua">
											<div class="inner">
												<h3><?php echo $val->exfid ?></h3>
												<p>Status : - <?php echo $val->status ?></p>
												<p>Date : - <?php echo date('d M Y', strtotime($val->create_date)) ?></p>
												<p>Offense :-<small> <?php echo substr($val->offense_attested, 0, 20) . "..." ?></small></p>
											</div>
											<div class="icon">
												<i class="ion ion-bag"></i>
											</div>
											<a href="javascript:frm_submit(<?php echo $val->exfid ?>);" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								<?php }
							} else { ?>
								<div style="text-align: center;">No Application Available</div>
							<?php } ?> -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- </form> -->
	</div>
</div>
<?php $attributes = array('name' => 'frm');
echo form_open('user/chat', $attributes); ?>
<input name="appid" type="hidden" value="" />
<input name="user_id" type="hidden" value="" />
<script type="text/javascript" language="javascript">
	function frm_submit(appID,flag,uid=0) {
		document.frm.appid.value = appID;
		document.frm.user_id.value = appID;
		if(flag=="View"){
			document.frm.action = "<?php echo site_url('user/application/details'); ?>";
		}
		if(flag=="Chat"){
			document.frm.action = "<?php echo site_url('user/chat'); ?>";
		}
		document.frm.submit();

	}

</script>