<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
	<h1>
		Beneficiary Pofile <small>[ ID : <?php echo $beneficiary->old_id; ?> ] [ Status :
			<?php $color = 'red'; if($beneficiary->status == 'active'){ $color = 'green';} ?>
			<span id="btnBenStatus" style="color:<?php echo $color;?>; cursor:pointer" onclick="getBenStatus('<?php echo $beneficiary->old_id; ?>')">
				<?php echo ucwords($beneficiary->status); ?></span> ] <span id="shareInfo"></span></small>
			</h1>
			<ol class="breadcrumb" style="margin-top:-20px">
				<li><a style="font-size: 18px; color:#0073B7" href="<?php echo $site_url; ?>beneficiary/makeprint/<?php echo $beneficiary->id; ?>" target="_blank"><i class="fa fa-book"></i> Print PassBook</a><br>
					<?php if($beneficiary->passbook_print_date != ''){ ?>
					  [ Last Printed on <?php echo makedate($beneficiary->passbook_print_date); ?> ]</li>
				  <?php }else{ ?>
						[ Not Yet Printed ]
					<?php }?>
			</ol>
		</section>
		<input type="hidden" id="shareBenId" name="shareBenId" value="<?php echo $beneficiary->old_id; ?>">
		<section class="content">
			<form method="post" onsubmit="return updateBen()" id="frmAddBeneficiary">
				<div class="row">
					<!-- left column -->
					<div class="col-md-12">
						<!-- general form elements -->
						<div class="box box-primary" style="background: #85b6f7;">
							<div class="box-header with-border" style="text-align: right;">
								<span id="benEdit" style="cursor: pointer;" onclick="editBen()"><i title="Edit Beneficiary"  class="fa fa-edit"></i>
									Edit Beneficiary</span><!--  |
										<span style="cursor: pointer;" onclick="closeBen('<?php echo $beneficiary->old_id; ?>')">Close Account</span> -->
										<input type="hidden" name="txtId" class="txtId" value="<?php echo $beneficiary->id; ?>" id="txtId">
									</div>
									<!-- /.box-header -->
									<div class="box-body w3-allerta">
										<div class="row">
											<div class="col-md-8">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="txtBenName">Beneficiary Name</label>
															<input type="text" placeholder="Enter Name" id="txtBenName" name="txtBenName" class="form-control" required value="<?php echo $beneficiary->name; ?>">
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
															<input type="text" id="txtDOB" name="txtDOB" class="form-control" required value="<?php echo makedate($beneficiary->dob); ?>">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="txtPhone">Phone</label>
															<input type="text" placeholder="Phone Number" id="txtPhone" name="txtPhone" class="form-control" value="<?php echo $beneficiary->phone; ?>">
														</div>
													</div>

												</div>
												<!-- Card row end -->
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="txtEmail">Email</label>
															<input type="email" placeholder="Email" id="txtEmail" name="txtEmail" class="form-control" value="<?php echo $beneficiary->email; ?>">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="txtAadhaar">Aadhaar Number</label>
															<input type="text" id="txtAadhaar" name="txtAadhaar" class="form-control" value="<?php echo $beneficiary->aadhaar; ?>" >
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label for="txtGuardianRel">Guardian's Relation</label>
															<input type="text" class="form-control" name="txtGuardianRel" id="txtGuardianRel" required value="<?php echo $beneficiary->guardian_relation; ?>">
														</div>
													</div>
												</div>

											</div>
											<div class="col-md-4">
												<div class="col-md-12">
													<div class="form-group" style="text-align: center;">
														<img src="<?php echo $site_url; ?>profilephotos/<?php echo $beneficiary->photoid; ?>" alt="Upload a recent photograph" style="cursor: pointer; border: 1px solid #ccc" onclick="$('#urlP').click()" id="profilePicture" data-value="<?php echo $beneficiary->photoid; ?>" />
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /.box-body -->
								</div>
								<!-- /.box -->

								<!-- Form Element sizes -->
								<div class="box box-success" id="ParrentsProfile" style="background: #7efba9;">
									<div class="box-header with-border">
										<h3 class="box-title">Parent Profile</h3>
									</div>
									<div class="box-body w3-allerta">
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label for="txtGuardian">Guardian Name</label>
													<input type="text" class="form-control" name="txtGuardian" id="txtGuardian" required value="<?php echo $beneficiary->guardian_name; ?>">
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
											<!-- <div class="col-md-2">
												<div class="form-group">
													<label for="txtGuardianRel">Guardian's Relation</label>
													<input type="text" class="form-control" name="txtGuardianRel" id="txtGuardianRel" required value="<?php echo $beneficiary->guardian_relation; ?>">
												</div>
											</div> -->
											<div class="col-md-3">
												<div class="form-group">
													<label for="txtGuardianPhone">Guardian's Phone</label>
													<input type="text" class="form-control" name="txtGuardianPhone" id="txtGuardianPhone" required value="<?php echo $beneficiary->guardian_phone; ?>">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="txtGuardianAadhaar">Guardian's Aadhaar</label>
													<input type="text" class="form-control" name="txtGuardianAadhaar" id="txtGuardianAadhaar" value="<?php echo $beneficiary->guardian_aadhar; ?>" >
												</div>

											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label for="txtAddrPermnt">Permanent Address</label>
													<textarea placeholder="Permanent Address" id="txtAddrPermnt" name="txtAddrPermnt" class="form-control" required><?php echo $beneficiary->permanent_address; ?></textarea>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="txtGDOB">Date Of Birth</label>
													<input type="text" id="txtGDOB" name="txtGDOB" class="form-control" value="<?php echo makedate($beneficiary->guardian_dob); ?>" required>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="txtGccupation">Occupation</label>
													<input type="text" id="txtGccupation" name="txtGccupation" class="form-control" value="<?php echo $beneficiary->guardian_occupation; ?>" required>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="txtGGuardian">Guardain's Guardian Name</label>
													<input type="text" id="txtGGuardian" name="txtGGuardian" class="form-control" value="<?php echo $beneficiary->guardians_guardian; ?>" required >
												</div>
											</div>
										</div>

										<!-- Card row end -->
									</div>
									<!-- /.box-body -->
								</div>
								<!-- /.box -->

								<div class="box box-info" id="NomineeProfile" style="background: #7ee3fb;">
									<div class="box-header with-border">
										<h3 class="box-title">Nominee Profile</h3>
									</div>
									<div class="box-body w3-allerta">
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label for="txtNominee">Nominee Name</label>
													<input type="text" class="form-control" name="txtNominee" id="txtNominee" value="<?php echo $beneficiary->nominee_name; ?>">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="txtNomineeRel">Nominee's Relation</label>
													<input type="type" class="form-control" name="txtNomineeRel" id="txtNomineeRel" value="<?php echo $beneficiary->nominee_relation; ?>">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="txtNomineePhone">Nominee's Phone</label>
													<input type="text" class="form-control" name="txtNomineePhone" id="txtNomineePhone" value="<?php echo $beneficiary->nominee_phone; ?>">
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="txtNomineeAadhaar">Nominee Aadhaar</label>
													<input type="text" class="form-control" name="txtNomineeAadhaar" id="txtNomineeAadhaar" value="<?php echo $beneficiary->nominee_aadhar; ?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-3">
												<div class="form-group">
													<label for="txtAddrTemp">Nominee Address</label>
													<textarea placeholder="Nominee Address" id="txtAddrTemp" name="txtAddrTemp" class="form-control"><?php echo $beneficiary->temporary_address; ?></textarea>
												</div>
											</div>
										</div>

										<!-- Card row end -->
									</div>
									<!-- /.box-body -->
								</div>
								<!-- /.box -->

								<div class="box box-primary" id="nidhiControls" style="background: #85b6f7;">
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
														<option value="1">Enrolled</option>
														<option value="0">Not Enrolled</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="txtSchool">Membership ID <small><?php if( isset($membership->entry_date)){ ?>[ Member Since <?php echo $membership->entry_date;?>]<?php } ?> </small></label>
													<input type="text" class="form-control" name="txtMembershipID" id="txtMembershipID" value="<?php echo $beneficiary->share_member_id; ?>" onkeypress="return false;" placeholder="Click to check Membership status">
												</div>
											</div>
											<div class="col-md-4" style="padding-top:25px">

												<span class="btn btn-md btn-primary" onclick="showModal('viewShares')">View Shares</span>
												<span class="btn btn-md btn-success" onclick="showModal('createShare')"><i class="fa fa-plus"></i> Issue New Share</span>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="txtReceipt">Initial Payment</label>
													<input type="text" required class="form-control" name="txtInitialPay" id="txtInitialPay" placeholder="Initial Payment" value="<?php echo $beneficiary->initial_payment; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="txtReceipt">Receipt Number</label>
													<input type="text" required class="form-control" name="txtReceipt" id="txtReceipt" placeholder="Receipt Number" value="<?php echo $beneficiary->receipt_number; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="txtDOB">Receipt Date</label>
													<input type="text" id="txtReceiptDate" name="txtReceiptDate" class="form-control" required value="<?php echo makedate($beneficiary->receipt_date);
													?>">
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
													<input type="text" class="form-control" name="txtSchool" id="txtSchool" value="<?php echo $beneficiary->school; ?>">
												</div>
											</div>
											<div class="col-md-3 tags-invisible" >
												<div class="form-group">
													<label for="txtMedium">Medium</label>
													<select class="form-control" name="txtMedium" id="txtMedium">
														<option value=""></option>
														<option value="English">English</option>
														<option value="Malayalam">Malayalam</option>
													</select>
												</div>
											</div>
											<div class="col-md-3 tags-invisible" >
												<div class="form-group">
													<label for="txtSyllabus">Syllabus</label>
													<select class="form-control" name="txtSyllabus" id="txtSyllabus">
														<option value=""></option>
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
													<input type="text" class="form-control" name="txtCollege" id="txtCollege" value="<?php echo $beneficiary->college; ?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 tags-invisible">
												<div class="form-group">
													<label for="txtQualification">Qualification</label>
													<input type="text" data-role="tagsinput" class="form-control" name="txtQualification" id="txtQualification" value="<?php echo $beneficiary->qualification; ?>">
													<button type="button" class="btn btn-md btn-primary" onclick="showModal('qualification')">+ Add Qualification</button>
												</div>
											</div>
										</div>
									</div>
									<!-- /.box-body -->
								</div>
								<!-- /.box -->


								<div class="box box-info" style="background: #7ee3fb;">
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
														<option value="1|cathedral">Cathedral</option>
														<option value="2|vaduthala">Vaduthala</option>
														<option value="3|Kaloor">Kaloor</option>
														<option value="4|thykoodam">Thykoodam</option>
														<option value="5|kalamassery">Kalamassery</option>
														<option value="6|aluva">Aluva</option>
														<option value="7|koonammavu">Koonammavu</option>
														<option value="8|vypin">Vypin</option>
													</select>
												</div>
											</div><div class="col-md-4">
												<div class="form-group">
													<label for="selEduFrm">Education Forum</label>
													<select class="form-control" name="selEduFrm" id="selEduFrm">
													</select>
													<input type="hidden" id="setEduFrm" value="<?php echo $beneficiary->education_forum; ?>">
												</div>
											</div>
										</div>
										<div class="row">

											<div class="col-md-4">
												<div class="form-group">
													<label for="txtBCCNum">BCC Number</label>
													<input type="text" class="form-control" name="txtBCCNum" id="txtBCCNum" value="<?php echo $beneficiary->bcc_number; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="txtBCCName">BCC Name</label>
													<input type="text" class="form-control" name="txtBCCName" id="txtBCCName" value="<?php echo $beneficiary->bcc_name; ?>">
												</div>
											</div>
										</div>
									</div>
									<!-- /.box-body -->
								</div>
								<!-- /.box -->

								<!-- Input addon -->
								<div class="box box-danger"  style="background: #fbb7ba;">
									<div class="box-header with-border">
										<h3 class="box-title">Bank Details</h3>
									</div>
									<div class="box-body w3-allerta">
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="txtBankAC">Bank Account Number</label>
													<input type="text" id="txtBankAC" name="txtBankAC" class="form-control" value="<?php echo $beneficiary->bank_account_number; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="">Confirm Bank Account Number</label>
													<input type="text" id="" name="" class="form-control" style="background-color: #3CBC8D;">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="txtBnkAcHolder">Account Holder Name</label>
													<input type="text" id="txtBnkAcHolder" name="txtBnkAcHolder" class="form-control" value="<?php echo $beneficiary->bank_account_holder_name; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="txtBankName">Bank Name</label>
													<input type="text" id="txtBankName" name="txtBankName" class="form-control" value="<?php echo $beneficiary->bank_name; ?>">
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="txtBankBranch">Bank Branch</label>
													<input type="text" id="txtBankBranch" name="txtBankBranch" class="form-control" value="<?php echo $beneficiary->bank_branch; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="txtIFSC">IFSC Code</label>
													<input type="text" id="txtIFSC" name="txtIFSC" class="form-control" value="<?php echo $beneficiary->ifsc_code; ?>">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="">Confirm IFSC Code</label>
													<input type="text" id="" name="" class="form-control" style="background-color: #3CBC8D;">
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="txtPAN">PAN Card</label>
													<input type="text" id="txtPAN" name="txtPAN" class="form-control" value="<?php echo $beneficiary->pan_card; ?>">
												</div>
											</div>
										</div>
									</div>
									<!-- /.box-body -->
								</div>
								<!-- /.box -->
								<div class="box box-primary">
									<div class="box-header with-border w3-allerta">
										<h3 class="box-title">Navadarsan Enrolment History</h3>
									</div>
									<div class="box-body w3-allerta" id="enHistory">
										<?php if(count($nav_history->result()) > 0){ ?>
											<table class="table table-bordered table-hover dataTable table-condensed" style="background: #fff">
												<tbody>
													<thead>
														<tr>
															<th width="30%">Course ID</th>
															<th width="30%">Status</th>
															<th width="30%">Receipt</th>
															<th style="text-align: center;" width="30%">Action</th>
														</tr>
													</thead>

													<?php foreach ($nav_history->result() as $row) { ?>
														<tr>
															<td><?php echo $row->generated_id; ?></td>
															<td><?php echo ucwords($row->status); ?></td>
															<td><?php echo ucwords($row->receipt); ?></td>
															<td align="center"><a href="<?php echo $site_url; ?>batch/editapplication/?id=<?php echo $row->id; ?>&t=<?php echo time(); ?>" class="btn btn-primary btn-xs" target="_blank"> View Enrolment Profile </div></td>
															</tr>

														<?php } ?>
													</tbody>
												</table>
											<?php } ?>
										</div>
									</div>
									<center><button id="updateBtn" style="display: none" class="btn btn-md btn-primary" >Update</button></center>
								</div>
								<!--/.col (left) -->
							</div>
							<!-- /.row -->
						</form>
						<form autocomplete="off" enctype="multipart/form-data" action="" name="singleFileUpload" id="singleFileUpload" method="post">

							<div class="input-group">
								<input type="file" style="display:none" onchange="fnsingleFileUpload('profilePicture')" name="urlP" id="urlP" class="form-control">
								<input type="hidden" name="stamp" value="23231231" id="stamp">
							</div>
						</form>
					</section>
					<!-- Open to edit or Open to view -->
					<input type="hidden" name="editmode" id="editmode" value="<?php echo $mode;?>">
					<?php include '_footer.php'; ?>
					<script>
					$(function(){


						// set options
						$('#selGender').val('<?php echo $beneficiary->gender; ?>');
						$('#txtMedium').val('<?php echo $beneficiary->medium; ?>');
						$('#txtSyllabus').val('<?php echo $beneficiary->syllabus; ?>');
						$('#selIsNidhi').val('<?php echo $beneficiary->is_nidhi; ?>');
						$('#selGGender').val('<?php echo $beneficiary->guardian_gender; ?>');

						$('#selForane').val('<?php echo $beneficiary->forane; ?>').change();


						if($('#editmode').val() == 'view') {
							$('#frmAddBeneficiary input, #frmAddBeneficiaryselect, #frmAddBeneficiary textarea').attr('disabled','disabled');
							$('#frmAddBeneficiary input, #frmAddBeneficiary select, #frmAddBeneficiary textarea').addClass('input-disabled');
						}
						getBenStatus('<?php echo $beneficiary->old_id; ?>');
						genNidhiEnrolBtn();

						// Get
						$.post(site_url + 'scholarship/yearlyamt',{oldID:'<?php echo $beneficiary->old_id; ?>'}).done(function(data) {
						     $('#enHistory').append(data);
						});


					});

					function genNidhiEnrolBtn(){
						if($('#selIsNidhi').val() == 0){
							$('#nidhiEnrollbtn').html('<div class="btn btn-danger" onclick="checkNidhiMembership()">Enroll Now</div>');
						}else{
							$('#nidhiEnrollbtn').html('<div class="btn btn-xs btn-success">Nidhi Enroled</div>')
						}
					}

					function editBen(){

						$('#frmAddBeneficiary input, #frmAddBeneficiary select, #frmAddBeneficiary textarea').removeAttr('disabled');
						$('#frmAddBeneficiary input, #frmAddBeneficiary select, #frmAddBeneficiary textarea').not('#ParrentsProfile input, #ParrentsProfile select, #ParrentsProfile textarea').removeClass('input-disabled');
						$('#ParrentsProfile input, #ParrentsProfile select, #ParrentsProfile textarea').removeAttr('disabled').attr('readonly','readonly');
						$('#benEdit').replaceWith('<span style="color:#00A65A">Edit Mode</span>');
						$('#txtDOB,#txtReceiptDate,#txtGDOB').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
						$('#txtDOB,#txtReceiptDate,#txtGDOB').datepicker({
							autoclose: true,
							format: 'dd/mm/yyyy'
						});
						$('#updateBtn').css('display','');


					}

					function closeBen(id){
						if(confirm("Are you sure to close the accont for "+id)){
							$.post( site_url+'beneficiary/closeben',{ id: id}).done( function( data ){
								alert(data);
								document.location.reload();
							});
						}
					}
					// Suggest School
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
					$(window).on("load", function (e) {
						$.post(site_url+'share/getsharedetails',{holderID:$('#shareBenId').val()}).done( function( data ) {
							$('#shareInfo').html(data);
						});
					});
				</script>
				<style type="text/css">
				.input-disabled{
					background-color:#fff !important;
				}

			</style>
