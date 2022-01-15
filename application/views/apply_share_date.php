<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Assign Share Issue Date.</h1>
	<?php include '_breadcrumbs.php'; ?>
	<div class="box box-info" style="margin-top: 5px; background: #a0e0ed;">
		<div class="box-body w3-allerta">
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
								<label for="txtShareFrm">Shares From</label>
								<input type="text" class="form-control" name="txtShareFrm" id="txtShareFrm">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="txtShareTo">Shares To</label>
						<input type="text" class="form-control" name="txtShareTo" id="txtShareTo">
						</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="txtShareIssueDate">Share Issue Date</label>
						<input type="text" class="form-control" name="txtShareIssueDate" id="txtShareIssueDate">
						</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="txtShareAllotmentNumber">Share Allotment Number</label>
						<input type="text" class="form-control" name="txtShareAllotmentNumber" id="txtShareAllotmentNumber">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label>Issue Shares</label>
						<span class="btn btn-primary" onclick="applyShareDates()" style="display: block">Issue Share</span>
						</div>
				</div>
			</div>
		</div>
	</div>
		<div class="box box-success" style="background-color: #96eba6;">
			<div id="boxResult" class="box-body w3-allerta">

			</div>
			<!-- /.box-body -->
		</div>
	</section>
	<div id="popAccess" style="position: fixed;top:0px;left:0px;background: #000; width: 100%; height: 1000px">
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
	<style type="text/css">
		#boxResult table{
			width: 60%;
		}
		#boxResult td, #boxResult th{
			border: 1px solid #ccc;
			border-collapse: collapse;
			text-align: center;
		}
	</style>
	<?php include '_footer.php'; ?>
	<script>
$(function(){
		$('#txtShareIssueDate').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
		$('#txtShareIssueDate').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});

	});

function verifyAccess(){
	if($('#txtAccess').val() == 'nidhi2018'){
		$('#popAccess').css('display','none');
	}else{

	}
}
	</script>
