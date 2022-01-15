<section class="content">
	<div id="existingShares">

	</div>
	<hr>
	<h4>Issue New Share</h4>
	<form method="post" onsubmit="return createNewShare()" id="frmCreateShare" name="frmCreateShare">
						<div class="row">
							<div class="col-md-6">
										<label for="txtShareId">Share ID <i id="shareInfo"data-toggle="tooltip" title="Share range eg: 2000-2500  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Or individual share id's sepreated by comma eg: 2500,2501,2502  Or both eg: 2000-2500,2501,2502" class="fa fa-info-circle" style="color:#00C0EF"></i> <small style="font-weight:normal;font-size: 16px">Last issued share <span id="lastShareNum"><?php echo $last_share; ?></span></small></label>
										<textarea id="txtShareId" name="txtShareId" class="form-control" required value="" style="height: 35px; margin-bottom: 5px"></textarea>
										<span class="btn btn-xs btn-danger" onclick="shareCal()">Calculate Shares &amp; Availablity</span>
										<span class="btn btn-xs btn-success" onclick="showOrphanShares()">Show Orphan Shares</span>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtShareCount">No Of Shares</label>
											<input type="text" id="txtShareCount" name="txtShareCount" class="form-control" required value="" onkeypress="return false;">
											<div id="shareError" style="color: red"></div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="txtCertOverride">Share Certificate Override</label>
											<input type="text" id="txtCertOverride" name="txtCertOverride" class="form-control"  value="" >
											<div id="shareError" style="color: red"></div>
										</div>
									</div>
						</div>

	</form>
	<div class="row">
		<div class="col-md-12" id="orpahanShares"> </div>
	</div>
</section>
<script>
	$('#scapeModalTitle').html($('#scapeModalTitle').html()+
		' <small>[ Member Id : '+$('#txtMembershipID').val()+' ] '+
		'[ Beneficiary : '+$('#shareBenId').val()+' ] </samll>');

    $.post(site_url+'share/getsharelist',{holderID:$('#shareBenId').val()}).done( function( data ) {
			$('#existingShares').html(data);
			getNextShareSeries();
	});


	$('#txtShareIssueDate').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
	$('#txtShareIssueDate').datepicker({
		autoclose: true,
		format: 'dd/mm/yyyy'
	});


	function getNextShareSeries(){
		var seriesConst = 10;
		$('#txtShareId').val((parseInt($('#lastShareNum').text())+1)+'-'+(parseInt($('#lastShareNum').text())+10));

		if($('.memberShareExists').length){
			// commenting this for the time being as per Raphels sir's request on 27/05/2019
			 $('#scapeModalFooter').html('<h3 style="color:red;text-align:center">Share Already Issued..!!</h3>'+
			 '<span onclick="forceIssueShare()" class="btn btn-xs btn-danger">Force Issue Share</span>');
		}
	}

	function forceIssueShare(){
		if(confirm('Shares already exist for this account\nAre you sure that you want to issue shares?')){
			$('#frmCreateShare').submit();
		}
	}

</script>
