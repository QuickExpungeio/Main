<style>
	.NotificationBadge {
		display: inline-block;
		min-width: 10px;
		padding: 3px 5px;
		font-size: 8px;
		font-weight: 700;
		line-height: 1;
		color: #fff;
		text-align: center;
		white-space: nowrap;
		vertical-align: middle;
		background-color: #ef6726;
		border-radius: 10px;
		margin-bottom: 50%;
	}
</style>
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row" style="margin-top: 1%;">

			<div class="col-lg-3 col-6" style="width: 25%;padding-right:20px;padding-left:20px;">
				<div class="small-box" style="height: 200px;background-color:#f0f0f0;">
					<div class="inner">
						<br>
						<a href="<?php echo site_url('admin/applications/count_details/open'); ?>">
							<h4 class="text-center"><b> Open Expungements</b></h4>
							<br>
							<!-- <a href="JavaScript:void(0);"> -->

							<h2 class="text-center"><b><?php echo $openCount; ?></b></h2>
						</a>
					</div>

				</div>
			</div>

			<div class="col-lg-3 col-6" style="width: 25%;padding-right:20px;padding-left:20px;">

				<div class="small-box" style="height: 200px;background-color:#f0f0f0;">
					<div class="inner">
						<br>
						<a href="<?php echo site_url(); ?>admin/applications/count_details/inprogress">
							<h4 class="text-center"><b>In Progress Expungements</b></h4>
							<br>
							<!-- <a href="JavaScript:void(0);"> -->
							<h2 class="text-center"><b><?php echo $inprogressCount; ?></b></h2>
						</a>

					</div>

				</div>
			</div>

			<div class="col-lg-3 col-6" style="width: 25%;padding-right:20px;padding-left:20px;">

				<div class="small-box " style="height: 200px;background-color:#f0f0f0;">
					<div class="inner">

						<br>
						<a href="<?php echo site_url(); ?>admin/applications/count_details/closed">
							<h4 class="text-center"><b>Closed Expungements</b></h4>
							<br>
							<!-- <a href="JavaScript:void(0);"> -->

							<h2 class="text-center"><b><?php echo $closedCount; ?></b></h2>
						</a>
					</div>

				</div>
			</div>

			<div class="col-lg-3 col-6" style="width: 25%;padding-right:20px;padding-left:20px;">

				<div class="small-box" style="height: 200px;background-color:#f0f0f0;">
					<div class="inner">

						<br>
						<a href="JavaScript:void(0);">
							<h4 class="text-center"><b>Average Working Time</b></h4>
							<br>

							<h2 class="text-center"><b>30</b></h2>
						</a>
						<h4 class="text-center"><b>Days</b></h4>
					</div>

				</div>
			</div>

		</div>
		<div class="row">
			<div class="col-lg-6 col-6">
				<h2> <b>Record Restriction Dashboard</b></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
				<div class="x_panel">

					<div class="x_title">
						<a href="<?php echo base_url('form/form_new/page') ?>" class='btn btn-xs' style="float: left; height: 52px;padding: 15px;background:#FF7D3F;color:white">ADD NEW EXPUNGEMENT</a>
						<br>
						<!-- <h2> Record Restriction Dashboard</h2>
						<a href="<?php echo site_url(); ?>admin/applications/export" class='btn btn-xs' style="float: right; background:#002d53;color:white"> Export to CSV</a> -->
						<div class="clearfix"></div>
					</div>

					<div class="x_content">
						<table class="table table-striped table-bordered datatable datatableFilter">
							<thead>
								<tr>
									<th><button onclick="multidelete()" class="btn btn-xs btn-danger" name="deletebutton"><i class="fa fa-trash"></i></button></th>
									<th>Application No</th>
									<th>Name</th>
									<th>Email</th>
									<th>Arresting Agency</th>
									<th>Date of Arrest </th>
									<th>Driving License Number</th>
									<th>Case Number</th>
									<th>Status</th>
									<th>Filled By</th>
									<th>Chat</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<?php
							$attributes = array('name' => 'frm');
							echo form_open('admin/user/user/update_userrole', $attributes);
							?>
							<input name="user_id" type="hidden" value="" />
							<input name="list_id" type="hidden" value="" />
							<input name="uid" type="hidden" value="" />
							<input name="mode" type="hidden" />
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- </form> -->
</div>
</div>
<script type="text/javascript" language="javascript">
	$(document).ready(function() {

		$(".datatable").DataTable({

			"processing": true,
			"serverSide": true,
			"ordering": true,
			"searching": true,
			"responsive": true,

			"columnDefs": [{
					"targets": 0,
					"orderable": false
				},
				{
					"targets": 6,
					"orderable": false
				},
				{
					"targets": 7,
					"orderable": false
				},
				{
					"targets": 9,
					"orderable": false
				},
				{
					"targets": 10,
					"orderable": false
				}
			],

			//  "scroller": true,
			//  "scrollCollapse": true,
			//  "scrollY": 700,
			//  "colReorder": true,


			"ajax": {
				"url": "<?php echo base_url('admin/user/user/jsonList'); ?>",
				"type": "POST",
				"data": {},
			},

			"fnInitComplete": function(oSettings, json) {
				$(".sorting_asc").removeClass("sorting_asc");
			},

			// scrollY: 200,
			// deferRender: true,
			// scroller: {
			//     loadingIndicator: true
			// },

			"columns": [{
					"data": "deleteid"
				},
				{
					"data": "appno"
				},
				{
					"data": "name"
				},
				{
					"data": "email"
				},
				{
					"data": "agency"
				},
				{
					"data": "dateofarrest"
				},
				{
					"data": "drivelicence"
				},
				{
					"data": "caseno"
				},
				{
					"data": "status"
				},
				{
					"data": "fill_by"
				},
				{
					"data": "chat"
				},
				{
					"data": "action"
				},
			],
		});
	});
	// https://coderexample.com/datatable-scroller-server-side/

	function frm_submit(list_id, actval, uid = 0) {
		document.frm.user_id.value = list_id;
		document.frm.list_id.value = list_id;
		document.frm.uid.value = uid;
		document.frm.mode.value = actval;

		if (actval == 'View') {
			document.frm.action = "<?php echo site_url('admin/applications/details'); ?>";
			document.frm.submit();
			return
		}

		if (actval == 'Chat') {
			document.frm.action = "<?php echo site_url('admin/chat'); ?>";
			document.frm.submit();
			return
		}

		if (actval == 'Delete') {
			var result = confirm("Are you sure you want to delete?");
			if (result) {
				document.frm.action = "<?php echo site_url('admin/appications/removedetails'); ?>";
				document.frm.submit();
				return
			}
		}

	}

	function multidelete() {
		var ids = [];
		$('.multdelete:checked').map(function() {
			ids.push(this.value);
		});

		if (ids != "") {

			var result = confirm("Are you sure you want to delete multiple records?");

			if (result) {

				$.ajax({
					type: "POST",
					data: {
						ids: ids
					},
					url: "<?php echo site_url('admin/applications/removemultidetail'); ?>",
					success: function(msg) {
						$('.datatable').DataTable().ajax.reload();
					}
				});
			}
		} else {

			alert("Select Atlist One Recoard ");
			return false;
		}
	}
</script>