<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Close Nidhi Account</h1>
	<?php include '_breadcrumbs.php'; ?>
		<div class="box box-success">
			<div class="box-body">
				<form method="post" onsubmit="return advancedSearch('closing')" id="frmBenAdvanceSearch" name="frmBenAdvanceSearch">

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtOldid">Beneficiary ID</label>
									<input id="txtOldid" name="txtOldid" class="form-control" value="" type="text" onkeyup="advancedSearch('closing')">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtBenNameS">Beneficiary Name</label>
									<input  id="txtBenNameS" name="txtBenNameS" class="form-control" value="" type="text" onkeyup="advancedSearch('closing')">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="txtGuardianS">Guardian Name</label>
									<input placeholder="Enter Name" id="txtGuardianS" name="txtGuardianS" class="form-control" value="" type="text" onkeyup="advancedSearch('closing')">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="SelForaneS">Select Forane</label>
									<select class="form-control" name="SelForaneS" id="SelForaneS" onchange="geteduforum(value,'selEduFrmS')">
										<option value=''></option>
										<?php foreach ($forane->result() as $row) { ?>
										<option value='<?php echo $row->id; ?>'><?php echo ucwords($row->forane); ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="selEduFrmS">Select Education Forum</label>
									<select name="selEduFrmS" id="selEduFrmS" class="form-control" onchange="advancedSearch('closing')">
										<option value=''></option>
									</select>
								</div>
							</div>
	                        <div class="col-md-4">
								<div class="form-group">
									<label for="txtPhoneS">Phone</label>
									<input id="txtPhoneS" name="txtPhoneS" class="form-control" value="" type="text" onkeyup="advancedSearch('closing')">
								</div>
							</div>
						</div>
				<hr>
				<div id="searchResultsDel" style="overflow-y: scroll; height: 300px">

				</div>
	</form>
</div>
			<div id="boxResult" class="box-body">
				
			</div>
			<!-- /.box-body -->
		</div>
	</section>
	<div id="popAccess" style="position: fixed;top:0px;left:0px;background: #000; width: 100%; height: 1000px;z-index: 10000">
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
	<input id="txtMembershipID" type="hidden" name="txtMembershipID">
	<input id="shareBenId" type="hidden" value="" name="shareBenId">
	<style type="text/css">
		#boxResult table{
			/*width: 60%;*/
		}
		#boxResult td, #boxResult th{
			/*border: 1px solid #ccc;
			border-collapse: collapse;
			text-align: center;*/
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

function issueShareBlk(mID,nID){
	$('#txtMembershipID').val(mID);
	$('#shareBenId').val(nID);
	setTimeout(showModal('createShare'), 1000);
}

function verifyAccess(){
	if($('#txtAccess').val() == 'nidhi2018'){
		$('#popAccess').css('display','none');
	}else{

	}
}
	</script>
