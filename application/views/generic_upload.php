<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Upload Files </h1>
	<div class="box box-info" style="margin-top: 5px">
		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<form autocomplete="off" enctype="multipart/form-data" action="" name="frmGen" id="frmGen" method="post">
						<div class="form-group">
							<div class="btn btn-md btn-danger" onclick="$('#urlM').click()">Upload File</div>
							<input type="file" style="display: none;"  onchange="fileUploadBinary('Generic','frmGen')" name="urlM" id="urlM" class="form-control">
							<input type="hidden" name="txtGeneric" id="txtGeneric" value="txtGeneric">
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
