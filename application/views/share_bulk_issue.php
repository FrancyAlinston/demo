<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Bulk Issue Share Certificates.</h1>
	<?php include '_breadcrumbs.php'; ?>
		<div class="box box-success">
			<div id="boxResult" class="box-body">
				<table id="tableCourses" class="table table-responsive table-bordered table-striped table-condensed table-hover dataTable" role="grid">
	    <tr>
			<th class="text-center" >Si No</th>
			<th class="text-center">Navadarsan ID</th>
			<th class="text-center">Member ID</th>
			<th class="text-center">Beneficiary Name</th>
			<th class="text-center">Guardain Name</th>
			<th class="text-center">Forane</th>
			<th class="text-center">Education Forum</th>
			<th class="text-center">Action</th>
		</tr>
	<?php 
		$cnt = 0;
		foreach ($shares as $share) { 
			$cnt++;
	?>
		<tr id="shareBlk<?php echo $share->old_id;?>">
			<td class="text-center"><?php echo $cnt;?></td>
			<td class="text-center"><?php echo $share->old_id; ?></td>
			<td class="text-center"><?php echo $share->share_member_id; ?></td>
			<td class="text-center"><?php echo $share->name;?></td>
			<td class="text-center"><?php echo $share->guardian_name;?></td>
			<td class="text-center"><?php echo $share->forane;?></td>
			<td class="text-center"><?php echo $share->education_forum;?></td>
			<td class="text-center"> <span class="btn btn-primary btn-xs" onclick="issueShareBlk('<?php echo $share->share_member_id; ?>','<?php echo $share->old_id; ?>')">Issue Share</span></td>
		</tr>
	<?php } ?>
</table>
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
