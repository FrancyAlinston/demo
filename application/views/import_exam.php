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
						<label for="txtBatch">Select Batch</label>
						<select id="txtBatch" name="txtBatch" class="form-control" >
							<option value=""></option>
							<?php foreach ($batches->result() as $batch) { ?>
							<option value="<?php echo $batch->id; ?>"><?php echo $batch->course.' '.$batch->year_span; ?> </option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<form autocomplete="off" enctype="multipart/form-data" action="" name="frmEexam" id="frmEexam" method="post">
						<div class="form-group">
						<label for="txtBatch">Import Exam</label><br>
						<div class="btn btn-md btn-danger" onclick="$('#urlM').click()">Upload File</div>
			<input type="file" style="display: none;"  onchange="fileUploadBinary('exammarks','frmEexam')" name="urlM" id="urlM" class="form-control">
			<input type="hidden" name="txtexammarks" id="txtexammarks">
		</div>
	</form>

				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-4">
							<label for="selForanee">Forane</label>
									<select class="form-control" name="selForane" id="selForane" onchange="geteduforum(value,'selEduFrm')">
										<option value=""></option>
									<?php foreach ($forane->result() as $row) { ?>
									<option value="<?php echo $row->id.'|'.$row->forane; ?>"><?php echo ucwords($row->forane); ?></option>
									<?php } ?>
								    </select>
						</div>
						<div class="col-md-4">
							<label for="selEduFrm">Education Forum</label>
									<select class="form-control" name="selEduFrm" id="selEduFrm" required>
										<option value=""></option>
									</select>
						</div>
						<div class="col-md-4">
							<label for="txtBatch"> &nbsp;</label><br>
					        <div class="btn btn-md btn-primary" onclick="examResults()">View Results</div>
					        <i onclick="exportExamResult()" title="Export to excel" aria-hidden="true" class="fa fa-file-excel-o" style="float: right;color: #00A65A; font-size: 34px; cursor: pointer;"></i>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div class="box box-danger">
			<div class="box-body">
				<div class="row">
					<div class="col-md-4">
						<label for="selEduFrm">Promote Students</label>
									<input class="form-control" name="txtCutOffMarks" id="txtCutOffMarks" placeholder="Enter Cut Off mark" required>

					</div>
					<div class="col-md-4">
						<label for="txtBatch"> &nbsp;</label><br>
						<div onclick="promotetointerview()" class="btn btn-success">Promote to Interview</div>
					</div>
					<div class="col-md-4">
					</div>
				</div>

			</div>
			<!-- /.box-body -->
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