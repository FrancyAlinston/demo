<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<form id="printCover" action="<?php echo $site_url;?>scholarship/scholarshipcoverprint" method="post">
<section class="content-header" id="filterHead">
	<h1> Print Scholarship Cover </h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background: #a0e0ed;">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="txtYear">Select Batch</label>
						<select id="txtYear" name="txtYear" class="form-control selectpicker" data-live-search="true">
							<option value=""></option>
							<?php foreach ($year->result() as $yer) { ?>
							<option value="<?php echo $yer->year; ?>"><?php echo 'Shcolarship Batch '.$yer->year; ?> </option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="col-md-3">
							<label for="selForanee">Forane</label>
									<select class="form-control" name="selForane" id="selForane" onchange="geteduforum(value,'selEduFrm')">
										<option value=""></option>
									<?php foreach ($forane->result() as $row) { ?>
									<option value="<?php echo $row->id.'|'.$row->forane; ?>"><?php echo ucwords($row->forane); ?></option>
									<?php } ?>
								    </select>
						</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="selEduFrm">Select Education Forum</label>
						<select id="selEduFrm" name="selEduFrm" class="form-control">
							<option value="">All</option>

						</select>
						</div
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="selEduFrm">&nbsp;</label>
					  <button class="form-control btn btn-md btn-primary"> Print</button>
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
	<div id="popAccess" style="display:none;z-index: 100;position: fixed;top:0px;left:0px;background: #000; width: 100%; height: 1000px">
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
</div>
	<?php include '_footer.php'; ?>
<script>

	function verifyAccess(){
		if($('#txtAccess').val() == 'nidhi2018'){
			$('#popAccess').css('display','none');
		}else{

		}
	}
</script>