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
				<div class="col-md-3">
					<div class="form-group">
						<label for="txtYear">Select Batch</label>
						<select id="txtYear" name="txtYear" class="form-control selectpicker" data-live-search="true" onchange="getScholarshipFilterForumWise()">
							<option value=""></option>
							<?php foreach ($year->result() as $yer) { ?>
							<option value="<?php echo $yer->year; ?>"><?php echo 'Shcolarship Batch '.$yer->year; ?> </option>
							<?php } ?>
						</select>
					</div>
				</div>
				<i onclick="exportScholarshipForumwise()" title="Export to excel" aria-hidden="true" class="fa fa-file-excel-o" style="float: right;color: #00A65A; font-size: 20px; cursor: pointer; margin-right:20px;"></i>
			</div>
		</div>
	</div>
		<div class="box box-success">
			<div id="boxResult" class="box-body">

			</div>
			<!-- /.box-body -->
		</div>
	</section>
	<!-- <div id="popAccess" style="z-index: 100;position: fixed;top:0px;left:0px;background: #000; width: 100%; height: 1000px">
	<div style="width:300px;height:200px;background: #fff;margin:0px auto;margin-top: 10%;padding:30px; border-radius: 8px">
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
</div> -->
	<?php include '_footer.php'; ?>
<script>

	function verifyAccess(){
		if($('#txtAccess').val() == 'nidhi2018'){
			$('#popAccess').css('display','none');
		}else{

		}
	}
</script>
