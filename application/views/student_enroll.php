<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
	<h1>Enroll Students </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background-color: #a0e0ed;">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="txtBatch">Select Batch</label>
						<select id="txtBatch" name="txtBatch" class="form-control" style="background-color: #afee92;">
							<option value="" ></option>
							<?php foreach ($batches->result() as $batch) { ?>
							<option style="background-color: #eff2c2;" value="<?php echo $batch->id; ?>"><?php echo $batch->course.' '.$batch->year_span; ?> </option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="txtBatch">Candidate Search</label>
						<input type="text"  id="txtSearch" name="txtSearch" class="form-control" placeholder="Application ID or Name" onkeyup="searchAndEditWithFilter(value,$('#txtBatch').val(),'txtSearch')" autocomplete="off">
					</div>
				</div>
				<div class="col-md-4">

				</div>
			</div>
		</div>
	</div>

</section>
<section class="content">
	<form method="post" onsubmit="return studentEnroll()" id="frmNewApplication" name="frmNewApplication">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-success" style="background-color: #eed9c7;">
					<div class="box-header with-border">
						<h3 class="box-title">Applicant Pofile <small> [ Application ID : <span id="appID"></span> ] [Course ID: <span id="spCourseId"></span>] [Status : <span id="spStatus"></span>]</small></h3>
						<input type="hidden" name="txtAppId" id="txtAppId">
					</div>
					<!-- /.box-header -->
					<div class="box-body w3-allerta">
						<div class="row">
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtBenName">NES ID</label>
											<input type="text" readonly placeholder="NES ID [members only]" id="txtNesId" name="txtNesId" class="form-control" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="selGender">Student Name</label>
											<input type="text" readonly placeholder="Students Name" id="txtStudName" name="txtStudName" class="form-control" required>
										</div>
									</div>

									<!-- Card row end -->
								</div>
								<div class="row">


									<div class="col-md-6">
										<div class="form-group">
											<label for="txtGuardian">Parent Name</label>
									<input class="form-control" name="txtGuardian" id="txtGuardian" required="" type="text" readonly>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="selGender">Gender</label>
											<select disabled required="" name="selGender" id="selGender" class="form-control">
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
											<input type="text" readonly placeholder="School Name" id="txtSchool" name="txtSchool" class="form-control typeahead"  data-provide="typeahead">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="txtMedium">Medium</label>
											<select disabled id="txtMedium" name="txtMedium" class="form-control" >
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
											<select disabled id="txtSyllabus" name="txtSyllabus" class="form-control" >
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
											<input type="text" readonly placeholder="Education Forum [Parish]" id="txtEduFrm" name="txtEduFrm" class="form-control" required >
										</div>
									</div>
								</div>
								<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="txtBCCNum">BCC Number</label>
									<input type="text" readonly id="txtBCCNum" name="txtBCCNum" class="form-control" >
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="txtBCCName">BCC Name</label>
									<input type="text" readonly id="txtBCCName" name="txtBCCName" class="form-control" >
								</div>
							</div>
						</div>

							</div>
							<div class="col-md-4" >
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="txtPhone">Phone</label>
											<input type="text" readonly placeholder="Phone Number" id="txtPhone" name="txtPhone" class="form-control" >
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="txtPhoneSec">Phone Secondry</label>
											<input type="text" readonly placeholder="Phone Number" id="txtPhoneSec" name="txtPhoneSec" class="form-control" >
										</div>
									</div>
								</div>
								<div class="row" id="activeInputs">
									<div class="col-md-12">
									<div class="form-group">
										<label for="selYear">Select Year</label>
										<select id="selYear" name="selYear" class="form-control" autocomplete="off">
											<option value=""> - Select Year - </option>
											<option value="year 1">Year 1</option>
											<option value="year 2">Year 2</option>
											<option value="year 3">Year 3</option>
											<option value="year 4">Year 4</option>
											<option value="year 5">Year 5</option>
										</select>
									</div>
								</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="txtReceipt">Receipt Number</label>
											<input type="text" placeholder="Receipt Number" id="txtReceipt" name="txtReceipt" class="form-control" required >
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="txtDate">Receipt Date</label>
											<input type="text" placeholder="dd/mm/yyyy" id="txtDate" name="txtDate" class="form-control" required >
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="txtAmount">Amount</label>
											<input type="text" placeholder="Amount" id="txtAmount" name="txtAmount" class="form-control" required >
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

				<center><button class="btn btn-md btn-primary" >Enroll Student</button><span id="testres"></span></center>
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
<style>
	@media print
   {
	#profilePicture{
		display: none;
	}
	input,select,textarea{
		border: none !important;
	}
	input::-webkit-input-placeholder { /* Chrome/Opera/Safari */
	color: #fff;
	}
	input::-moz-placeholder { /* Firefox 19+ */
	color: #fff;
	}
	input:-ms-input-placeholder { /* IE 10+ */
	color: #fff;
	}
	input:-moz-placeholder { /* Firefox 18- */
	color: #fff;
	}
   }
	 #activeInputs input, #activeInputs select{
		 color:red;
		 border:1px solid red;
	 }
</style>
<?php include '_footer.php'; ?>
<script>

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
	$("#txtSchool").easyAutocomplete(options);




$(function(){
	$('#txtDate').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
	$('#txtDate').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	});
});

	function addEditToForm(val) {
	    $('#searchSuggest').html('');
	    $('#searchSuggest').css('display', 'none');
	    $.post(site_url + "xhr/getapplicant", {
	        id: val
	    }).done(function(data) {

	        obj = JSON.parse(data);

	        // Set Fields
					$('#spStatus').html(obj[0].status);
	        $('#appID').html(obj[0].id);
	        $('#spCourseId').html(obj[0].generated_id);
	        $('#txtAppId').val(obj[0].id);
	        $('#txtNesId').val(obj[0].nes_id);
	        $('#txtStudName').val(obj[0].student_name);
	        $('#selGender').val(obj[0].gender);
	        $('#txtSchool').val(obj[0].school);
	        $('#txtMedium').val(obj[0].medium);
	        $('#txtSyllabus').val(obj[0].syllabus);
	        $('#txtGuardian').val(obj[0].guardian);
	        $('#txtEduFrm').val(obj[0].education_forum);
	        $('#txtPhone').val(obj[0].phone);
	        $('#txtPhoneSec').val(obj[0].phone_secondry);
	        $('#txtBCCNum').val(obj[0].bcc_number);
	        $('#txtBCCName').val(obj[0].bcc_name);
	        $('#txtReceipt').val(obj[0].enrolment_receipt);
					var enDate = obj[0].enrolment_date.split('-');
					enDate = enDate[2]+'/'+enDate[1]+'/'+ enDate[0];
					$('#txtDate').val(enDate);
					$('#txtAmount').val(obj[0].amount);

	        /*	 if(obj[0].photoid != null){
	          $('#profilePicture').attr('src',site_url+'profilephotos/'+obj[0].photoid);
	        }else{

	        $('#profilePicture').attr('src',site_url+'/assets/images/pofilepic.png');
	      }*/

	    });
	}
</script>
