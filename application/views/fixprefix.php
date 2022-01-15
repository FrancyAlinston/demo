<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Import Exam File </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background: #a0e0ed;">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-4">

					<div class="form-group">
						<label for="txtrealPrefix">Prefix</label>
						<input class="form-control" type="text" id="txtPrefix" name="txtPrefix">
					</div>
				</div>
				<div class="col-md-8">
					<form autocomplete="off" enctype="multipart/form-data" action="" name="frmEexam" id="frmEexam" method="post">
						<div class="form-group">
						<label for="txtBatch">Import CSV File to fix candiate ID Prefix</label><br>
						<div class="btn btn-md btn-danger" onclick="$('#urlM').click()">Upload File</div>
			<input type="file" style="display: none;"  onchange="fileUploadBinary('prefix','frmEexam')" name="urlM" id="urlM" class="form-control">
			<input type="hidden" name="txtexammarks" id="txtexammarks">
			<input type="hidden" name="txtprefix" id="txtprefix">

		</div>
	</form>

				</div>
				<div class="col-md-6">


				</div>
			</div>
		</div>
	</div>

		<div class="box box-success" style="background-color: #96eba6;">
			<div id="boxResult" class="box-body w3-allerta">

			</div>
			<!-- /.box-body -->
		</div>
	</section>
	<?php include '_footer.php'; ?>
	<script>

	</script>