<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
	<h1>
		View / Edit Donor
	</h1>
<?php include '_breadcrumbs.php'; ?>
</section>
<section class="content">
	<form method="post" onsubmit="return updateDon()" id="frmAddDonor">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary" style="background: #8abdea;">
					<div class="box-header with-border">
						<h3 class="box-title">Donor Pofile <small>[ Donor ID : <?php echo $corpusfund->id; ?> ] <span onclick="showCorpDonations('<?php echo $corpusfund->id; ?>')" class="btn btn-xs btn-primary">Donation History</span> <span onclick="showModal('corpAddFund')" class="btn btn-xs btn-primary">Add Fund</span></small></h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body w3-allerta">
						<div class="row">
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="txtBenName">Donor Name</label>
											<input type="text" placeholder="Enter Name" id="txtBenName" name="txtDonName" class="form-control"  value="<?php echo $corpusfund->donor; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="selGender">In Memmory Of</label>
											<input type="text" placeholder="In Memmory Of" id="txtInMemory" name="txtInMemory" class="form-control" value="<?php echo $corpusfund->in_memory; ?>" >
										</div>
									</div>

									<!-- Card row end -->
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="txtAddrTemp">Education Forum [Parish]</label>
											<input type="text" placeholder="Education Forum [Parish]" id="txtEduFrm" name="txtEduFrm" class="form-control"  value="<?php echo $corpusfund->edu_forum; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtAddrTemp">Directory Page</label>
											<input type="text" placeholder="Directory Page" id="txtDirPage" name="txtDirPage" class="form-control" value="<?php echo $corpusfund->directory_page; ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtAddrTemp">PPT Page</label>
											<input type="text" placeholder="PPT Page" id="txtPPTPage" name="txtPPTPage" class="form-control" value="<?php echo $corpusfund->ppt_page; ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="col-md-12">
									<div class="btn btn-xs btn-primary" style="margin-left:40%" onclick="removePhoto('don_picture')">Remove Photo</div>
									<div class="form-group" style="text-align: center;">
										<img src="<?php

										if($corpusfund->don_picture == ''){
											echo $site_url.'/assets/images/donorphoto.png';
										}else{
											echo $site_url.'corpus/'.$corpusfund->don_picture;
										}
										?>" alt="Upload a recent photograph" style="cursor: pointer; border: 1px solid #ccc" onclick="$('#urlD').click()" id="DonorPicture"/>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="col-md-12">
									<div class="btn btn-xs btn-primary" style="margin-left:40%" onclick="removePhoto('inmem_picture')">Remove Photo</div>
									<div class="form-group" style="text-align: center;">
										<img src="<?php

										if($corpusfund->inmem_picture == ''){
											echo $site_url.'/assets/images/inmemoryofphoto.png';
										}else{
											echo $site_url.'corpus/'.$corpusfund->inmem_picture;
										}
										?>" alt="Upload a recent photograph" style="cursor: pointer; border: 1px solid #ccc" onclick="$('#urlM').click()" id="inMemoryPicture"/>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtDonorAddress">Donor Address</label>
									<textarea style="height: 89px;" placeholder="Donor Address" id="txtDonorAddress" name="txtDonorAddress" class="form-control" ><?php echo $corpusfund->donor_address; ?></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtDonorAddress">Nominee Address</label>
									<textarea style="height: 89px;" placeholder="Nominee Address" id="txtNomineeAddress" name="txtNomineeAddress" class="form-control" ><?php echo $corpusfund->nominee_address; ?></textarea>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtStatus">Status</label>
									<input placeholder="" id="txtStatus" name="txtStatus" class="form-control" value="<?php echo makedate($corpusfund->status); ?>"><br>
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
									<input id="txtPhone" name="txtPhone" class="form-control" value="<?php echo $corpusfund->phone; ?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtEmail">Email</label>
									<input id="txtEmail" name="txtEmail" class="form-control" value="<?php echo $corpusfund->email; ?>">
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
		<input type="hidden" name="txtDonorPicture" value="<?php echo $corpusfund->don_picture; ?>" id="txtDonorPicture">
		<input type="hidden" name="txtinMemoryPicture" value="<?php echo $corpusfund->inmem_picture; ?>" id="txtinMemoryPicture">
		<input type="hidden" name="txtDId" value="<?php echo $corpusfund->id; ?>" id="txtDId">

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
		$('#txtStatusTxt').val('<?php echo $corpusfund->status_text; ?>');
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
