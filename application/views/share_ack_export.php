<?php
defined('BASEPATH') or exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Share Certifiate Acknowledgement Export </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background: #a0e0ed;">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-3">
					<label for="selForanee">Select Education Forum</label>
					<select class="form-control" name="selEduFrm" id="selEduFrm">
						<option value=""></option>
						<?php foreach ($eduFrm as $row) { ?>
						<option
							value="<?php echo $row->eduforum; ?>">
							<?php echo ucwords($row->eduforum); ?>
						</option>
						<?php } ?>
					</select>
					<small style="color:#666"><i class="fa fa-info"></i> Leave empty for complete export</small>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="txtFrom">Acknowledgement Date</label>
						<input id="txtAck" name="txtAck" class="form-control" type="text"
							value="<?php echo date('d/m/Y'); ?>">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="txtFrom"> &nbsp; </label>
						<button class="form-control btn btn-primary" type="button" onclick="fetchAckCert()">Fetch
							Certficates</button>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="txtFrom"> &nbsp; </label>
						<button class="form-control btn btn-success" onclick="exportCertAck()">
							<i title="Export to excel" aria-hidden="true" class="fa fa-file-excel-o"
								style="color: #fff; font-size: 20px;"></i>
							Export</button>
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
	$(function() {
		$('#txtAck').inputmask('dd/mm/yyyy', {
			'placeholder': 'dd/mm/yyyy'
		});
		$('#txtAck').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});

	});
</script>