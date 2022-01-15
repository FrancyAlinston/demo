<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Import Beneficary Deposit File [tally export excel]</h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background: #a0e0ed;">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-6">
					<form autocomplete="off" enctype="multipart/form-data" action="" name="frmExel" id="frmExel" method="post">
						<div class="form-group">
							<label for="txtBatch">Import Excel File</label><br>
							<div class="btn btn-md btn-danger" onclick="$('#urlM').click()">Upload File</div>
							<input type="file" style="display: none;"  onchange="fileUploadBinary('exlBenDeposit','frmExel')" name="urlM" id="urlM" class="form-control">
							<input type="hidden" name="txtexlBenDeposit" id="txtexlBenDeposit" value="">
						</div>
					</form>
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
