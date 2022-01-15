<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Check Attendance </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background: #a0e0ed;">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<textarea name="txtEmpCode" style="min-height: 200px" id="txtEmpCode"
							class="form-control"></textarea>
					</div>
					<button class="btn btn-primary" onclick="fetchAbsenties()"> Fetch Details</button>
				</div>
				<div class="col-md-4">

					<div class="col-md-4">

					</div>
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