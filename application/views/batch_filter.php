<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Application List, Filter &amp; Export </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background: #a0e0ed;">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="txtBatch">Select Batch</label>
						<select id="txtBatch" name="txtBatch" class="form-control selectpicker" data-live-search="true"
							onchange="getCandidatesFilter()">
							<option value=""></option>
							<?php foreach ($batches->result() as $batch) { ?>
							<option style="background-color: #eff2c2;"
								value="<?php echo $batch->id; ?>">
								<?php echo $batch->course.' '.$batch->year_span; ?>
							</option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="txtStatus">Select Status</label>
						<select id="txtStatus" name="txtStatus" class="form-control" onchange="getCandidatesFilter()">
							<option value="">All</option>
							<?php foreach ($status->result() as $stat) { ?>
							<option style="background-color: #eff2c2;"
								value="<?php echo $stat->status; ?>">
								<?php echo ucwords($stat->status); ?>
							</option>
							<?php } ?>
						</select>
					</div </div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="selYear">Select Year</label>
						<select id="selYear" name="selYear" class="form-control" autocomplete="off" disabled
							onchange="getCandidatesFilter()">
							<option value=""> - Select Year - </option>
							<option value="year 1">Year 1</option>
							<option value="year 2">Year 2</option>
							<option value="year 3">Year 3</option>
							<option value="year 4">Year 4</option>
							<option value="year 5">Year 5</option>
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<label for="selForanee">Forane</label>
					<select class="form-control" name="selForane" id="selForane"
						onchange="geteduforum(value,'selEduFrm')">
						<option value=""></option>
						<?php foreach ($forane->result() as $row) { ?>
						<option style="background-color: #c2f1f2;"
							value="<?php echo $row->id.'|'.$row->forane; ?>">
							<?php echo ucwords($row->forane); ?>
						</option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<i onclick="showModal('applExport')" title="Export to excel" aria-hidden="true"
							class="fa fa-file-excel-o"
							style="float: right;color: #00A65A; font-size: 20px; cursor: pointer;"></i>
						<label for="selEduFrm">Select Education Forum</label>
						<select id="selEduFrm" name="selEduFrm" class="form-control" onchange="getCandidatesFilter()">
							<option value="">All</option>

						</select>
					</div </div>
				</div>
			</div>
		</div>
	</div>
	<div class="box box-success" style="background-color: #d2d2d2;">
		<div id="boxResult" class="box-body w3-allerta">

		</div>
		<!-- /.box-body -->
	</div>
</section>
<?php include '_footer.php'; ?>
<script>
	$("body").addClass('sidebar-collapse');
	console.log("without transition");
</script>