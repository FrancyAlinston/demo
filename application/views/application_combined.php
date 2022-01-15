<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Forumwise Combined Filter &amp; Export </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background: #a0e0ed;">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="txtBatch">Select Batch</label>
						<select id="txtBatch" name="txtBatch" class="form-control" onchange="getForumwiseAggregate()">
							<option value=""></option>
							<?php foreach ($batches->result() as $batch) { ?>
							<option value="<?php echo $batch->id; ?>"><?php echo $batch->course.' '.$batch->year_span; ?> </option>
							<?php } ?>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="txtStatus">Select Status</label>
						<select id="txtStatus" name="txtStatus" class="form-control" onchange="getForumwiseAggregate()">
							<option value="">All</option>
							<?php foreach ($status->result() as $stat) { ?>
							<option value="<?php echo $stat->status; ?>"><?php echo ucwords($stat->status); ?> </option>
							<?php } ?>
						</select>
						</div
					</div>
				</div>
				<div class="col-md-4">
					<i style="float: right;color: #00A65A; font-size: 20px; cursor: pointer;" class="fa fa-file-excel-o" aria-hidden="true" title="Export to excel" onclick="exportForumwiseAggr()"></i>
				</div>
			</div>
		</div>
	</div>
		<div class="box box-success" style="background: #91ce93;">
			<div id="boxResult" class="box-body w3-allerta">

			</div>
			<!-- /.box-body -->
		</div>
	</section>
	<?php include '_footer.php'; ?>
	<script>

	</script>
