<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Beneficary List, Filter &amp; Export </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background: #a0e0ed;">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-3">
					<label for="selForanee">Forane</label>
					<select class="form-control" name="selForane" id="selForane"
						onchange="geteduforum(value,'selEduFrm')">
						<option value=""></option>
						<?php foreach ($forane->result() as $row) { ?>
						<option
							value="<?php echo $row->id.'|'.$row->forane; ?>">
							<?php echo ucwords($row->forane); ?>
						</option>
						<?php } ?>
					</select>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="selEduFrm">Select Education Forum</label>
						<select id="selEduFrm" name="selEduFrm" class="form-control" onchange="getBeneficaryFilter()">
							<option value="">All</option>
						</select>
					</div </div>
				</div>
				<div class="col-md-3"></div>
				<div class="col-md-3">
					<i onclick="showModal('benExport')" title="Export to excel" aria-hidden="true"
						class="fa fa-file-excel-o"
						style="float: right;color: #00A65A; font-size: 50px; cursor: pointer;"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="box box-success" style="background-color: #a5a5a5;">
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