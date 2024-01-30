<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Quick Expunge</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" type="text/css"
		href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="shortcut icon" href="<?php echo base_url()?>assets/images/fav.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="<?php echo base_url();?>assets/form/form.css" rel="stylesheet">
	<script src="<?php echo base_url("assets/build/gtag.js"); ?>"></script>

</head>

<body style="background: #2A3F54 !important;">
	<div id="main">
		<section id="content_wrapper">
			<section id="contentpayment" class="animated fadeIn">
				<div class="panel-heading pn">
					<h3 class="tcolr">Quick Expunge</h3>
				</div>

				<!-- <form action="<?php echo base_url()?>form/form/strippay" method="post"> -->
				<?php echo form_open(base_url('form/form/strippay'),array('method'=>'post','autocomplete'=>'off','id'=>'paymentForm'));?>

				<h5 class="tcolr">Enter Payment Information</h5>
				<div class="icon-container text-center" style="font-size: 40px;">
					<i class="fa fa-cc-visa" style="color:gray"></i>
					<i class="fa fa-cc-amex" style="color:gray;"></i>
					<i class="fa fa-cc-mastercard" style="color:gray;"></i>
					<i class="fa fa-cc-discover" style="color:gray;"></i>
					<i class="fa fa-cc-paypal" style="color:gray;"></i>
				</div>

				<div class="tab">
					<div class="title">Name</div>
					<p><input type="text" id="username" placeholder="Full Name " oninput="this.className = ''"
							name="username"></p>

					<div class="row">
						<div class="col-sm-9">
							<lable>Card Number</lable>
							<input type="text" maxlength="19" placeholder="Card Number" id="ccn"
								oninput="this.className = ''" name="cardnumber">
						</div>
						<div class="col-sm-3">
							<lable>CVV</lable>
							<input type="text" maxlength="3" id="cvv" placeholder="CVV " oninput="this.className = ''"
								name="cvv">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<lable>Exp Month</lable>
							<input type="text" maxlength="2" placeholder="Expair Month" oninput="this.className = ''"
								name="expmonth">
						</div>
						<div class="col-sm-6">
							<lable>Exp Year</lable>
							<input type="text" maxlength="2" placeholder="Expair Year" oninput="this.className = ''"
								name="expyear">
						</div>
					</div>

					<div class="mt-3">
						<div style="float:center;">
						<a href="Javascript:void(0)" class="button" id="nextBtn" onclick="validateForm()">Pay $
								<?php echo ($payamount->amount)?$payamount->amount:""?></a>
						</div>
					</div>
				</div>

				</form>
			</section>
		</section>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
	<script src="<?php echo base_url();?>assets/form/payment.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

</body>

</html>
