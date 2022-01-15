<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include '_header.php';
?>
<section class="content-header" id="filterHead">
	<h1>Search By Membership ID / Share Certificate ID </h1>
	<div class="box box-info" style="margin-top: 5px">
		<div class="box-body">
			<div class="row">
				<div class="col-md-4">
							<label for="txtMembershipID">Membership ID</label>
							<input type="text" class="form-control" name="txtMembershipID" id="txtMembershipID">
						</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="txtShareCertificateID">Share Cerificate ID</label>
						<input type="text" class="form-control" name="txtShareCertificateID" id="txtShareCertificateID">
						</div
					</div>
				</div>
				<div class="col-md-2">
					<label for="txtMembershipID">&nbsp;</label>
					<button class="form-control btn btn-primary" onclick="memberSearch()">Search</button>
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
	<div id="popAccess" style="display:none;position: fixed;top:0px;left:0px;background: #000; width: 100%; height: 1000px">
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
$(function(){
		$('#txtFrom,#txtTo').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
		$('#txtFrom,#txtTo').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});
    // $('#txtFrom,#txtTo').change(function(){
    //   $('#selForane,#selEduFrm').val('');
    // });
		//
    // $('#selEduFrm').change(function(){
    // 	$('#txtFrom,#txtTo').val('');
    // });

	});

function verifyAccess(){
	if($('#txtAccess').val() == 'nidhi2018'){
		$('#popAccess').css('display','none');
	}else{

	}
}
	</script>
