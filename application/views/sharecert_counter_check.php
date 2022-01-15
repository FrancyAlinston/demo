<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
	<h1>Share Certificate Counterfoil Acknowledgement </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background: #cbe88d;">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="txtBatch">Search Certificate</label>
						<input type="text" id="txtSearch" name="txtSearch" class="form-control" placeholder="Search..." onkeyup="searchAndAck(value,'txtSearch')" autocomplete="off">
					</div>
				</div>
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="txtBatch">Entries Counter</label>
						<input style="background:#fff;border:none" type="text" id="txtEntries" name="txtEntries" class="form-control" value="0" readonly autocomplete="off">
					</div>
				</div>
		</div>
	</div>
</section>
<section class="content ">
	<form method="post" onsubmit="return saveShareApp()" id="frmNewApplication" name="frmNewApplication">
		<div class="row ">
			<!-- left column -->
			<div class="col-md-12 ">
				<!-- general form elements -->
				<div class="box box-success " style="background: #64fdc7;">
					<div class="box-header with-border w3-allerta">
						<h3 class="box-title">Share Certificate Details</h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body w3-allerta" id="resultPlane">
						<table id="tablecerts" class="table table-bordered table-striped table-condensed table-hover dataTable" role="grid" style="background: #fff">
								<tr>
									<th>ID</th>
									<th>Beneficary ID</th>
									<th>Beneficary</th>
									<th>Guardain</th>
									<th>Education Forum</th>
									<th>Date</th>
								</tr>
							</table>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

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

	$(function(){
		$('#txtFrom,#txtTo').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
		$('#txtFrom,#txtTo').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});

	});
</script>
