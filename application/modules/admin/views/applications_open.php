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
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
				<div class="x_panel">
					<?php
					// echo '<pre>';print_r($screen);die;
					if ($screen == "open") { ?>
						<div class="x_title">
							<h2> Open Expungements </h2>
							<a href="<?php echo site_url(); ?>admin/applications/export" class='btn btn-xs' style="float: right; background:#FF7D3F;color:white"> Export to CSV</a>
							<div class="clearfix"></div>
						</div>
					<?php } else if ($screen == "inprogress") { ?>
						<div class="x_title">
							<h2> In Progress Expungements</h2>
							<a href="<?php echo site_url(); ?>admin/applications/export" class='btn btn-xs' style="float: right; background:#FF7D3F;color:white"> Export to CSV</a>
							<div class="clearfix"></div>
						</div>
					<?php } else if ($screen == "closed") { ?>
						<div class="x_title">
							<h2>Closed Expungements</h2>
							<a href="<?php echo site_url(); ?>admin/applications/export" class='btn btn-xs' style="float: right; background:#FF7D3F;color:white"> Export to CSV</a>
							<div class="clearfix"></div>
						</div>
					<?php } else if ($screen == "avg") { ?>
						<div class="x_title">
							<h2>Average Working Time</h2>
							<a href="<?php echo site_url(); ?>admin/applications/export" class='btn btn-xs' style="float: right; background:#FF7D3F;color:white"> Export to CSV</a>
							<div class="clearfix"></div>
						</div>
					<?php } ?>
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
		<!-- </form> -->
	</div>
</div>
<script type="text/javascript" language="javascript">
	var selected_screen = "<?php echo $screen; ?>";
	// alert(selected_screen);

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
				"url": "<?php echo base_url('admin/user/user/jsonList_details'); ?>",
				"type": "POST",
				"data": {
					selected_screen: selected_screen
				},
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