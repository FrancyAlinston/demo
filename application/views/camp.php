<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Application List, Filter &amp; Export </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px">
		<div class="box-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="txtBatch">Select Batch</label>
						<select id="txtBatch" name="txtBatch" class="form-control selectpicker" data-live-search="true" onchange="getCampFilter()">
							<option value=""></option>
							<?php foreach ($batches->result() as $batch) { ?>
							<option value="<?php echo $batch->id; ?>"><?php echo $batch->course.' '.$batch->year_span; ?> </option>
							<?php } ?>
						</select>
					</div>
				</div>
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
					<div class="form-group">
						<i onclick="showModal('applExport')" title="Export to excel" aria-hidden="true" class="fa fa-file-excel-o" style="float: right;color: #00A65A; font-size: 20px; cursor: pointer;"></i>
						<label for="selEduFrm">Select Education Forum</label>
						<select id="selEduFrm" name="selEduFrm" class="form-control" onchange="getCampFilter()">
							<option value="">All</option>

						</select>
						</div
					</div>
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