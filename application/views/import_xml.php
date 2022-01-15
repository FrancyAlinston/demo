<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Import Tally XML Files To Close Accounts </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px">
		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<form autocomplete="off" enctype="multipart/form-data" action="" name="frmXml" id="frmXml" method="post">
						<div class="form-group">
							<label for="txtBatch">Import XML</label><br>
							<div class="btn btn-md btn-danger" onclick="$('#urlM').click()">Upload File</div>
							<input type="file" style="display: none;"  onchange="fileUploadBinary('xmlImportAcClose','frmXml')" name="urlM" id="urlM" class="form-control">
							<input type="hidden" name="txtxmlImportAcClose" id="txtxmlImportAcClose" value="xmlImportAcClose">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="box box-success">
		<div id="boxResult" class="box-body">

		</div>
		<!-- /.box-body -->
	</div>
</section>
<?php include '_footer.php'; ?>
<script>

</script>