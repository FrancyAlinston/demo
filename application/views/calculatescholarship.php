<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
	<h1>Scholarship Calculation</h1>
	<?php include '_breadcrumbs.php'; ?>
</section>
<section class="content">
	<form method="post" onsubmit="return porcessScholarship()" id="frmNewApplication" name="frmNewApplication">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<!-- general form elements -->
				<div class="box box-success" style="background-color: #96eba6;">
					<!-- /.box-header -->
					<div class="box-body  w3-allerta">
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label for="txtScholarshipAmount">Net Availale Amount</label>
											<input type="text" placeholder="" id="txtScholarshipAmount"
												name="txtScholarshipAmount" onkeyup="calculateCostPerPoint()"
												class="form-control" required>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="txtBenName">TotalPoints</label>
											<input type="text" placeholder="" id="txtPoints" name="txtPoints"
												class="form-control" required readonly
												value="<?php echo $points; ?>">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="txtBenName">Cost Per Point</label>
											<input type="text" placeholder="" id="txtcostPerPoints"
												name="txtcostPerPoints" class="form-control" required>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

				<div class="box box-primary" style="margin-top: 5px; background: #a0e0ed;">
					<div class="box-body w3-allerta" id="boxResult">
					</div>
				</div>

				<center><button class="btn btn-md btn-primary">Calcualte</button><span id="testres"></span></center>
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
<div id="popAccess" style="position: fixed;top:0px;left:0px;background: #000; width: 100%; height: 1000px">
	<div
		style="width:300px;height:200px;background: #fff;margin:0px auto;margin-top: 10%;padding:30px; border-radius: 8px">
		<div class="row">
			<div class="col-md-12">
				<p>Content is password protected</p>
				<div class="form-group">
					<label for="txtAccess">Pasword</label>
					<input type="password" class="form-control" name="txtAccess" id="txtAccess">
				</div>
				<span class="btn btn-danger" style="width: 100%" onclick="verifyAccess()">Submit</span>
			</div>
		</div>

	</div>
</div>
<?php include '_footer.php'; ?>
<script>
	function verifyAccess() {
		if ($('#txtAccess').val() == 'nidhi2018') {
			$('#popAccess').css('display', 'none');
		}
	}
</script>