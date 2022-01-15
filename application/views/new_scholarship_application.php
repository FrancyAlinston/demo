<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
//print_r($candidate);
?>
<section class="content-header">
	<h1>New Scholarship Application </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background: #e4d8ad;">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="txtBatch">Members Search</label>
						<input type="text" id="txtSearch" name="txtSearch" class="form-control" placeholder="Search..."
							onkeyup="searchAndAdd(value,'txtSearch')" autocomplete="off">
					</div>
				</div>
				<div class="col-md-8" id="scolYearlyTran"></div>
			</div>
</section>
<section class="content">
	<form method="post" onsubmit="return saveScholoarshipApplication()" id="frmNewApplication" name="frmNewApplication">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-success" style="background: #abe0ba;">
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
												name="txtNesId" class="form-control" required>
										</div>
									</div>
									<!-- <div class="col-md-3">
										<div class="form-group">
											<label for="txtAppNum">Application Number</label>
											<input type="text" placeholder="Application Number" id="txtAppNum" name="txtAppNum" class="form-control" required>
										</div>
									</div> -->
									<div class="col-md-3">
										<div class="form-group">
											<label for="selGender">Student Name</label>
											<input type="text" placeholder="Students Name" id="txtStudName"
												name="txtStudName" class="form-control" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtGuardian">Parent Name</label>
											<input class="form-control" name="txtGuardian" id="txtGuardian" required=""
												type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="selGender">Gender</label>
											<select onchange="cal12Total()" class="form-control text-center"
												name="selGender" id="selGender" required="">
												<option value=""> -Select- </option>
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
											<input type="text" id="txtBCCNum" name="txtBCCNum" class="form-control">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtBCCName">BCC Name</label>
											<input type="text" id="txtBCCName" name="txtBCCName" class="form-control">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtPhone">Phone</label>
											<input type="text" placeholder="Phone Number" id="txtPhone" name="txtPhone"
												class="form-control" required>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtPhoneSec">Phone secondry</label>
											<input type="text" placeholder="Phone Secondry" id="txtPhoneSec"
												name="txtPhoneSec" class="form-control">
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

				<div class="box box-primary" style="margin-top: 5px; background: #b4f1ff;">
					<div class="box-body w3-allerta" id="boxResult">
					</div>
				</div>

				<div class="box box-danger" style="margin-top: 5px; background: #ffb4b7;">
					<div class="box-body w3-allerta">
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
							<div class="col-md-6">
								<div class="form-group" style="float:left;margin-right: 20px">
									<label for="chkplus2">+2</label>
									<input name="chkplus2" id="chkplus2" type="checkbox" value="1">
								</div>
								<div class="form-group" style="float:left;margin-right: 20px">
									<label for="chkCourseCertificate">Course Certificate</label>
									<input name="chkCourseCertificate" id="chkCourseCertificate" type="checkbox"
										value="1">
								</div>
								<div class="form-group" style="float:left;margin-right: 20px">
									<label for="chkMrklist">Marklist</label>
									<input name="chkMrklist" id="chkplus2" type="checkbox" value="1">
								</div>
							</div>
							<div class="col-md-4" id="yearlyTran2">
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
									<label for="txtA1">A+</label>
									<input onkeyup="cal12Total()" type="text" id="txtA1" name="txtA1"
										class="form-control" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="txtA">A</label>
									<input onkeyup="cal12Total()" type="text" id="txtA" name="txtA" class="form-control"
										autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="txtB1">B+</label>
									<input onkeyup="cal12Total()" type="text" id="txtB1" name="txtB1"
										class="form-control" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="txtB">B</label>
									<input onkeyup="cal12Total()" type="text" id="txtB" name="txtB" class="form-control"
										autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="txtC1">C+</label>
									<input onkeyup="cal12Total()" type="text" id="txtC1" name="txtC1"
										class="form-control" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="txtC">C</label>
									<input onkeyup="cal12Total()" type="text" id="txtC" name="txtC" class="form-control"
										autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="txtD1">D+</label>
									<input onkeyup="cal12Total()" type="text" id="txtD1" name="txtD1"
										class="form-control" autocomplete="off">
								</div>
							</div>
							<div class="col-md-1">
								<div class="form-group">
									<label for="txtD">D</label>
									<input onkeyup="cal12Total()" type="text" id="txtD" name="txtD" class="form-control"
										autocomplete="off">
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
							<div class="col-md-4">
								<div class="form-group">
									<label for="selPerfomance">Educational Perfomance</label>
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
									<input id="txtSpcialisation" name="txtSpcialisation" class="form-control"
										type="text" value="">
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
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtBCCName">Payee</label>
									<input style="background: yellow" type="text" id="txtPayee" name="txtPayee"
										class="form-control">
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
					</div>
				</div>
				<input type="hidden" name="txtAccountDate" id="txtAccountDate">

				<center><button class="btn btn-md btn-primary">Submit</button><span id="testres"></span></center>
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
<?php include '_footer.php';
