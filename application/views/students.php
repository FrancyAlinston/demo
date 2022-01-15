<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Cadidates Admitted as Students</h1>
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
				<div class="col-md-8">
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
					        <div class="btn btn-md btn-primary" onclick="studentCandidates()">View Candidates</div>
					        <i onclick="exportStudentCandidates()" title="Export to excel" aria-hidden="true" class="fa fa-file-excel-o" style="float: right;color: #00A65A; font-size: 34px; cursor: pointer;"></i>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
		<div class="box box-success" style="background-color: #d0fae3;">
			<div id="boxResult" class="box-body w3-allerta">

			</div>
			<!-- /.box-body -->
		</div>
	</section>
	<?php include '_footer.php'; ?>
	<script>

	</script>