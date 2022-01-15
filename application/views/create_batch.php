<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header">
	<h1>
		Create Batch
		<small>Batch Based on Course & Year</small>
	</h1>
	<?php include '_breadcrumbs.php'; ?>
</section>
<section class="content">
	<form method="post" onsubmit="return createBatch()" id="frmCreateBatch">
		<div class="row">
			<!-- left column -->
			<div class="col-md-12">
				<div class="box box-info" style="background: #a0e0ed;">
					<div class="box-header with-border">
						<h3 class="box-title">Batch Details</h3>
					</div>
					<div class="box-body w3-allerta">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="txtCourseName">Course Name</label>
									<select class="form-control" name="SelCourseId" id="SelCourseId" required>
										<option value=''></option>
										<?php foreach ($courses->result() as $course) { ?>
										<option
											value="<?php echo $course->id; ?>">
											<?php echo $course->course; ?>
										</option>
										<?php } ?>

									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="selStartYear">Start year</label>
									<select name="selStartYear" id="selStartYear" class="form-control">
										<?php
                                for ($i = date("Y")-3; $i < date("Y")+10; $i++) {
                                    echo "<option value='".$i."'>" . $i . "</option>";
                                }
                                ?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="txtCourseAbbr">End year</label>
									<select name="selEndYear" id="selEndYear" class="form-control">
										<?php
                                for ($i = date("Y")-3; $i < date("Y")+10; $i++) {
                                    echo "<option value='".$i."'>" . $i . "</option>";
                                }
                                ?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="txtCourseNotes">Notes</label>
									<textarea class="form-control" name="txtCourseNotes" id="txtCourseNotes"></textarea>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<center><button class="btn btn-md btn-primary">Create Batch</button><span id="testres"></span></center>
				<br>
				<div class="box box-success" id="courseList" style="background-color: #96eba6;">
					<div class="box-header with-border">
						<h3 class="box-title">Batch List</h3>
					</div>
					<div class="box-body w3-allerta" id="boxResult">

					</div>
					<!-- /.box-body -->
				</div>
			</div>
			<!--/.col (left) -->
		</div>
		<!-- /.row -->
	</form>
	<div class="alert alert-warning alert-dismissible fade show" role="alert">
		<strong></strong>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<?php include '_footer.php'; ?>
	<script type="text/javascript">
		$(function() {
			loadWithPage('batchlist');
			$('#selStartYear').val(
				'<?php echo date("Y"); ?>');
			$('#selEndYear').val(
				'<?php echo date("Y"); ?>');
		});
	</script>