<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>

<section class="content-header">
	<h1>
		NEFT Account Clossing
		<small>[Account clossing NEFT]</small>
	</h1>
	<?php include '_breadcrumbs.php'; ?>
</section>
<section class="content">
	<form method="post"  id="neftaccountclosed" action="<?php echo $site_url;?>neft/neftaccountclosed">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">

				<!-- general form elements -->
				<!-- Input addon -->
				<div class="box box-danger" style="background: #e6dcff;">
					<div class="box-header with-border">
						<h3 class="box-title">Bank Details</h3>
					</div>
					<div class="box-body w3-allerta">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtNesid">NES ID</label>
									<input type="text" id="txtNesid" name="txtNesid" class="form-control" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtBankAC">Bank Account Number</label>
									<input type="text" id="txtBankAC" name="txtBankAC" class="form-control">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtBankAC">Confirm Bank Account Number</label>
									<input type="text" id="txtBankAC2" name="txtBankAC" class="form-control" required>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtBnkAcHolder">Account Holder Name</label>
									<input type="text" id="txtBnkAcHolder" name="txtBnkAcHolder" class="form-control" >
								</div>
							</div><div class="col-md-4">
								<div class="form-group">
									<label for="txtBankName">Bank Name</label>
									<input type="text" id="txtBankName" name="txtBankName" class="form-control">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtBankBranch">Bank Branch</label>
									<input type="text" id="txtBankBranch" name="txtBankBranch" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">

							<div class="col-md-4">
								<div class="form-group">
									<label for="txtIFSC">IFSC Code</label>
									<input type="text" id="txtIFSC" name="txtIFSC" class="form-control">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtIFSC">Confiem IFSC Code</label>
									<input type="text" id="txtIFSC2" name="txtIFSC" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtSchemeamt">Scheme Amount</label>
									<input type="text" id="txtSchemeamt" name="txtSchemeamt" class="form-control">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtNidhiamt">Nidhi Amount</label>
									<input type="text" id="txtNidhiamt" name="txtNidhiamt"  class="form-control">
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

				<input type="hidden" name="neftaccountclose" value="true" id="neftaccountclose">
				<center><button class="btn btn-md btn-primary" >Submit</button><span onclick="exportAllotees() id="neftaccountclose"></span></center>
			</div>
			<!--/.col (left) -->
		</div>
		<!-- /.row -->
	</form>
</section>

<?php include '_footer.php'; ?>
<script>
$(document).ready(function(){

	$('#txtBankAC2').on('keydown',function(e){
		var curVal = $(this).val();
		var accNo = $('#txtBankAC').val();

		// var l1 = curVal.length;
		// var l2 = accNo.length;

		// console.log(accNo.substr(0,l1));

		// if( curVal != accNo ){
			// $(this).css('border','1px solid red');
		// }

	});


});
</script>