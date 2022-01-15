<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
	<h1>
		Add Donor
		<small>[add a new beneficiary to database]</small>
	</h1>
<?php include '_breadcrumbs.php'; ?>
</section>
<section class="content">
	<form method="post" onsubmit="return validateDon()" id="frmAddDonor">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary"  style="background: #85b6f7;">
					<div class="box-header with-border">
						<h3 class="box-title">Donor Pofile</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body w3-allerta">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="txtBenName">Donor Name</label>
											<input type="text" placeholder="Enter Name" id="txtBenName" name="txtDonName" class="form-control" >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="selGender">In Memmory Of</label>
											<input type="text" placeholder="In Memmory Of" id="txtInMemory" name="txtInMemory" class="form-control" >
										</div>
									</div>

									<!-- Card row end -->
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="txtAddrTemp">Education Forum [Parish]</label>
											<input type="text" placeholder="Education Forum [Parish]" id="txtEduFrm" name="txtEduFrm" class="form-control"  >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtAddrTemp">Directory Page</label>
											<input type="text" placeholder="Directory Page" id="txtDirPage" name="txtDirPage" class="form-control"  >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtAddrTemp">PPT Page</label>
											<input type="text" placeholder="PPT Page" id="txtPPTPage" name="txtPPTPage" class="form-control"  >
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="col-md-12">
									<div class="form-group" style="text-align: center;">
										<img src="<?php echo $site_url; ?>/assets/images/donorphoto.png" alt="Upload a recent photograph" style="cursor: pointer; border: 1px solid #ccc" onclick="$('#urlD').click()" id="DonorPicture"/>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="col-md-12">
									<div class="form-group" style="text-align: center;">
										<img src="<?php echo $site_url; ?>/assets/images/inmemoryofphoto.png" alt="Upload a recent photograph" style="cursor: pointer; border: 1px solid #ccc" onclick="$('#urlM').click()" id="inMemoryPicture"/>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtDonorAddress">Donor Address</label>
									<textarea style="height: 89px;" placeholder="Donor Address" id="txtDonorAddress" name="txtDonorAddress" class="form-control" ></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtDonorAddress">Nominee Address</label>
									<textarea style="height: 89px;" placeholder="Nominee Address" id="txtNomineeAddress" name="txtNomineeAddress" class="form-control" ></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtStatus">Status</label>
									<input placeholder="" id="txtStatus" name="txtStatus" class="form-control" ><br>
									<select id="txtStatusTxt" name="txtStatusTxt" class="form-control">
										<option value=""> - Select Status - </option>
										<option value="Late">Late</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtPhone">Phone</label>
									<input id="txtPhone" name="txtPhone" class="form-control" >
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtEmail">Email</label>
									<input id="txtEmail" name="txtEmail" type="text" class="form-control" value="" >
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

				<center><button class="btn btn-md btn-primary" >Submit</button><span id="testres"></span></center>
			</div>
			<!--/.col (left) -->
		</div>
		<!-- /.row -->
		<input type="hidden" name="txtDonorPicture" value="" id="txtDonorPicture">
		<input type="hidden" name="txtinMemoryPicture" value="" id="txtinMemoryPicture">
	</form>
	<form autocomplete="off" enctype="multipart/form-data" action="" name="DonorPictureUpload" id="DonorPictureUpload" method="post">

		<div class="input-group">
			<input type="file" style="display:none" onchange="fileUpload('DonorPicture','DonorPictureUpload')" name="urlD" id="urlD" class="form-control">

		</div>
	</form>
	<form autocomplete="off" enctype="multipart/form-data" action="" name="inMemoryPictureUpload" id="inMemoryPictureUpload" method="post">

		<div class="input-group">
			<input type="file" style="display:none" onchange="fileUpload('inMemoryPicture','inMemoryPictureUpload')" name="urlM" id="urlM" class="form-control">
		</div>
	</form>
</section>
<?php include '_footer.php'; ?>
<script>
	$(function(){
		$('#txtStatus').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
		$('#txtStatus').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});
	});
	var edufrm = {
		url: function(phrase) {
			 return site_url+"xhr/eduformsuggest/?term=" + phrase;
		},
		list: {
		maxNumberOfElements: 12,
		match: {
			enabled: true
		}
	    },
		getValue: "eduforum"
	};
	$("#txtEduFrm").easyAutocomplete(edufrm);
</script>
