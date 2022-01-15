<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
//print_r($candidate);
?>
<section class="content-header">
	<h1>New Application </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="txtBatch">Select Batch</label>
						<select id="txtBatch" name="txtBatch" class="form-control selectpicker" data-live-search="true">
							<option value=""></option>
							<?php foreach ($batches->result() as $batch) { ?>
							<option
								value="<?php echo $batch->id.'|'.$batch->abbr; ?>">
								<?php echo $batch->course.' '.$batch->year_span; ?>
							</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="txtBatch">Members Search</label>
						<input type="text" id="txtSearch" name="txtSearch" class="form-control" placeholder="Search..."
							onkeyup="searchAndAdd(value,'txtSearch')" autocomplete="off">
					</div>
				</div>
			</div>
		</div>
	</div>

</section>
<section class="content">
	<form method="post" onsubmit="return saveApplication()" id="frmNewApplication" name="frmNewApplication">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-success" style="background: #dfdccb;">
					<div class="box-header with-border">
						<h3 class="box-title">Applicant Pofile</h3>
						alert(onlick);
					</div>
					<!-- /.box-header -->
					<div class="box-body w3-allerta">
						<div class="row">
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtBenName">NES ID</label>
											<input type="text" placeholder="NES ID [members only]" id="txtNesId"
												name="txtNesId" class="form-control" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="selGender">Student Name</label>
											<input type="text" placeholder="Students Name" id="txtStudName"
												name="txtStudName" class="form-control" required>
										</div>
									</div>

									<!-- Card row end -->
								</div>
								<div class="row">


									<div class="col-md-6">
										<div class="form-group">
											<label for="txtGuardian">Parent Name</label>
											<input class="form-control" name="txtGuardian" id="txtGuardian" required=""
												type="text">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="selGender">Gender</label>
											<select required="" name="selGender" id="selGender" class="form-control">
												<option value="Male">Male</option>
												<option value="Female">Female</option>
											</select>
										</div>
									</div>
								</div>
								<!-- Card row end -->
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtSchool">School Name</label>
											<input type="text" placeholder="School Name" id="txtSchool" name="txtSchool"
												class="form-control typeahead" data-provide="typeahead">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtMedium">Medium</label>
											<select id="txtMedium" name="txtMedium" class="form-control">
												<option value=""></option>
												<option value="Malayalam">Malayalam</option>
												<option value="English">English</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtSyllabus">Syllabus</label>
											<select id="txtSyllabus" name="txtSyllabus" class="form-control">
												<option value=""></option>
												<option value="State">State</option>
												<option value="CBSE">CBSE</option>
												<option value="ICSE">ICSE</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtAddrTemp">Education Forum [Parish]</label>
											<input type="text" placeholder="Education Forum [Parish]" id="txtEduFrm"
												name="txtEduFrm" class="form-control" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtBCCNum">BCC Number</label>
											<input type="text" id="txtBCCNum" name="txtBCCNum" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtBCCName">BCC Name</label>
											<input type="text" id="txtBCCName" name="txtBCCName" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtemail"> Email Address</label>
											<input id="txtemail" placeholder="Email" name="email" class="form-control"
												type="text">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtPhone">Phone</label>
											<input type="text" placeholder="Phone Number" id="txtPhone" name="txtPhone"
												class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtReceipt">Receipt Number</label>
											<input type="text" placeholder="Receipt Number" id="txtReceipt"
												name="txtReceipt" class="form-control">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtPhoneSec">WhatsApp Number</label>
											<input type="text" placeholder="Phone Number" id="txtPhoneSec"
												name="txtPhoneSec" class="form-control">
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<!-- 								<div class="row">
								<div class="col-md-12">
										<div class="form-group">
											<label for="txtIdDirect">Enrolment Number</label>
											<input type="text" class="form-control" name="txtIdDirect" id="txtIdDirect" placeholder="Enrolment Number" required>
										</div>
									</div>
								</div> -->
								<div class="row">
									<div class="col-md-12">
										<div class="form-group" style="text-align: center;">
											<img src="<?php echo $site_url; ?>/assets/images/pofilepic.png"
												alt="Upload a recent photograph"
												style="cursor: pointer; border: 1px solid #ccc"
												onclick="$('#urlP').click()" id="profilePicture" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

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
<?php include '_footer.php'; ?>
<script>
	var options = {
		url: function(phrase) {
			return site_url + "xhr/schoolsuggest/?term=" + phrase;
		},
		list: {
			maxNumberOfElements: 12,
			match: {
				enabled: false
			}
		},
		getValue: "school"
	};
	var edufrm = {
		url: function(phrase) {
			return site_url + "xhr/eduformsuggest/?term=" + phrase;
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
	$("#txtSchool").easyAutocomplete(options);
</script>