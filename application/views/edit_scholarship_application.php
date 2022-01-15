<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
//print_r($candidate);
?>
<section class="content-header">
	<h1>Edit Scholarship Application / <span
			onclick="delScholoarshipApplication('<?php echo $candidate->generated_id; ?>')"
			class="btn btn-danger btn-xs">Delete</span></h1>
	<?php include '_breadcrumbs.php'; ?>
</section>
<section class="content">
	<form method="post" onsubmit="return updateScholoarshipApplication()" id="frmNewApplication"
		name="frmNewApplication">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-8" id="scolYearlyTran"></div>
		</div>
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-success" style="background: #a0e1a4;">
					<div class="box-header with-border">
						<h3 class="box-title">Applicant Pofile <span id="isNidhi"></span></h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body w3-allerta">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtBenName">NES ID</label>
											<input type="text" placeholder="NES ID [members only]" id="txtNesId"
												name="txtNesId" class="form-control" required
												value="<?php echo $candidate->nes_id; ?>">
										</div>
									</div>
									<!-- <div class="col-md-3">
										<div class="form-group">
											<label for="txtAppNum">Application Number</label>
											<input type="text" placeholder="Application Number" id="txtAppNum"
												name="txtAppNum" class="form-control"
												value="<1?php echo $candidate->app_num; ?>">
								</div>
							</div> -->
									<div class="col-md-3">
										<div class="form-group">
											<label for="">Generated ID</label>
											<input type="text" id="" name="" class="form-control"
												value="<?php echo $candidate->generated_id; ?>">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="selGender">Student Name</label>
											<input type="text" placeholder="Students Name" id="txtStudName"
												name="txtStudName" class="form-control" required
												value="<?php echo $candidate->name; ?>">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtGuardian">Parent Name</label>
											<input class="form-control" name="txtGuardian" id="txtGuardian" required=""
												type="text"
												value="<?php echo $candidate->gauardain; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="selGender">Gender</label>
											<select onchange="cal12Total()" class="form-control text-center"
												name="selGender" id="selGender" value="">
												<option>-Select- </option>
												<option value="1">Male</option>
												<option value="0">Female</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtAddrTemp">Education Forum [Parish]</label>
											<select id="txtEduFrm" name="txtEduFrm" class="form-control" required>
												<option value=""> - Select - </option>
												<?php foreach ($forums as $forum) {?>
												<option
													value="<?php echo $forum->eduforum; ?>">
													<?php echo $forum->eduforum; ?>
												</option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtBCCNum">BCC Number</label>
											<input type="text" id="txtBCCNum" name="txtBCCNum" class="form-control"
												value="<?php echo $candidate->bcc_number; ?>">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtBCCName">BCC Name</label>
											<input type="text" id="txtBCCName" name="txtBCCName" class="form-control"
												value="<?php echo $candidate->bcc_name; ?>">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtemail"> Email Address</label>
											<input id="txtemail" placeholder="Email" name="email" class="form-control"
												type="text"
												value="<?php echo $candidate->email; ?>">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtPhone">Phone</label>
											<input type="text" placeholder="Phone Number" id="txtPhone" name="txtPhone"
												class="form-control" required
												value="<?php echo $candidate->phone; ?>">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtPhoneSec">WhatsApp Number</label>
											<input type="text" placeholder="Phone Secondry" id="txtPhoneSec"
												name="txtPhoneSec" class="form-control"
												value="<?php echo $candidate->phone_sec; ?>">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="">Entry Date</label>
											<input type="text" placeholder="Entry Date" id="" name="	"
												class="form-control"
												value="<?php echo $candidate->entry_date; ?>">
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

				<!--div class="box box-primary" style="margin-top: 5px">
		<div class="box-body" id="boxResult">
		</div>
	</!--div-->
				<!--  Doc table starts-->
				<hr>
				<h2>Uploaded Documents</h2>
				<table class="table table-bordered table-striped table-responsive w3-allerta">
					<tr>
						<th>PlusTwo Marklist</th>
						<th>Course Certificate</th>
						<th>Marklist</th>
						<th>Rec Form</th>
					</tr>
					<tr style="cursor:pointer">
						<td
							onclick="loadScDoc('<?php echo $candidate->plustwo_file; ?>')">
							<?php echo $candidate->plustwo_file; ?>
						</td>
						<td
							onclick="loadScDoc('<?php echo $candidate->coursecert_file; ?>')">
							<?php echo $candidate->coursecert_file; ?>
						</td>
						<td
							onclick="loadScDoc('<?php echo $candidate->marklist_file; ?>')">
							<?php echo $candidate->marklist_file; ?>
						</td>
						<td
							onclick="loadScDoc('<?php echo $candidate->recform_file; ?>','http://navadarsan.com/')">
							<?php echo $candidate->recform_file; ?>
						</td>
					</tr>
				</table>
				<div id="scDocLoader" style="padding:5px;border:1px solid #ccc"></div><br>
				<!-- Doc table ends -->
				<div class="box box-danger" style="margin-top: 5px">
					<div class="box-body w3-allerta" style="background: #dfdccb;">
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<label for="selStatus">Application Status</label>
									<select class="form-control" name="selStatus" id="selStatus">
										<option value="Fresh">Fresh</option>
										<option value="Renewal">Renewal</option>
									</select>
								</div>
							</div>
							<div class="col-md-8">
								<div class="form-group" style="float:left;margin-right: 20px">
									<label for="chkplus2">+2</label>
									<input name="chkplus2" id="chkplus2" type="checkbox" value="1" <?php if ($candidate->plus_two == 1) {
    echo 'checked';
} ?>
									>
								</div>
								<div class="form-group" style="float:left;margin-right: 20px">
									<label for="chkCourseCertificate">Course Certificate</label>
									<input name="chkCourseCertificate" id="chkCourseCertificate" type="checkbox"
										value="1" <?php if ($candidate->course_certificate == 1) {
    echo 'checked';
} ?>
									>
								</div>
								<div class="form-group" style="float:left;margin-right: 20px">
									<label for="chkMrklist">Marklist</label>
									<input name="chkMrklist" id="chkplus2" type="checkbox" value="1" <?php if ($candidate->mark_list == 1) {
    echo 'checked';
} ?>
									>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h5 style="border-bottom: 1px solid #ccc; font-weight: bold;">12<sup>th</sup> Standard
									Marks</h5>
							</div>
						</div>
						<div class="row">
							<div class="col-md-1">
								<div class="form-group">
									<label for="txtA1">A+ (A1)</label>
									<input
										value="<?php echo $candidate->a1; ?>"
										onkeyup="cal12Total()" type="text" id="txtA1" name="txtA1" class="form-control"
										autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="txtA">A (A2)</label>
									<input
										value="<?php echo $candidate->a2; ?>"
										onkeyup="cal12Total()" type="text" id="txtA" name="txtA" class="form-control"
										autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="txtB1">B+ (B1)</label>
									<input
										value="<?php echo $candidate->b1; ?>"
										onkeyup="cal12Total()" type="text" id="txtB1" name="txtB1" class="form-control"
										autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="txtB">B (B2)</label>
									<input
										value="<?php echo $candidate->b2; ?>"
										onkeyup="cal12Total()" type="text" id="txtB" name="txtB" class="form-control"
										autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="txtC1">C+ (C1)</label>
									<input onkeyup="cal12Total()"
										value="<?php echo $candidate->c1; ?>"
										type="text" id="txtC1" name="txtC1" class="form-control" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="txtC">C (C2)</label>
									<input onkeyup="cal12Total()"
										value="<?php echo $candidate->c2; ?>"
										type="text" id="txtC" name="txtC" class="form-control" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="txtD1">D+ (D1)</label>
									<input onkeyup="cal12Total()"
										value="<?php echo $candidate->d2; ?>"
										type="text" id="txtD1" name="txtD1" class="form-control" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="txtD">D (D2)</label>
									<input onkeyup="cal12Total()"
										value="<?php echo $candidate->d2; ?>"
										type="text" id="txtD" name="txtD" class="form-control" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="txt12total">Total %</label>
									<input onkeyup="cal12Total()" type="text" id="txt12total" name="txt12total"
										class="form-control" autocomplete="off">
								</div>
							</div>
						</div>
						<h5 style="border-bottom: 1px solid #ccc; font-weight: bold;">Academic Details</h5>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="selCourse">Course</label>
									<select required id="selCourse" name="selCourse" class="form-control"
										onchange="cal12Total()">
										<option value=""> - Select - </option>
										<?php foreach ($courses as $course) { ?>
										<option
											value="<?php echo $course->points; ?>">
											<?php echo $course->course; ?>
										</option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="col-md-4" style="display: none">
								<div class="form-group">
									<label for="txtSpcialPoints">Special Points</label>
									<input onkeyup="cal12Total()" id="txtSpcialPoints" name="txtSpcialPoints"
										class="form-control" type="text" value="0">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtSpcialisation">Specialization</label>
									<input
										value="<?php echo $candidate->specialisation; ?>"
										id="txtSpcialisation" name="txtSpcialisation" class="form-control" type="text"
										value="specialisation">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="selPerfomance">Last Year Educational Perfomance</label>
									<select onchange="cal12Total()" id="selPerfomance" name="selPerfomance"
										class="form-control">
										<option value="0"> - Select - </option>
										<option value="4">90% Above</option>
										<option value="3">80% Above</option>
										<option value="2">65% Above</option>
										<option value="1">50% Above</option>
										<option value="0">Below 50%</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="institution">Institution Name</label>
									<input style="background: yellow" type="text" id="institution" name="institution"
										class="form-control"
										value="<?php echo $candidate->institution; ?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtyearofstudy">Year Of Study</label>
									<input type="text" id="txtyearofstudy" name="txtyearofstudy" class="form-control"
										value="<?php echo $candidate->study_year; ?>">
								</div>
							</div>
						</div>
						<h5 style="border-bottom: 1px solid #ccc; font-weight: bold;"></h5>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="selRegular">Regularity in Navadrasan</label>
									<select onchange="cal12Total()" class="form-control" name="selRegular"
										id="selRegular">
										<option value="0"> - Select - </option>
										<option value="3">Regular [minimum 12 deposits this year]</option>
										<option value="2">Upto 3 Lapses</option>
										<option value="0">4 to 6 Lapses</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="selMembershipPeriod">Membership Period</label>
									<select onchange="cal12Total()" class="form-control" name="selMembershipPeriod"
										id="selMembershipPeriod">
										<option value="0"> - Select - </option>
										<option value="3">Above 10</option>
										<option value="2">7 to 10 Years</option>
										<option value="1">5 to 6 years</option>
									</select>
								</div>
							</div>

							<div class="col-md-4" style="display:none;">
								<div class="form-group">
									<label for="totalPoints">Total Points</label>
									<input required class="form-control" type="text" name="totalPoints"
										id="totalPoints">
								</div>
							</div>
						</div>
						<h5 style="border-bottom: 1px solid #ccc; font-weight: bold;">Bank Details</h5>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtBCCName">Payee</label>
									<input style="background: yellow" type="text" id="txtPayee" name="txtPayee"
										class="form-control"
										value="<?php echo $candidate->payee; ?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="bankname">Bank Name</label>
									<input style="background: yellow" type="text" id="bankname" name="bankname"
										class="form-control"
										value="<?php echo $candidate->bankname; ?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="acname">Bank Account Number</label>
									<input style="background: yellow" type="text" id="acname" name="acname"
										class="form-control"
										value="<?php echo $candidate->acname; ?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="ifsc">IFSC code</label>
									<input style="background: yellow" type="text" id="ifsc" name="ifsc"
										class="form-control"
										value="<?php echo $candidate->ifsc; ?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="bcode">Bank Branch Code</label>
									<input style="background: yellow" type="text" id="bcode" name="bcode"
										class="form-control"
										value="<?php echo $candidate->bcode; ?>">
								</div>
								< </div>
							</div>
						</div>
						<input type="hidden" name="txtAccountDate" id="txtAccountDate">

						<center><button class="btn btn-md btn-primary">Submit</button><span id="testres"></span>
						</center>
					</div>
					<!--/.col (left) -->
				</div>
				<!-- /.row -->
	</form>
	<form autocomplete="off" enctype="multipart/form-data" action="" name="singleFileUpload" id="singleFileUpload"
		method="post">

		<div class="input-group">
			<input type="file" style="display:none" onchange="fnsingleFileUpload('profilePicture')" name="urlP"
				id="urlP" class="form-control">
			<input type="hidden" name="stamp" value="" id="stamp">
		</div>
	</form>
</section>

<!-- <div id="scDocLoader" style="padding:5px;border:1px solid #ccc"></div><br> -->
<?php include '_footer.php'; ?>
<script>
	$(function() {
		// set options
		$('#selGender').val('<?php echo $candidate->gender; ?>');
		$('#txtEduFrm').val('<?php echo $candidate->edu_forum; ?>');
		$('#selStatus').val('<?php echo $candidate->status; ?>');
		// $("#selCourse option").filter(function() {
		// 	return ($(this).text() ==
		// 		'<1?php echo $candidate->course_text; ?>');
		// }).prop('selected', true);
		$('#selPerfomance').val('<?php echo $candidate->performance; ?>');
		$('#selRegular').val('<?php echo $candidate->nav_regularity; ?>')
			.change();
		$('#selMembershipPeriod').val(
			'<?php echo $candidate->membership_period; ?>');

		getYearlyTransaction('<?php echo $candidate->nes_id; ?>');
	});
</script>