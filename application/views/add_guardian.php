<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
	<h1>
		Add Guardian
		<small>[add a new Guardian to database]</small>
	</h1>
	<?php include '_breadcrumbs.php'; ?>
</section>
<section class="content">
	<form method="post" onsubmit="return validateGuardain()" id="frmAddBeneficiary">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">


				<!-- Form Element sizes -->
				<div class="box box-success" style="background: #dfdccb;">
					<div class="box-header with-border">
						<h3 class="box-title">Parent Profile</h3>
					</div>
					<div class="box-body w3-allerta">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtGuardian">Guardian Name</label>
									<input type="text" class="form-control" name="txtGuardian" id="txtGuardian" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="selGGender">Gender</label>
									<select class="form-control" id="selGGender" name="selGGender" required>
										<option value=""></option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
							</div>


							<div class="col-md-3">
								<div class="form-group">
									<label for="txtGuardianAadhaar">Guardian's Aadhaar</label>
									<input type="text" pattern=".{12,}" x-moz-errormessage="Aadhaar must be 12 digit" title="Aadhaar must be 12 digit" class="form-control" name="txtGuardianAadhaar" id="txtGuardianAadhaar" value="<?php if(isset($gaadhar)){ echo $gaadhar; }?>" >
								</div>
							</div>
														<div class="col-md-3">
								<div class="form-group">
									<label for="txtGDOB">Date Of Birth</label>
									<input type="text" id="txtGDOB" name="txtGDOB" class="form-control" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtAddrPermnt">Permanent Address</label>
									<textarea placeholder="Permanent Address" id="txtAddrPermnt" name="txtAddrPermnt" class="form-control" required></textarea>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="txtGccupation">Occupation</label>
									<input type="text" id="txtGccupation" name="txtGccupation" class="form-control" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtGGuardian">Guardain's Guardian Name</label>
									<input type="text" id="txtGGuardian" name="txtGGuardian" class="form-control" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtGphone">Phone</label>
									<input type="text" id="txtGphone" name="txtGphone" class="form-control" required>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtGphone">Email</label>
									<input type="text" id="txtEmail" name="txtEmail" class="form-control" required>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>


				<!-- Input addon -->
				<div class="box box-danger" style="background: #fbb7ba;">
					<div class="box-header with-border">
						<h3 class="box-title">Bank Details</h3>
					</div>
					<div class="box-body w3-allerta">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtBankAC">Bank Account Number</label>
									<input type="text" id="txtBankAC" name="txtBankAC" class="form-control">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtBnkAcHolder">Account Holder Name</label>
									<input type="text" id="txtBnkAcHolder" name="txtBnkAcHolder" class="form-control">
								</div>
							</div><div class="col-md-4">
								<div class="form-group">
									<label for="txtBankName">Bank Name</label>
									<input width="100%" type="text" id="txtBankName" name="txtBankName" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtBankBranch">Bank Branch</label>
									<input type="text" id="txtBankBranch" name="txtBankBranch" class="form-control" style="width:100%!important">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtIFSC">IFSC Code</label>
									<input type="text" id="txtIFSC" name="txtIFSC" class="form-control">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtPAN">PAN Card</label>
									<input type="text" id="txtPAN" name="txtPAN" class="form-control">
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
	</form>
	<form autocomplete="off" enctype="multipart/form-data" action="" name="singleFileUpload" id="singleFileUpload" method="post">

		<div class="input-group">
			<input type="file" style="display:none" onchange="fnsingleFileUpload('profilePicture')" name="urlP" id="urlP" class="form-control">
			<input type="hidden" name="stamp" value="" id="stamp">
		</div>
	</form>
</section>
<?php include '_footer.php'; ?>
<script>
	$(function(){
		$('#txtGDOB,#txtReceiptDate,#txtGDOB').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
		$('#txtDOB,#txtReceiptDate,#txtGDOB').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});
		//genNidhiEnrolBtn();
		<?php if(isset($old_id)){ ?>
		 getGuardain('<?php echo $old_id; ?>');
		<?php } ?>
	});

	function getGuardain(old_id){
		$.post( site_url+'guardain/getguardianfrommember', { id:old_id})
		.done(function( data ) {
				guardian = JSON.parse(data);
				if (guardian[0].guardian_dob === null){

				}else{
					var newdt = guardian[0].guardian_dob.split('-');
					$('#txtGDOB').val(newdt[2]+'/'+ newdt[1]+'/'+ newdt[0]);
				}

				$('#txtGuardian').val(guardian[0].guardian_name);
				$('#selGGender').val(guardian[0].guardian_gender);
				//$('#txtGuardianAadhaar').val('');
				$('#txtGccupation').val(guardian[0].guardian_occupation);
				$('#txtAddrPermnt').val(guardian[0].permanent_address);
				$('#txtGGuardian').val(guardian[0].guardians_guardian);
				$('#txtMembershipID').val(guardian[0].share_member_id);
				$('#txtBankAC').val(guardian[0].bank_account_number);
				$('#txtBnkAcHolder').val(guardian[0].bank_account_holder_name);
				$('#txtBankName').val(guardian[0].bank_name);
				$('#txtBankBranch').val(guardian[0].bank_branch);
				$('#txtIFSC').val(guardian[0].IFSC_code);
				$('#txtPAN').val(guardian[0].pan_card);
	});
}
	function genNidhiEnrolBtn(){
		if($('#selIsNidhi').val() == 0){
			$('#nidhiEnrollbtn').html('<div class="btn btn-danger" onclick="checkNidhiMembership()">Enroll Now</div>');
		}else{
			$('#nidhiEnrollbtn').html('<div class="btn btn-xs btn-success">Nidhi Enroled</div>')
		}
	}
	var options = {
		url: function(phrase) {
			return site_url+"xhr/schoolsuggest/?term=" + phrase;
		},
		list: {
			maxNumberOfElements: 12,
			match: {
				enabled: false
			}
		},
		getValue: "school"
	};
	$("#txtSchool").easyAutocomplete(options);
	var banks = {
		url: function(phrase) {
			return site_url+"xhr/banksuggest/?term=" + phrase;
		},
		list: {
			maxNumberOfElements: 12,
			match: {
				enabled: false
			}
		},
		getValue: "bank"
	};
	$("#txtBankName").easyAutocomplete(banks);
</script>
