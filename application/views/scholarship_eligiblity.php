<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
	<h1>Check Applicant Eligibility </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background-color: #aee4f1;">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="txtBatch">Search Applicant</label>
						<input type="text" id="txtSearch" name="txtSearch" class="form-control" placeholder="Search..."
							onkeyup="searchAndCheckEleigibile(value,'txtSearch')" autocomplete="off">
					</div>
				</div>
			</div>
		</div>
</section>
<section class="content">
	<form method="post" onsubmit="return saveShareApp()" id="frmNewApplication" name="frmNewApplication">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-success" style="background-color: #575454;">
					<div class="box-header with-border">
						<h3 class="box-title" style="color: white;">Applicant Profile</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body w3-allerta" id="resultPlane" style="background-color: #a5a5a5;">

						<!-- /.box-body -->
					</div>
					<!-- /.box -->

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

	$(function() {
		$('#txtFrom,#txtTo').inputmask('dd/mm/yyyy', {
			'placeholder': 'dd/mm/yyyy'
		});
		$('#txtFrom,#txtTo').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});

	});

	$("body").addClass('sidebar-collapse');
	console.log("without transition");
</script>