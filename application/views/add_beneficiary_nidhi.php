<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
	<h1>
		Add Beneficiary
		<small>[add a new beneficiary to database]</small>
	</h1>
	<?php include '_breadcrumbs.php'; ?>
</section>
<section class="content">
	<form method="post" onsubmit="return updateBen()" id="frmAddBeneficiary">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-primary" style="background: #85b6f7;">
					<div class="box-header with-border" >
						<h3 class="box-title">Beneficiary Pofile</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body w3-allerta">
						<div class="row">
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtBenName">Beneficiary Name</label>
											<input type="text" placeholder="Enter Name" id="txtBenName" name="txtBenName" class="form-control" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="selGender">Gender</label>
											<select class="form-control" id="selGender" name="selGender" required>
												<option value=""></option>
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
									</div>

									<!-- Card row end -->
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtDOB">Date Of Birth</label>
											<input type="text" id="txtDOB" name="txtDOB" class="form-control" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtPhone">Phone</label>
											<input type="text" placeholder="Phone Number" id="txtPhone" name="txtPhone" class="form-control" >
										</div>
									</div>

								</div>
								<!-- Card row end -->
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtEmail">Email</label>
											<input type="email" placeholder="Email" id="txtEmail" name="txtEmail" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtAadhaar">Aadhaar Number</label>
											<input type="text" id="txtAadhaar" name="txtAadhaar" class="form-control" >
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="col-md-12">
									<div class="form-group" style="text-align: center;">
										<img src="<?php echo $site_url; ?>/assets/images/pofilepic.png" alt="Upload a recent photograph" style="cursor: pointer; border: 1px solid #ccc" onclick="$('#urlP').click()" id="profilePicture"/>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->


				<!-- Form Element sizes -->
				<div class="box box-success" style="background: #77ed85;">
					<div class="box-header with-border">
						<h3 class="box-title">Parent Profile</h3>
					</div>
					<div class="box-body  w3-allerta">
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtGuardian">Guardian Name</label>
									<input type="text" class="form-control" name="txtGuardian" id="txtGuardian" required>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="selGGender">Gender</label>
									<select class="form-control" id="selGGender" name="selGGender" required>
										<option value=""></option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="txtGuardianRel">Guardian's Relation</label>
									<input type="text" class="form-control" name="txtGuardianRel" id="txtGuardianRel" required placeholder="[ With Beneficiary ]">
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<label for="txtGuardianPhone">Guardian's Phone</label>
									<input type="text" class="form-control" name="txtGuardianPhone" id="txtGuardianPhone" required>
								</div>
							</div>

							<div class="col-md-3">
								<div class="form-group">
									<label for="txtGuardianAadhaar">Guardian's Aadhaar</label>
									<input type="text" class="form-control" name="txtGuardianAadhaar" id="txtGuardianAadhaar" >
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
									<label for="txtGDOB">Date Of Birth</label>
									<input type="text" id="txtGDOB" name="txtGDOB" class="form-control" required>
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
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtNominee">Nominee Name</label>
									<input type="text" class="form-control" name="txtNominee" id="txtNominee">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtNomineeRel">Nominee's Relation</label>
									<input type="type" class="form-control" name="txtNomineeRel" id="txtNomineeRel" placeholder="[ With Guardian ]">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtNomineePhone">Nominee's Phone</label>
									<input type="text" class="form-control" name="txtNomineePhone" id="txtNomineePhone">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtNomineeAadhaar">Nominee Aadhaar</label>
									<input type="text" class="form-control" name="txtNomineeAadhaar" id="txtNomineeAadhaar">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtAddrTemp">Nominee Address</label>
									<textarea placeholder="Nominee Address" id="txtAddrTemp" name="txtAddrTemp" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"><h4 class="box-title">Gaurdian Bank Details</h4></div>
						</div>
						<div class="row" style="border-top:1px dashed #ccc; padding-top:15px">
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtBankAC">Bank Account Number</label>
									<input type="text" id="txtBankAC" name="txtBankAC" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtBnkAcHolder">Account Holder Name</label>
									<input type="text" id="txtBnkAcHolder" name="txtBnkAcHolder" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtBankName">Bank Name</label>
									<input type="text" id="txtBankName" name="txtBankName" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtBankBranch">Bank Branch</label>
									<input type="text" id="txtBankBranch" name="txtBankBranch" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtIFSC">IFSC Code</label>
									<input type="text" id="txtIFSC" name="txtIFSC" class="form-control">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtPAN">PAN Card</label>
									<input type="text" id="txtPAN" name="txtPAN" class="form-control">
								</div>
							</div>
						</div>
						<!-- Card row end -->
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

				<div class="box box-primary" style="background: #85b6f7;">
					<div class="box-header with-border">
						<h3 class="box-title">Nidhi Details</h3>
					</div>
					<div class="box-body w3-allerta">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="selIsNidhi">Nidhi Enrollment </label>
									<div id="nidhiEnrollbtn"></div>
									<select style="display: none" onchange="checkNidhiMembership()" class="form-control" id="selIsNidhi" name="selIsNidhi" value="">
										<option value=""></option>
										<option value="1" selected>Enrolled</option>
										<option value="0">Not Enrolled</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtSchool">Membership ID</label>
									<input type="text" class="form-control" name="txtMembershipID" id="txtMembershipID" value="" onkeypress="return false;" placeholder="Click to check Membership status">
								</div>
							</div>
							<div class="col-md-4" style="padding-top:25px">

							</div>

						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtReceipt">Initial Payment</label>
									<input type="text" required="" class="form-control" name="txtInitialPay" id="txtInitialPay" placeholder="Initial Payment">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtReceipt">Receipt Number</label>
									<input type="text" required="" class="form-control" name="txtReceipt" id="txtReceipt" placeholder="Receipt Number">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtDOB">Receipt Date</label>
									<input type="text" id="txtReceiptDate" name="txtReceiptDate" class="form-control" required>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="box box-warning" style="background: #fcc48a;">
					<div class="box-header with-border">
						<h3 class="box-title">Education &amp; Qualification</h3>
					</div>
					<div class="box-body w3-allerta">
						<div class="row">
							<div class="col-md-6 tags-invisible" >
								<div class="form-group">
									<label for="txtSchool">School Name</label>
									<input type="text" class="form-control" name="txtSchool" id="txtSchool">
								</div>
							</div>
							<div class="col-md-3 tags-invisible" >
								<div class="form-group">
									<label for="txtMedium">Medium</label>
									<select class="form-control" name="txtMedium" id="txtMedium">
										<option value="English">English</option>
										<option value="Malayalam">Malayalam</option>
									</select>
								</div>
							</div>
							<div class="col-md-3 tags-invisible" >
								<div class="form-group">
									<label for="txtSyllabus">Syllabus</label>
									<select class="form-control" name="txtSyllabus" id="txtSyllabus">
										<option value="State">State</option>
										<option value="CBSE">CBSE</option>
										<option value="ICSE">ICSE</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12" >
								<div class="form-group">
									<label for="txtCollege">College / University</label>
									<input type="text" class="form-control" name="txtCollege" id="txtCollege">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 tags-invisible" >
								<div class="form-group">
									<label for="txtQualification">Qualification</label>
									<input type="text" data-role="tagsinput" class="form-control" name="txtQualification" id="txtQualification">
									<button type="button" class="btn btn-md btn-primary" onclick="showModal('qualification')">+ Add Qualification</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->



				<div class="box box-danger" style="background: #8ad3fc;">
					<div class="box-header with-border">
						<h3 class="box-title">Parish Details</h3>
					</div>
					<div class="box-body w3-allerta">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="selForanee">Forane</label>
									<select class="form-control" name="selForane" id="selForane" onchange="geteduforum(value,'selEduFrm')">
										<option value=""></option>
										<?php foreach ($forane->result() as $row) { ?>
											<option value="<?php echo $row->id.'|'.$row->forane; ?>"><?php echo ucwords($row->forane); ?></option>
										<?php } ?>
									</select>
								</div>
							</div><div class="col-md-4">
								<div class="form-group">
									<label for="selEduFrm">Education Forum</label>
									<select class="form-control" name="selEduFrm" id="selEduFrm" required>
										<option value=""></option>
										<input type="hidden" id="setEduFrm" value="">
									</select>
								</div>
							</div>
						</div>
						<div class="row">

							<div class="col-md-4">
								<div class="form-group">
									<label for="txtBCCNum">BCC Number</label>
									<input type="text" class="form-control" name="txtBCCNum" id="txtBCCNum">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtBCCName">BCC Name</label>
									<input type="text" class="form-control" name="txtBCCName" id="txtBCCName">
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
		<input type="hidden" name="old_id" value="" id="old_id">
		<input type="hidden" name="txtId" value="" id="txtId">
		<input type="hidden" name="newNidhi" value="true" id="newNidhi">
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

		$('#txtDOB,#txtReceiptDate,#txtGDOB').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
		$('#txtDOB,#txtReceiptDate,#txtGDOB').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});
		genNidhiEnrolBtn();
		<?php if(isset($gaadhar)){ ?>
		 getGuardianAadharwise('<?php echo $gaadhar; ?>');
		 addToNidhiBen('<?php echo $old_id; ?>')
		<?php }else{ ?>
			checkAadhar();
		<?php } ?>

	});

function getGuardianAadharwise(aadhar){
	$.post( site_url+'guardain/checkaadhar', { Gaadhar: aadhar})
	.done(function( data ) {
			guardian = JSON.parse(data);
			if(guardian[0].guardian_dob === null){

			}else{
				var newdt = guardian[0].guardian_dob.split('-');
				$('#txtGDOB').val(newdt[2]+'/'+ newdt[1]+'/'+ newdt[0]);
			}

			$('#txtGuardian').val(guardian[0].guardian_name);
			$('#selGGender').val(guardian[0].guardian_gender);
			$('#txtGuardianAadhaar').val(guardian[0].guardian_aadhar);
			$('#txtGccupation').val(guardian[0].guardian_occupation);
			$('#txtAddrPermnt').val(guardian[0].permanent_address);
			$('#txtGGuardian').val(guardian[0].guardians_guardian);
			$('#txtMembershipID').val(guardian[0].share_member_id);
			$('#txtBankAC').val(guardian[0].bank_account);
			$('#txtBnkAcHolder').val(guardian[0].bank_account_holder);
			$('#txtBankName').val(guardian[0].bank_name);
			$('#txtBankBranch').val(guardian[0].bank_branch);
			$('#txtIFSC').val(guardian[0].IFSC_code);
			$('#txtPAN').val(guardian[0].pan_card);
		});
	}

function checkAadhar(){
	$('#scapeModalTitle').html('Enter Guardain Aadhar');
	$('#scapeModalBody').html('<div class="form-group"><label for="txtGuardianAadhaarCheckfirst">Guardian Aadhaar</label><input class="form-control" name="txtGuardianAadhaarCheckfirst" id="txtGuardianAadhaarCheckfirst" type="text"></div><div id="adhaarCheckStatus"></div>'+
  '<div class="form-group"><label for="txtGuardianAadhaar">Repeat Guardian Aadhaar</label><input onkeyup="checkAadharExist()" class="form-control" name="txtGuardianAadhaarCheck" id="txtGuardianAadhaarCheck" type="text"></div><div id="adhaarCheckStatus"></div>');
	$('#scapeModalFooter').css('display','none');
	$('#scapeModal').modal('show');
	$('#txtGuardianAadhaarCheckfirst, #txtGuardianAadhaarCheck').bind("cut copy paste",function(e) {
		e.preventDefault();
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
